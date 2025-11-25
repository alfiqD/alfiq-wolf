@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
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
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Pelanggan</h1>
                <p class="mb-0">Form untuk Edit data user.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="far fa-question-circle me-1"></i>
                    Kembali</a>
            </div>
        </div>
    </div>

    {{-- notif berhasil --}}
    @if (session('success'))
        <div class="alert alert-info">
            {!! session('success') !!}
        </div>
    @endif

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    {{-- Penyesuaian form: action, method, csrf --}}
                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                {{-- Foto Profil Column --}}
                                <div class="profile-card p-3 text-center">
                                    <label class="form-label fw-bold">Foto Profil Saat Ini</label>
                                    <div class="avatar-wrap my-2">
                                        @if ($dataUser->profile_picture)
                                            <img src="{{ asset('storage/profile/' . $dataUser->profile_picture) }}" alt="Foto Profil"
                                                 class="profile-avatar mb-2">
                                        @else
                                            {{-- contoh fallback gambar (untuk preview saat development) --}}
                                            <img src="/mnt/data/c68f3898-1483-4220-ba4e-3347ddcf1b0c.png" alt="Foto Profil" class="profile-avatar mb-2">
                                        @endif

                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" value="1" id="remove_photo" name="remove_photo">
                                            <label class="form-check-label text-danger" for="remove_photo">
                                                Hapus Foto Profil
                                            </label>
                                        </div>

                                        <div class="small text-muted mt-2">Biarkan kosong jika tidak ingin mengganti foto.</div>
                                    </div>

                                    {{-- Upload foto baru --}}
                                    <div class="mt-3 text-start">
                                        <label for="profile_picture" class="form-label fw-bold">Upload Foto Profil Baru</label>
                                        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal: 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 col-sm-6">
                                {{-- Form fields --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{ $dataUser->name }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-bold">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{ $dataUser->email }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-bold">Password Baru</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                                        </div>
                                    </div>
                                </div>

                                {{-- Buttons --}}
                                <div class="mt-3 d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Batal Atau Kembali</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- end main content --}}

    {{-- Custom style agar mirip contoh --}}
    <style>
        .profile-avatar{
            width:150px;
            height:150px;
            border-radius:50%;
            object-fit:cover;
            border: 6px solid #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .profile-card{
            background: linear-gradient(180deg, #fff, #fff);
            border-radius: 8px;
        }
        .avatar-wrap{
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        /* responsive tweaks */
        @media(max-width:767px){
            .profile-avatar{
                width:120px;
                height:120px;
            }
        }
    </style>
@endsection
