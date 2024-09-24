<?php

namespace App\Http\Controllers;

use App\Models\DataKehadiran;
use App\Models\DataKaryawan;
use App\Models\PembagianShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function showKehadiran(Request $request)
    {
        // Ambil semua data kehadiran atau sesuai filter yang diinginkan
        $kehadiran = DataKehadiran::with('karyawan')
                                   ->get();

        return view('absen.kehadiran', compact('kehadiran'));
    }

        public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_karyawan' => 'required|exists:data_karyawan,id_karyawan',
        ]);

        $idKaryawan = $validatedData['id_karyawan'];
        $tanggalHariIni = now()->toDateString();
        $waktuSekarang = now()->timezone('Asia/Jakarta'); // Menggunakan Carbon::now() untuk mendapatkan waktu saat ini

        // Cek apakah id_karyawan ada di tabel data_karyawan
        $karyawan = DataKaryawan::find($idKaryawan);

        if (!$karyawan) {
            return Redirect::back()->with('error', 'Karyawan dengan ID tersebut tidak ditemukan.');
        }

        // Ambil data shift dari tabel pembagian_shift berdasarkan id_karyawan dan tanggal hari ini
        $shift = PembagianShift::where('id_karyawan', $idKaryawan)
                            ->where('tanggal', $tanggalHariIni)
                            ->first();

        if (!$shift || !$shift->shift_id) {
            return Redirect::back()->with('error', 'Anda hari ini libur.');
        }



        $jamMulai = Carbon::parse($shift->jam_mulai)->timezone('Asia/Jakarta');
        $jamSelesai = Carbon::parse($shift->jam_selesai)->timezone('Asia/Jakarta');
        $batasJamKeluar = $jamSelesai->copy()->addHours(3); // Batas jam keluar adalah 3 jam setelah jam selesai shift

        // Cek apakah karyawan sudah memiliki absensi pada hari ini
        $kehadiran = DataKehadiran::where('id_karyawan', $idKaryawan)
                                ->where('tanggal_hadir', $tanggalHariIni)
                                ->first();


                                 // Jika tidak ada data absensi untuk hari ini, catat jam masuk

        if ($kehadiran) {
            // Cek apakah status kehadiran sudah diisi dengan Izin atau Sakit
            if ($kehadiran->status_hadir === 'Izin' || $kehadiran->status_hadir === 'Sakit') {
                return Redirect::back()->with('error', 'Anda sudah mencatat absensi sebagai Izin atau Sakit untuk hari ini.');
            }

            // Jika jam keluar sudah diisi
            if ($kehadiran->waktu_keluar !== null) {
                return Redirect::back()->with('error', 'Absensi sudah lengkap.');
            } else {
                // Jika sudah ada jam masuk tetapi belum ada jam keluar
                // Cek apakah waktu sekarang sudah lebih dari 3 jam setelah jam selesai shift
                if ($waktuSekarang->lt($batasJamKeluar)) {
                    // Pastikan jam masuk sudah diisi sebelum mencatat jam keluar
                    if ($kehadiran->waktu_masuk === null) {
                        return Redirect::back()->with('error', 'Anda harus mencatat jam masuk terlebih dahulu sebelum mencatat jam keluar.');
                    }

                    return redirect()->route('absen.konfirmasi-keluar', [
                        'id_karyawan' => $idKaryawan,
                        'tanggal_hadir' => $tanggalHariIni,
                        'waktu_masuk' => $kehadiran->waktu_masuk
                    ]);
                } else {
                    // Jika sudah lebih dari 3 jam setelah jam selesai shift, catat jam keluar
                    $kehadiran->waktu_keluar = $waktuSekarang->format('H:i');
                    $kehadiran->lama_kerja = $this->calculateLamaKerja($kehadiran->waktu_masuk, $kehadiran->waktu_keluar);
                    $kehadiran->save();

                    return Redirect::back()->with('success', 'Jam keluar berhasil dicatat.');
                }
            }
        } else {
            if ($waktuSekarang->gt($jamSelesai)) {
                return Redirect::back()->with('error', 'Absen tidak dapat dicatat karena di luar jam kerja. Shift Anda sekarang adalah dari ' . $jamMulai->format('H:i') . ' hingga ' . $jamSelesai->format('H:i') . '.');
            }

            $dataKehadiran = new DataKehadiran();
            $dataKehadiran->id_karyawan = $idKaryawan;
            $dataKehadiran->tanggal_hadir = $tanggalHariIni;
            $dataKehadiran->waktu_masuk = $waktuSekarang->format('H:i');
            $dataKehadiran->waktu_keluar = null;
            $dataKehadiran->ketepatan_waktu = $this->calculateKetepatanWaktu($jamMulai, $waktuSekarang);
            $dataKehadiran->lama_kerja = null;
            $dataKehadiran->status_hadir = 'Hadir';
            $dataKehadiran->keterangan = null;
            $dataKehadiran->save();

            return Redirect::back()->with('success', 'Jam masuk berhasil dicatat.');
        }
    }




    private function calculateKetepatanWaktu($jamMulai, $waktuMasuk)
    {
        $waktuSatuJamSebelumMulai = $jamMulai->copy()->subHour()->format('H:i');

        if ($waktuMasuk <= $waktuSatuJamSebelumMulai) {
            return 'On Time';
        } elseif ($waktuMasuk > $jamMulai) {
            return 'Telat';
        }

        return 'On Time';
    }

    // Method untuk menghitung lama kerja
    private function calculateLamaKerja($waktuMasuk, $waktuKeluar)
    {
        $waktuMulai = Carbon::parse($waktuMasuk);
        $waktuSelesai = Carbon::parse($waktuKeluar);
        $lamaKerja = $waktuMulai->diff($waktuSelesai);
        return $lamaKerja->format('%H:%I'); // Format H:i
    }

    public function showKonfirmasiKeluarForm(Request $request)
    {
        // Ambil parameter dari URL
        $idKaryawan = $request->query('id_karyawan');
        $tanggalHadir = $request->query('tanggal_hadir');
        $waktuMasuk = $request->query('waktu_masuk');

        // Cek apakah parameter yang dibutuhkan ada
        if (!$idKaryawan || !$tanggalHadir || !$waktuMasuk) {
            return redirect()->back()->with('error', 'Data yang diperlukan tidak lengkap.');
        }

        // Ambil data karyawan jika diperlukan
        $karyawan = DataKaryawan::find($idKaryawan);

        // Cek apakah karyawan ada
        if (!$karyawan) {
            return redirect()->back()->with('error', 'Karyawan tidak ditemukan.');
        }

        // Kirim data ke view
        return view('absen.konfirmasi_keluar', compact('idKaryawan', 'tanggalHadir', 'waktuMasuk', 'karyawan'));
    }




    public function konfirmasiKeluar(Request $request)
    {
        $validatedData = $request->validate([
            'id_karyawan' => 'required|exists:data_karyawan,id_karyawan',
            'status_hadir' => 'required|in:Hadir,Izin,Sakit,Tidak Hadir',
            // Hapus 'waktu_keluar' dari validasi
        ]);

        $idKaryawan = $validatedData['id_karyawan'];
        $statusHadir = $validatedData['status_hadir'];
        $tanggalHariIni = now()->toDateString();
        $waktuSekarang = Carbon::now('Asia/Jakarta')->format('H:i'); // Setel waktu saat ini ke zona waktu 'Asia/Jakarta'

        $kehadiran = DataKehadiran::where('id_karyawan', $idKaryawan)
                                  ->where('tanggal_hadir', $tanggalHariIni)
                                  ->first();

        if ($kehadiran) {
            // Ambil shift dari tabel pembagian_shift untuk ketepatan_waktu
            $shift = PembagianShift::where('id_karyawan', $idKaryawan)
                                   ->where('tanggal', $tanggalHariIni)
                                   ->first();

                 if ($shift) {
                    $jamSelesai = Carbon::parse($shift->jam_selesai)->timezone('Asia/Jakarta');
                    $waktuKeluar = Carbon::now('Asia/Jakarta'); // Ambil waktu sekarang

                    // Format waktu keluar ke H:i
                    $formattedWaktuKeluar = $waktuKeluar->format('H:i');

                    $waktuMasuk = Carbon::parse($kehadiran->waktu_masuk)->timezone('Asia/Jakarta');

                    // Jika waktu keluar sebelum jam selesai, set ketepatan_waktu ke null
                    if ($waktuKeluar->lt($jamSelesai)) {
                        $kehadiran->ketepatan_waktu = null;
                    } else {
                        // Hitung ketepatan waktu jika keluar setelah jam selesai
                        $kehadiran->ketepatan_waktu = $this->calculateKetepatanWaktu($jamSelesai, $waktuKeluar);
                    }

                    // Simpan perubahan
                    $kehadiran->save();
                }


            $kehadiran->waktu_keluar = $waktuSekarang; // Format waktu_keluar
            $kehadiran->status_hadir = $statusHadir;
            $kehadiran->keterangan = $request->input('keterangan');
            $kehadiran->lama_kerja = $this->calculateLamaKerja($kehadiran->waktu_masuk, $kehadiran->waktu_keluar);
            $kehadiran->save();

            return redirect()->route('absen.kehadiran', ['id_karyawan' => $idKaryawan])
                             ->with('success', 'Jam keluar dan status berhasil dicatat.');
        }

        return redirect()->route('absen.kehadiran', ['id_karyawan' => $idKaryawan])
                         ->with('error', 'Terjadi kesalahan saat mencatat keluar.');
    }

    public function inputIzin()
    {
        $karyawan = DataKaryawan::all();
        return view('absen.konfirmasi_izin', compact('karyawan'));
    }

    public function prosesIzin(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_karyawan' => 'required|exists:data_karyawan,id_karyawan',
            'status_hadir' => 'required|in:Izin,Sakit,Hadir,Tidak Hadir',
            'jumlah_hari_hadir' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        $idKaryawan = $validatedData['id_karyawan'];
        $statusHadir = $validatedData['status_hadir'];
        $jumlahHariHadir = $validatedData['jumlah_hari_hadir'];
        $keterangan = $validatedData['keterangan'];

        // Mendapatkan tanggal mulai dari hari ini
        $tanggalMulai = now();
        $tanggalAkhir = $tanggalMulai->copy()->addDays($jumlahHariHadir - 1)->format('Y-m-d');
        $tanggalMulaiFormatted = $tanggalMulai->format('d-m-Y');

        for ($i = 0; $i < $jumlahHariHadir; $i++) {
            $tanggal = $tanggalMulai->copy()->addDays($i)->format('Y-m-d');

            // Mengecek apakah sudah ada data untuk tanggal ini
            $kehadiran = DataKehadiran::where('id_karyawan', $idKaryawan)
                                    ->where('tanggal_hadir', $tanggal)
                                    ->first();

            if ($kehadiran) {
                // Jika data sudah ada, cek apakah status_hadir sudah tercatat
                if ($kehadiran->status_hadir) {
                    // Jika status sudah ada, kembali dengan pesan error
                    return redirect()->back()->with('error', "Data kehadiran untuk tanggal $tanggal sudah ada");
                }

                // Jika data sudah ada tapi status_hadir belum tercatat, update status dan keterangan
                $kehadiran->status_hadir = $statusHadir;
                $kehadiran->keterangan = $keterangan;
                $kehadiran->save();
            } else {
                // Jika data belum ada, buat entri baru
                $kehadiran = new DataKehadiran();
                $kehadiran->id_karyawan = $idKaryawan;
                $kehadiran->tanggal_hadir = $tanggal;
                $kehadiran->status_hadir = $statusHadir;
                $kehadiran->keterangan = $keterangan;
                $kehadiran->waktu_masuk = null;
                $kehadiran->waktu_keluar = null;

                // Simpan data kehadiran
                $kehadiran->save();
            }
        }

        return redirect()->route('absen.konfirmasi_izin')
                        ->with('success', "Data izin berhasil diproses dari tanggal $tanggalMulaiFormatted hingga $tanggalAkhir.");
}
    }


