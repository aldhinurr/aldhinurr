<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna Azure</title>
</head>
<body>
    <h1>Profil Pengguna Azure</h1>
    <p>Nama: {{ $user->getName() }}</p>
    <p>Email: {{ $user->getEmail() }}</p>
    <!-- Tampilkan informasi pengguna lainnya sesuai kebutuhan -->
</body>
</html>