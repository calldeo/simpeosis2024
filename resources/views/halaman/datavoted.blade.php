<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.headerr')
    <title>E-vote | {{auth()->user()->level}} | Voted </title>
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
                        <p class="mb-0">Data Voted</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Voted</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Voted</h4>
                            <div class="text-right">
                                {{-- <div class="input-group search-area right d-lg-inline-flex d-none">
                                    <form id="searchForm"  method="GET">
                                        <input id="searchInput" type="text" class="form-control"
                                            placeholder="Find something here..." name="query">
                                        <!-- Tidak perlu tombol submit -->
                                    </form>
                                </div> --}}
                              <!-- Tombol untuk membuka modal impor data guru -->
{{-- <button type="button" class="btn btn-warning ml-2" title="Import" data-toggle="modal" data-target="#importModal">
    <i class="fa fa-upload"></i> 
</button> --}}
<!-- Modal untuk impor data guru -->
{{-- <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengunggah file Excel -->
                <form action="{{ route('import-guru') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Pilih File Excel</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

                                {{-- <a href="/add_guruu" class="btn btn-success" title="Add">
                                    <i class="fa fa-plus"></i>
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                            @endif
                            @if(session('update_success'))
                            <div class="alert alert-warning alert-dismissible fade show">
                                <strong>Success!</strong> {{ session('update_success') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                            @endif
                            <div class="table-responsive" id="uptTable">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                           
                                            <th><strong>Nama</strong></th>
                                            <th><strong>Level</strong></th>
                                            <th><strong>Nama Calon</strong></th>
                                            <th><strong>Tanggal</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasilVotings as $hasilVoting)
                                        <tr>
                                            <td>
                                                <div class="media style-1">
                                                    @php
                                                    $iconClass = '';
                                                    $badgeClass = '';
                                                    if ($hasilVoting->level == 'guru') {
                                                        $iconClass = 'bgl-info text-info';
                                                        $badgeClass = 'badge-info';
                                                    } elseif ($hasilVoting->level == 'siswa') {
                                                        $iconClass = 'bgl-light';
                                                        $badgeClass = 'badge-light';
                                                    } elseif ($hasilVoting->level == 'admin') {
                                                        $iconClass = 'bgl-success text-success';
                                                        $badgeClass = 'badge-success';
                                                    }
                                                    @endphp
                                                    <span class="icon-name mr-2 {{ $iconClass }}">{{ substr($hasilVoting->name, 0, 1) }}</span>
                                                    <div class="media-body">
                                                        <h6>{{ $hasilVoting->name }}</h6>
                                                        <span>{{ $hasilVoting->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-lg {{ $badgeClass }} light">{{ $hasilVoting->level }}</span></td> 
                                            <td>{{ $hasilVoting->nama_calon }}</td>
                                            <td><h6 class="text-primary">{{ $hasilVoting->tanggal }}</h6></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                             <div class="d-flex justify-content-end">
                            <!-- Pagination links -->
                           
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content body end -->

    <!-- Footer start -->
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by <a href="/home" target="_blank">SYNC</a> 2024</p>
        </div>
    </div>
    <!-- Footer end -->

    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    @include('template.scripts')

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
       $(document).ready(function() {
    // Menangani klik pada semua tombol hapus dengan class '.delete-btn'
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        // Tampilkan sweet alert ketika tombol hapus diklik
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi penghapusan, kirim formulir hapus
                $('#deleteForm_' + id).submit();
                // Tampilkan alert ketika data berhasil dihapus
                Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                )
            }
        });
    });
});
    </script>
    
</body>
</html>