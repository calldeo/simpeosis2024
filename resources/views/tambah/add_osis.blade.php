<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Calon OSIS Baru</title>
    @include('template.headerr')
    <title>E-vote | {{auth()->user()->level}} | Add</title>

    <script src="/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: 'textarea', // Select all textareas
            plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
            toolbar: 'undo redo | formatselect | ' +
                     'bold italic backcolor | alignleft aligncenter ' +
                     'alignright alignjustify | bullist numlist outdent indent | ' +
                     'removeformat | help',
            menubar: 'file edit view insert format tools table help',
        });
    </script>
</head>

<body>

    <!-- Preloader start -->
    @include('template.topbarr')
    <!-- Header end -->

    <!-- Sidebar start -->
    @include('template.sidebarr')
    <!-- Sidebar end -->

    <!-- Content body start -->
    <div class="content-body">
        <div class="container-fluid">
            <!-- Add Project -->
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-0">Tambah Calon OSIS Baru</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Calon OSIS</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Calon OSIS Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="/osis/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nama Calon (Ketua Osis/Wakil Ketua Osis) *</label>
                                        <input type="text" class="form-control" id="nama_calon" name="nama_calon" placeholder="Masukkan Nama Calon" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Periode *</label>
                                        <input type="text" class="form-control" id="periode" name="periode" placeholder="Masukkan Periode" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>NIS (Ketua Osis/Wakil Ketua Osis) *</label>
                                        <input type="text" class="form-control" id="NIS" name="NIS" placeholder="Masukkan NIS" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kelas (Ketua Osis/Wakil Ketua Osis) *</label>
                                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan kelas" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_calon">Slogan *</label>
                                    <input type="text" class="form-control" id="slogan" name="slogan" placeholder="Nama Calon">
                                </div>
                                <div class="form-group">
                                    <label for="visimisi">Visi Misi</label>
                                    <textarea class="form-control" rows="8" cols="80"  id="visimisi" name="visimisi" rows="3" placeholder="Visi Misi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control-file" id="gambar" name="gambar">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content body end -->

    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    @include('template.scripts')

</body>

</html>