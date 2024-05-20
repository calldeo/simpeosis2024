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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Calon OSIS</a></li>
                    </ol>
                </div>
                
            </div>
            <a href="/add_osis" class="btn btn-success" title="Add" style="margin-bottom:10px ">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
            </div>
            @endif
            @if(session('update_success'))
            <div class="alert alert-warning alert-dismissible fade show">
                <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <strong>Success!</strong> {{ session('update_success') }}
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
            </div>
            @endif
            <!-- row -->
            <!-- row -->
            <div class="row">
                @foreach($calonOsis as $calon)
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent">
                                    <img src="{{ asset('foto_calon/' . $calon->gambar) }}" class="card-img-fluid" alt="{{ $calon->nama_calon }}" data-toggle="modal" data-target="#myModal{{ $calon->id }}" >    
                                </div>
                                <div class="new-arrival-content text-center mt-3">
                                    <h4><a href="">{{ $calon->nama_calon }}</a></h4>
                                </div>
                                <div class="btn-group d-flex justify-content-center" style="margin-top: 10px" role="group">
                                    <form id="editForm_{{ $calon->id}}" action="/calonosis/{{ $calon->id}}/edit_osis" method="GET">
                                        <button type="submit" class="btn btn-warning shadow btn-xs sharp"><i class="fa fa-pencil"></i></button>
                                    </form>
                                    <form id="deleteForm_{{ $calon->id}}" action="{{ route('osis.destroy', $calon->id) }}" method="POST" class="delete-form ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp delete-btn" data-id="{{ $calon->id }}"><i class="fa fa-trash"></i></button>
                                    </form>
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
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var id= $(this).data('id');
                // Tampilkan sweet alert ketika tombol hapus diklik
                Swal.fire({
                    title: 'Apakah anda yakin hapus data ini?',
                    text: "Data akan dihapus secara permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, hapus data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form delete
                        $('#deleteForm_' + id).submit();
                    }
                });
            });
        });
    </script>

</body>

</html>