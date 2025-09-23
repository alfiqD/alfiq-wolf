<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Profil Pegawai</h1>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nama: {{ $name }}</h4>
                <p><strong>Umur:</strong> {{ $my_age }} tahun</p>

                <p><strong>Hobi:</strong></p>
                <ul>
                    @foreach ($hobbies as $hobby)
                        <li>{{ $hobby }}</li>
                    @endforeach
                </ul>

                <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
                <p><strong>Jarak Hari dari Tanggal Wisuda:</strong> {{ $time_to_study_left }} hari</p>
                <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>
                <p><strong>Info Semester:</strong> {{ $semester_info }}</p>
                <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
            </div>
        </div>
    </div>

    <!-- Optional JS, jQuery, and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
