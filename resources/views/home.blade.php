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
                        <p class="mb-0">Dashboard</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                    </ol>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-xxl-6 col-sm-6"> 
                    <div class="widget-stat card bg-primary">
                        <div class="card-body p-4">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-users"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Sudah Memilih</p>
                                    <h3 class="text-white">{{ $jumlahSuaraSudahMemilih }}</h3>
                                    <div class="progress mb-2 bg-primary">
                                        <div class="progress-bar progress-animated bg-light" style="width: {{ $persentaseSuaraSudahMemilih }}%"></div>
                                    </div>
                                    <small>{{ number_format($persentaseSuaraSudahMemilih, 1) }}% Pemilih telah melakukan Voting </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-l-6 col-lg-6 col-xxl-6 col-sm-5">
                    <div class="widget-stat card bg-warning">
                        <div class="card-body p-4">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-user"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Belum Memilih</p>
                                    <h3 class="text-white">{{ $jumlahSuaraBelumMemilih }}</h3>
                                    <div class="progress mb-2 bg-primary">
                                        <div class="progress-bar progress-animated bg-light" style="width: {{ $persentaseSuaraBelumMemilih }}%"></div>
                                    </div>
                                    <small>{{ number_format($persentaseSuaraBelumMemilih, 1)  }}% Pemilih belum melakukan voting</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
                <div class="row">
                @foreach($calonOsis as $calon)
                    <div class="col-lg-12 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-b-30">
                                    <div class="col-md-5 col-xxl-12">
                                        <div class="new-arrival-product mb-4 mb-xxl-4 mb-md-0">
                                            <div class="new-arrivals-img-contnent">
                                                <img src="{{ asset('foto_calon/' . $calon->gambar) }}" class="card-img-fluid" alt="{{ $calon->nama_calon }}" data-toggle="modal" data-target="#myModal{{ $calon->id_calon }}" >    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-xxl-12">
                                        <div class="new-arrival-content position-relative">
                                            <div class="comment-review star-rating">
                                                <h4>
                                                    <p class="price" style="margin: 2px">{{ $calon->id }}</p>
                                                    <a href="">{{ $calon->nama_calon }}</a>
                                                </h4>
                                            </div>
                                            <p><strong>Periode: </strong><span> {{ $calon->periode }}</span></p>
                                            <p><strong>NIS (Nomor Induk Sekolah): </strong><span> {{ $calon->NIS }} <i class="fa fa-check-circle text-success"></i></span></p>
                                            <p><strong>Kelas: </strong><span>{{ $calon->kelas }}</span> </p>
                                            <p class="text-content">"{{ $calon->slogan }}"</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6>Progress
                                            <span class="pull-right">{{number_format($presentaseVotePerCalon[$calon->id], 1) }}%</span>
                                        </h6>
                                        <div class="progress ">
                                            <div class="progress-bar bg-info progress-animated" style="width: {{ $presentaseVotePerCalon[$calon->id] }}%; height:6px;" role="progressbar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


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
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form delete
                        $('#deleteForm_' + id_calon).submit();
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