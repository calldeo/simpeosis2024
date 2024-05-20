<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.headerr')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    @include('template.topbarr')
    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    @include('template.sidebarr')
    <!--**********************************
            Sidebar end
        ***********************************-->

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <!-- Add Project -->
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-0">Edit Data Calon OSIS</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Data Calon OSIS</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Data Calon OSIS</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="/calonosis/{{ $calon->id }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Nama Calon *</label>
                                            <input type="text" class="form-control" name="nama_calon" value="{{ $calon->nama_calon }}" placeholder="Masukkan Nama Calon" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Periode</label>
                                            <input type="text" class="form-control" name="periode" value="{{ $calon->periode }}" placeholder="Masukkan Periode" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>NIS *</label>
                                            <input type="text" class="form-control" name="NIS" value="{{ $calon->NIS }}" placeholder="Masukkan NIS" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Kelas</label>
                                            <input type="text" class="form-control" name="kelas" value="{{ $calon->kelas }}" placeholder="Masukkan kelas" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Slogan *</label>
                                        <input type="text" class="form-control" name="slogan" value="{{ $calon->slogan }}" placeholder="Masukkan Slogan" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Visi Misi *</label>
                                        <textarea class="form-control" name="visimisi" rows="5" placeholder="Masukkan Visi Misi Calon" required>{{ $calon->visimisi }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-label">Gambar *</label>
                                        <input type="file" class="form-control-file" name="gambar" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn mr-2 btn-primary">Submit</button>
                                    <a  class="btn btn-light">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="/home" target="_blank">SYNC</a> 2024</p>
        </div>
    </div>
    <!--**********************************
            Footer end
        ***********************************-->

    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @include('template.scripts')
</body>

</html>