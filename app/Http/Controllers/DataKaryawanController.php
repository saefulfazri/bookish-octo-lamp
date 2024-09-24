<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\DataDivisi;
use App\Models\DataKaryawan;
use App\Models\DataJabatan;
use Picqer\Barcode\BarcodeGeneratorPNG;

class DataKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = DataKaryawan::all();

        return view('karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = DataDivisi::all();
        $jabatan = DataJabatan::all();
        return view('karyawan.create', compact('divisi','jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita,Tidak Diketahui',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor' => 'required|string|max:15',
            'jabatan' => 'required|in:Aktif,tidak aktif',
            'mulai_bekerja' => 'required|date',
            'divisi' => 'required|string|max:255',
        ]);

        // Generate the next available numeric ID
        $id_karyawan = DataKaryawan::max('id_karyawan') + 1;

        $karyawan = DataKaryawan::create($request->all() + ['id_karyawan' => $id_karyawan]);

        // Generate barcode for the karyawan
        $barcode = $this->generateBarcode($karyawan->id_karyawan);
        if ($barcode) {
            $karyawan->barcode = $barcode;
            $karyawan->save();
        } else {
            return redirect()->back()->withErrors(['error' => 'Gagal menghasilkan barcode.']);
        }

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $karyawan = DataKaryawan::findOrFail($id);
        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $karyawan = DataKaryawan::findOrFail($id);
        $divisi = DataDivisi::all();
        $jabatan = DataJabatan::all();
        return view('karyawan.edit', compact('karyawan','divisi','jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita,Tidak Diketahui',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor' => 'required|string|max:15',
            'jabatan' => 'required',
            'Status_Karyawan' => 'required|in:Aktif,tidak aktif',
            'mulai_bekerja' => 'required|date',
            'divisi' => 'required|string|max:255',
        ]);

        $karyawan = DataKaryawan::findOrFail($id);
        $karyawan->update($request->all());

        // Generate barcode jika belum ada
        if (empty($karyawan->barcode)) {
            $barcode = $this->generateBarcode($karyawan->id_karyawan);
            if ($barcode) {
                $karyawan->barcode = $barcode;
                $karyawan->save();
            }
        }

        return redirect()->route('karyawan.show', $karyawan->id_karyawan)
            ->with('success', 'Data karyawan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karyawan = DataKaryawan::findOrFail($id);
        $karyawanNama = $karyawan->nama;
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', "Data karyawan $karyawanNama berhasil dihapus!");
    }

    /**
     * Generate barcode for the given karyawan ID.
     */
    public function generateBarcode($id_karyawan)
    {
        $generator = new BarcodeGeneratorPNG();

        if (empty($id_karyawan)) {
            throw new \InvalidArgumentException('ID karyawan tidak boleh kosong.');
        }

        if (!preg_match('/^\d{6}$/', $id_karyawan)) {
            throw new \InvalidArgumentException('ID karyawan harus berupa 6 digit angka.');
        }

        $barcode = $generator->getBarcode($id_karyawan, BarcodeGeneratorPNG::TYPE_CODE_128);
        $image = imagecreatefromstring($barcode);
        $barcodeWidth = imagesx($image);
        $barcodeHeight = imagesy($image);
        $textHeight = 20;
        $totalHeight = $barcodeHeight + $textHeight;
        $newImage = imagecreatetruecolor($barcodeWidth, $totalHeight);
        $white = imagecolorallocate($newImage, 255, 255, 255);
        imagefilledrectangle($newImage, 0, 0, $barcodeWidth, $totalHeight, $white);
        imagecopy($newImage, $image, 0, 0, 0, 0, $barcodeWidth, $barcodeHeight);
        $black = imagecolorallocate($newImage, 0, 0, 0);
        $fontSize = 4;
        $textX = ($barcodeWidth - imagefontwidth($fontSize) * strlen($id_karyawan)) / 2;
        $textY = $barcodeHeight + (($textHeight - imagefontheight($fontSize)) / 2);
        imagestring($newImage, $fontSize, $textX, $textY, $id_karyawan, $black);
        $barcodeDirectory = storage_path('app/public/barcodes/');
        if (!file_exists($barcodeDirectory)) {
            mkdir($barcodeDirectory, 0755, true);
        }
        $barcodeFilePath = $barcodeDirectory . "{$id_karyawan}.png";
        if (!imagepng($newImage, $barcodeFilePath)) {
            throw new \Exception('Gagal menyimpan gambar barcode.');
        }
        imagedestroy($image);
        imagedestroy($newImage);
        return base64_encode(file_get_contents($barcodeFilePath));
    }

}

