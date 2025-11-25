<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>

    {{-- BARIS KRITIS YANG PERLU DITAMBAHKAN --}}
    @if($user)

        {{-- Sekarang aman untuk mengakses properti $user --}}
        @if($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" width="200">
        @else
            <p>No profile picture uploaded.</p>
        @endif

    {{-- Jika objek $user tidak ada, tampilkan pesan error --}}
    @else
        <p>Error: User data not found. Please log in.</p>
    @endif

    <br><br>
    {{-- Asumsi route ini hanya dapat diakses oleh user yang login --}}
    <a href="{{ route('profile.edit') }}">Edit Profile</a>
</body>
</html>
