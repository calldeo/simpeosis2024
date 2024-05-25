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
    <div class="form-group" >
        <img src="/foto_calon/print.png" alt="Logo" style="display: block; margin: 0 auto; width: 115%; " >
  
   <div class="berita-acara" style="text-align: justify; padding: 10px; line-height: 1.5;">
    <h2 style="text-align: center;">Berita Acara</h2>
    <p style="margin-bottom: 10px; text-indent: 20px;">Pada hari ini, tanggal <?php echo date('d F Y'); ?>, telah dilaksanakan pemilihan Ketua dan Wakil Ketua Organisasi Siswa Intra Sekolah (OSIS) di SMKN 1 TAPEN. Setelah proses pemungutan dan penghitungan suara, {{ $calonTerpilih->nama_calon }} terpilih sebagai Ketua OSIS periode 2024/2025 dengan jumlah suara {{ $calonTerpilih->jumlah_vote }} suara.</p>
    <p style="margin-bottom: 10px;text-indent: 20px;">Dokumen ini menjadi catatan resmi hasil pemilihan Ketua dan Wakil Ketua OSIS. Demikianlah berita acara ini dibuat dengan sebenarnya untuk menjadi catatan resmi hasil pemilihan Ketua dan Wakil Ketua OSIS SMkN 1 TAPEN.</p>
</div>

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
    <td style="text-align: center;">{{ $calon->id }}</td>
    <td style="text-align: center;">{{ $calon->nama_calon }}</td>
    <td style="text-align: center;">{{ $calon->jumlah_vote }}</td>
</tr>
@endforeach

            </tbody>
        </table>
          <div style="text-align: right; ">
        <p>Mengetahui,</p>
        {{-- <img src="/foto_kepala_sekolah/tanda_tangan.png" alt="Tanda Tangan Kepala Sekolah" style="width: 150px;"> --}}
      <p style="margin-bottom: 20px; text-align: right;">Kepala Sekolah</p>
<p style="margin-top: 70px; text-align: right;">...................</p>


   
    </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
