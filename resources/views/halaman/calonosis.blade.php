<!DOCTYPE html>
<html lang="en">

<head>
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
                        <p class="mb-0">Data Calon OSIS</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">calon OSIS</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Calon OSIS</h4>
                            <div class="text-right">
                                <a href="/add_osis" class="btn btn-success" title="Add">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Nama Calon</th>
                                            <th style="text-align: center;">Gambar</th>
                                            <th style="text-align: center;">Detail</th>
                                            <th style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($calonOsis as $calon)
                                        <tr>
                                            <td style="text-align: center;">{{ $calon->nama_calon }}</td>
                                            <td style="text-align: center;">
                                                <img class="img-rounded" width="100%" src="{{ asset('assets/foto_calon/' . $calon->gambar) }}" alt="{{ $calon->nama_calon }}" data-toggle="modal" data-target="#myModal{{ $calon->id_calon }}">
                                            </td>
                                            <td style="text-align: center;">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $calon->id_calon }}">
                                                    Lihat Detail
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal{{ $calon->id_calon }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">{{ $calon->nama_calon }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <img class="img-rounded" width="100%" src="{{ asset('foto_calon/' . $calon->gambar) }}" alt="{{ $calon->nama_calon }}">

                                                                <br><br>
                                                                <p>{{ $calon->visimisi }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                             <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                <form id="editForm_{{ $calon->id_calon}}" action="/calonosis/{{ $calon->id_calon}}/edit_osis" method="GET">
                                                    <button type="submit" class="btn btn-warning shadow btn-xs sharp"><i class="fa fa-pencil"></i></button>
                                                </form>

                                                <div class="mx-1"></div> <!-- Tambahkan jarak di sini -->

                                                <form id="deleteForm_{{ $calon->id_calon}}" action="{{ route('osis.destroy', $calon->id_calon) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger shadow btn-xs sharp delete-btn" data-id="{{ $calon->id_calon}}"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var id_calon= $(this).data('id');
                // Tampilkan sweet alert ketika tombol hapus diklik
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                   
