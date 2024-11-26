<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.headerr')
    <title>E-vote | {{auth()->user()->level}} | Polling </title>
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
                        <p class="mb-0">Data Polling</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Polling</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Polling</h4>
                            <div class="text-right">
                                
                                                        <!-- Tombol untuk membuka modal impor data guru -->
                          
                            <!-- Modal untuk impor data guru -->
                           <a href="/cetaklaporan" target="blank" class="btn btn-info ml-2" title="Print Report">
                                    <i class="fa fa-print"></i> Print Report
                               </a>

                                
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
                                           
                                            <th style="text-align: center;"><strong>No Urut</strong></th>
                                            <th><strong>Nama Calon</strong></th>
                                            <th style="text-align: center;"><strong>Jumlah</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calonOsis as $calon)
                                        <tr>
                                            <td class="text-center"><h6>{{ $calon->id }}</h6></td> 
                                            <td>
                                                <div class="media style-1">
                                                    <img src="{{ asset('foto_calon/' . $calon->gambar) }}" class="img-fluid mr-2" alt="">
                                                    <div class="media-body">
                                                        <h6>{{ $calon->nama_calon }}</h6>
                                                        <span>{{ $calon->kelas }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><h6>{{ $calon->jumlah_vote }}</h6</td>
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
            <p>Copyright © Designed &amp; Developed by <a href="/home" target="_blank">Deo Andreas</a> 2024</p>
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
    <script>
        // Fungsi untuk merefresh halaman setiap 3 menit
        setInterval(function() {
            location.reload();
        }, 60000); // 3 menit = 180000 milidetik
    </script>
</body>
</html>