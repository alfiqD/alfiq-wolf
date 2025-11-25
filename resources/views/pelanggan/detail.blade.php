@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <h1>Detail Pelanggan: {{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</h1>

    <!-- Form Edit Data Pelanggan -->
    <form action="{{ route('pelanggan.update', $pelanggan->pelanggan_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>Nama Depan</label>
            <input type="text" name="first_name" value="{{ $pelanggan->first_name }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>Nama Belakang</label>
            <input type="text" name="last_name" value="{{ $pelanggan->last_name }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" value="{{ $pelanggan->email }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>Telepon</label>
            <input type="text" name="phone" value="{{ $pelanggan->phone }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>File Pendukung (Multiple Upload)</label>
            <input type="file" name="files[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mb-3">Update</button>
    </form>

    <!-- List File Pendukung -->
    <h5>File Pendukung</h5>
    <ul class="list-group">
        @foreach($files as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    @php
                        $ext = pathinfo($file->filename, PATHINFO_EXTENSION);
                        $img_extensions = ['jpg','jpeg','png','gif','webp'];
                    @endphp

                    @if(in_array(strtolower($ext), $img_extensions))
                        <img src="{{ asset('storage/uploads/' . $file->filename) }}"
                             alt="{{ $file->filename }}"
                             style="width:60px; height:60px; object-fit:cover; border-radius:50%; margin-right:10px;">
                    @endif

                    <span>{{ $file->filename }}</span>
                </div>

                <!-- Tombol Hapus File -->
                <form action="{{ route('pelanggan.deleteFile', $file->id) }}" method="POST" style="margin-left:10px;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus file ini?')">
                        Hapus
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
