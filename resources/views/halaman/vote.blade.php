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
                        <p class="mb-0">Halaman Vote</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Calon OSIS</a></li>
                    </ol>
                </div>
                
            </div>
            
            <!-- row -->
            <!-- row -->
            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                            @endif
                            @if(session('update_success'))
                            <div class="alert alert-warning alert-dismissible fade show">
                                <strong>Warning!</strong> {{ session('update_success') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-error alert-dismissible fade show">
                                <strong>Success!</strong> {{ session('error') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                            @endif
            <div class="row">
                @foreach($calonOsis as $calon)
                <div class="col-lg-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-md-5 col-xxl-12">
                                    <div class="new-arrival-product mb-4 mb-xxl-4 mb-md-0">
                                        <div class="new-arrivals-img-contnent">
                                            <img src="{{ asset('foto_calon/' . $calon->gambar) }}" class="card-img-fluid" alt="{{ $calon->nama_calon }}" data-toggle="modal" data-target="#myModal{{ $calon->id }}" >    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xxl-12">
                                    <div class="new-arrival-content position-relative">
                                        <div class="comment-review star-rating">
                                            <h4><p class="price" style="margin: 2px">{{ $calon->id }}</p>
                                                <a href="">{{ $calon->nama_calon }}</a>
                                               </h4>
                                           
                                        </div>
                                        <p><strong>Periode: </strong><span> {{ $calon->periode }}</span></p>
                                        <p><strong>NIS (Nomor Induk Sekolah): </strong><span> {{ $calon->NIS }} <i class="fa fa-check-circle text-success"></i></span></p>
                                        <p><strong>Kelas: </strong><span>{{ $calon->kelas }}</span> </p>
                                        <p class="text-content">"{{ $calon->slogan }}"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal{{ $calon->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">{{ $calon->nama_calon }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex align-items-center" style="margin-top: -40px">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4">
                                            <img src="{{ asset('foto_calon/' . $calon->gambar) }}" class="img-fluid" alt="{{ $calon->nama_calon }} " style="object-fit: cover; width: 100%; height: 300px;">
                                        </div>
                                        <div class="col-md-8">                                          
                                            <h6>{{ $calon->nama_calon }}</h6>
                                            <p>{{ $calon->visimisi }}</p>                                                 
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="modal-footer">
                                <form action="{{ route('voting.vote') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="id_calon" value="{{ $calon->id }}">
                                    <button type="submit" class="btn btn-success">Vote</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        // Fungsi untuk menampilkan notifikasi toast
        function showVoteSuccessToast() {
            toastr.success('You have successfully voted!', 'Success');
        }
    
        // Fungsi untuk menampilkan notifikasi toast ketika terjadi kesalahan
        function showVoteErrorToast() {
            toastr.error('Failed to vote. Please try again later.', 'Error');
        }
    </script>

</body>

</html>