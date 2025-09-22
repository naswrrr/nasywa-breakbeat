<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .data-row {
            display: flex;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .data-label {
            font-weight: bold;
            width: 200px;
            color: #555;
        }
        .data-value {
            flex: 1;
        }
        .hobbies {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        .hobby {
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 13px;
        }
        .semester-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            margin-top: 5px;
            border-left: 3px solid #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Pegawai</h1>

        <div class="data-row">
            <div class="data-label">Nama:</div>
            <div class="data-value">{{ $name }}</div>
        </div>

        <div class="data-row">
            <div class="data-label">Umur:</div>
            <div class="data-value">{{ $my_age }} tahun</div>
        </div>

        <div class="data-row">
            <div class="data-label">Hobi:</div>
            <div class="data-value">
                <div class="hobbies">
                    @foreach($hobbies as $hobby)
                        <span class="hobby">{{ $hobby }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="data-row">
            <div class="data-label">Tanggal Harus Wisuda:</div>
            <div class="data-value">{{ date('d F Y', strtotime($tgl_harus_wisuda)) }}</div>
        </div>

        <div class="data-row">
            <div class="data-label">Jumlah Hari Menuju Wisuda:</div>
            <div class="data-value">{{ $time_to_study_left }} hari</div>
        </div>

        <div class="data-row">
            <div class="data-label">Semester Saat Ini:</div>
            <div class="data-value">Semester {{ $current_semester }}</div>
        </div>

        <div class="data-row">
            <div class="data-label">Informasi Akademik:</div>
            <div class="data-value">
                <div class="semester-info">{{ $semester_info }}</div>
            </div>
        </div>

        <div class="data-row">
            <div class="data-label">Cita-cita:</div>
            <div class="data-value">{{ $future_goal }}</div>
        </div>
    </div>
</body>
</html>
