<!DOCTYPE html>

<html lang="en">

<head>
    @include('template.headerr')
    <title>E-vote | {{auth()->user()->level}} | Add</title>

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
                <div class="modal fade" id="addProjectSidebar">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Project</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Project Name</label>
                                        <input type="text" class="form-control" name="project_name">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Deadline</label>
                                        <input type="date" class="form-control" name="deadline">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Client Name</label>
                                        <input type="text" class="form-control" name="client_name">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary">CREATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <p class="mb-0">Validation</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Siswa</a></li>
                        </ol>
                    </div>
                </div>
                  @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <strong>Error!</strong> {{ session('error') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                            @endif
                <!-- row -->
                <div class="row">
                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="form-valide-with-icon" action="/siswaa/store" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                        <label class="text-label">Name *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            </div>
                                            <input type="text" class="form-control" id="val-username1" name="name" placeholder="Enter a name.." value="{{old('name')}}"required>
                                        </div>
                                          @error('name')
                                            <span class="mt-4 text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                  <div class="form-group">
                                            <label class="text-label">Email *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <input type="text" class="form-control" id="val-username1" name="email" placeholder="Enter a email.." value="{{old('email')}}"required>
                                            </div>
                                             @error('email')
                                            <span class="mt-4 text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    <div class="form-group">
                                        <label class="text-label">Password *</label>
                                        <div class="input-group transparent-append">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input type="password" class="form-control" id="dz-password" name="password" placeholder="Choose a safe one.." required>
                                            <div class="input-group-append show-pass ">
                                                <span class="input-group-text "> 
                                                    <i class="fa fa-eye-slash"></i>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                          @error('password')
                                            <span class="mt-4 text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Select list (select one): *</label>
                                        <select class="form-control default-select" id="sel1" name="level" required>
                                            <option value="">--PILIH LEVEL--</option>
                                            {{-- <option value="admin">Admin</option>
                                            <option value="guru">Guru</option> --}}
                                            <option value="siswa">Siswa</option>
                                        </select>
                                          @error('level')
                                            <span class="mt-4 text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas: *</label>
                                        <select class="form-control default-select" id="sel" name="kelas" required>
                                            <option value="">--PILIH KELAS--</option>
                                            {{-- <option value="admin">Admin</option>
                                            <option value="guru">Guru</option> --}}
                                            <option  value="X KI1">X BFI</option>
                                            <option  value="X KI1">X DKV1</option>
                                            <option  value="X KI1">X DKV2</option>
                                            <option  value="X KI1">X PG</option>
                                            <option  value="X KI1">X DKV</option>
                                            <option  value="X KI1">X KI1</option>
                                            <option  value="X KI2">X KI2</option>
                                            <option  value="X MM1">X MM1</option>
                                            <option  value="X MM2">X MM2</option>
                                            <option  value="X MM3">X MM3</option>
                                            <option  value="X RPL1">X RPL1</option>
                                            <option  value="X RPL2">X RPL2</option>
                                            <option  value="XI KI1">XI KI1</option>
                                            <option  value="XI KI2">XI KI2</option>
                                            <option  value="XI MM1">XI MM1</option>
                                            <option  value="XI MM2">XI MM2</option>
                                            <option  value="XI MM3">XI MM3</option>
                                            <option  value="XI RPL1">XI RPL1</option>
                                            <option  value="XI RPL2">XI RPL2</option>
                                            <option  value="XII KI1">XII KI1</option>
                                            <option  value="XII KI2">XII KI2</option>
                                            <option  value="XII MM1">XII MM1</option>
                                            <option  value="XII MM2">XII MM2</option>
                                            <option  value="XII MM3">XII MM3</option>
                                            <option  value="XII RPL1">XII RPL1</option>
                                            <option  value="XII RPL2">XII RPL2</option>
                                        </select>
                                          @error('kelas')
                                            <span class="mt-4 text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input id="checkbox1" class="form-check-input" type="checkbox" required>
                                            <label for="checkbox1" class="form-check-label">Check me out *</label>
                                        </div>
                                    </div>

                                        <button type="submit" class="btn mr-2 btn-primary">Submit</button>
                                      <button type="submit" class="btn btn-light" onclick="redirectToSiswa()">Cancel</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert library -->
</body>
</html>