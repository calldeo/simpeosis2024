<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
    <title>Laporan Hasil Polling</title>
</head>
<body>
    <div class="form-group">
        <img src="/foto_calon/print.png" alt="Logo" style="display: block; margin: 0 auto;">
     <div class="berita-acara" style="text-align: justify; padding: 0 20px;">
    <h2 style="text-align: center;">Berita Acara</h2>
    <p>Pada hari ini, tanggal [tanggal], telah dilaksanakan pemilihan Ketua Organisasi Siswa Intra Sekolah (OSIS) di SMA XYZ.</p>
    <p>Setelah proses pemungutan dan penghitungan suara, [nama calon] terpilih sebagai Ketua OSIS periode [periode] dengan jumlah suara [jumlah suara].</p>
    <p>Dokumen ini menjadi catatan resmi hasil pemilihan Ketua OSIS.</p>
    <p>Demikianlah berita acara ini dibuat dengan sebenarnya untuk menjadi catatan resmi hasil pemilihan Ketua OSIS SMA XYZ.</p>
</div>

        <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
            <tr>
                <th>No.Urut</th>
                <th>Nama Calon</th>
                <th>Jumlah</th>
            </tr>
            <tbody>
                @foreach ($cosis as $calon)
                <tr>
                    <td>{{ $calon->id }}</td>
                    <td>{{ $calon->nama_calon }}</td>
                    <td>{{ $calon->jumlah_vote }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
          <div style="text-align: right; margin-top: 20px;">
        <p>Mengetahui,</p>
        {{-- <img src="/foto_kepala_sekolah/tanda_tangan.png" alt="Tanda Tangan Kepala Sekolah" style="width: 150px;"> --}}
         <p style="margin-bottom: 0;">Kepala Sekolah</p>
        <p style="margin-bottom: 100px;">[Nama Kepala Sekolah]</p>
   
    </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
