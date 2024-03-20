<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Calon OSIS Baru</title>
    @include('template.headerr')
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
                                <div class="form-group">
                                    <label for="nama_calon">Nama Calon</label>
                                    <input type="text" class="form-control" id="nama_calon" name="nama_calon" placeholder="Nama Calon">
                                </div>
                                <div class="form-group">
                                    <label for="visimisi">Visi Misi</label>
                                    <textarea class="form-control" id="visimisi" name="visimisi" rows="3" placeholder="Visi Misi"></textarea>
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
