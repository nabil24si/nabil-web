@extends('layouts.admin.app')
@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Data User</h1>
                <p class="mb-0">Form untuk mengedit data User.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="far fa-arrow-alt-circle-left me-1"></i>
                    Kembali</a>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-info">
            {!! session('success') !!}
        </div>
    @endif
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    {{-- 🛑 PERBAIKAN PENTING: Tambahkan enctype untuk upload file --}}
                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-lg-6 col-sm-12">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ old('name', $dataUser->name) }}" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" required name="email"
                                        value="{{ old('email', $dataUser->email) }}">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- FOTO PROFIL --}}
                                <div class="form-group mb-4">
                                    <label class="form-label">Foto Profil Saat Ini</label>
                                    <div class="mb-2">
                                        @if ($dataUser->profile_picture)
                                            <img src="{{ Storage::url($dataUser->profile_picture) }}"
                                                 alt="Foto Profil"
                                                 style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                        @else
                                            <p>Belum ada foto profil.</p>
                                        @endif
                                    </div>

                                    <label for="profile_picture" class="form-label">Ubah Foto Profil</label>
                                    <input type="file" name="profile_picture" class="form-control-file" id="profile_picture">
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Maks. 2MB. Biarkan kosong jika tidak diubah.</small>
                                    @error('profile_picture') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12">

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    {{-- 🛑 PENTING: Hapus value="{{ $dataUser->password }}" --}}
                                    <input type="password" id="password" class="form-control" name="password">
                                    <small class="form-text text-muted">Isi hanya jika ingin mengubah password.</small>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    {{-- 🛑 PENTING: Pastikan name-nya 'password_confirmation' --}}
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
