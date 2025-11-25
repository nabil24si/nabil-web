@extends('layouts.admin.app')
@section('content')
{{-- Start Main Content --}}
    <div class="py-4">
        {{-- ... Breadcrumb dan Header (tetap sama) ... --}}
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
                    <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">

                            {{-- KOLOM 1: Nama --}}
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First name</label>
                                    <input type="text" id="first_name" class="form-control" name="first_name"
                                        value="{{ old('first_name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name"
                                        value="{{ old('last_name') }}" required>
                                </div>
                            </div>

                            {{-- KOLOM 2: Tanggal Lahir & Gender --}}
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label for="birthday" class="form-label">Birthday</label>
                                    <input type="date" id="birthday" class="form-control" name="birthday"
                                        value="{{ old('birthday') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-select">
                                        {{-- Gunakan 'selected' untuk mempertahankan old value --}}
                                        <option value="" {{ old('gender') == '' ? 'selected' : '' }}>-- Pilih --</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            {{-- KOLOM 3: Email, Phone, & MULTIPLE UPLOADS --}}
                            <div class="col-lg-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" required
                                        name="email" value="{{ old('email') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" id="phone" class="form-control" name="phone"
                                        value="{{ old('phone') }}">
                                </div>

                                {{-- 🛑 PENAMBAHAN UNTUK MULTIPLE UPLOADS --}}
                                <div class="mb-3">
                                    <label for="documents" class="form-label">Dokumen Pelanggan (Multiple)</label>
                                    {{-- Name harus diakhiri dengan [] dan tambahkan atribut multiple --}}
                                    <input type="file" id="documents" class="form-control" name="documents[]" multiple>
                                    <small class="form-text text-muted">Anda dapat memilih lebih dari satu file.</small>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('pelanggan.index') }}"
                                        class="btn btn-outline-secondary ms-2">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
{{-- End Main Content --}}
@endsection
