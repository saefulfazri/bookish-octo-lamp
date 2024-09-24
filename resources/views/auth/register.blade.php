<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Nama</label>
        <input type="text" name="name" required>
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>
        <button type="submit">Register</button>
    </form>
</body>

</html>
