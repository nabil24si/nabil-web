<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <p class="wow fadeInUp" data-wow-delay=".8s">
        Belum punya akun? <a href="{{ route('auth.create') }}">Daftar Sekarang</a>
    </p>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success wow fadeIn" data-wow-delay="1s">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger wow fadeIn" data-wow-delay="1s">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger wow fadeIn" data-wow-delay="1.2s">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="wow fadeInUp" data-wow-delay="1.4s" action="{{ route('auth.store') }}" method="POST">
        @csrf
        <div class="form-group wow fadeInUp" data-wow-delay="1.6s">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group wow fadeInUp" data-wow-delay="1.8s">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn-login wow fadeInUp" data-wow-delay="2s" name="login">Masuk</button>
    </form>

    </div>
    </div>
</body>

</html>
