<!DOCTYPE html>
<!--
Template Name: Icewall - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <meta charset="utf-8">
    <link href="{{asset('dashboards/dist/images/logo.svg')}}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Icewall admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Icewall Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Pelanggaran - Si Beka</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('dashboards/dist/css/app.css')}}" />
    <head>
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="main">
        <!-- BEGIN: Mobile Menu -->
        @include('template.mobile')
        <!-- END: Mobile Menu -->

        
        <!-- BEGIN: Top Bar -->
        @include('template.topbar')
        <!-- END: Top Bar -->
        <div class="wrapper">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                @include('template.sidebar')
                <div class="content">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Tambah Pelanggaran
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <!-- BEGIN: Form Layout -->
                            <form action="/plg/storeplg" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div  class="mb-5">
                                    <label for="name" class="form-label">Nama Siswa</label>
                                    <div  >
                                        <select class="tom-select w-full" name="id_siswa" required>
                                            @foreach ($siswa as $ket)
                                            <option  value="">--PILIH SISWA--</option>
                                            <option value="{{ $ket->id_siswa }}">{{ $ket->nama }}</option>
                                            
                                        @endforeach
                                        </select >
                                    </div>
                                </div>
                                <div  class="mb-5">
                                    <label for="id_kategori_pelanggaran" class="form-label">Pelanggaran</label>
                                    
                                    <div  >
                                        {{-- <option value="">Pilih Kategori Pelanggaran</option> --}}
                                        <select class="tom-select w-full"  onchange="getPoint(this)" name="id_kategori_pelanggaran" required>
                                            {{-- <option value="">Pilih Kategori Pelanggaran</option> --}}
                                            @foreach ($pelanggaran as $plg)
                                            <option  value="">--PILIH PELANGGARAN--</option>
                                            <option value="{{ $plg->id_kategori_pelanggaran}}">{{ $plg->kategori_pelanggaran }}</option>
                                            
                                        @endforeach
                                        </select >
                                    </div>
                                </div>
                                @error('id_kategori_pelanggaran')
                                        <p>{{$message}}</p>
                                    @enderror
                                {{-- <div  class="mb-5">
                                    <label for="name" class="form-label">Nama Guru</label>
                                    <div  >
                                        <select class="tom-select w-full" name="id" required>
                                            @foreach ($guru as $item)
                                            <option  value="">--PILIH GURU--</option>
                                            <option value="{{ $item->id}}">{{ $item->name }}</option>
                                            
                                        @endforeach
                                        </select >
                                    </div>
                                    @error('id')
                                        <p>{{$message}}</p>
                                    @enderror
                                </div> --}}
                                <div class="mb-5">
                                    <label for="point" class="form-label">Catatan</label>
                                    <input type="text" name="catatan" class="form-control">
                                </div>
                                
                                @error('catatan')
                                        <p>{{$message}}</p>
                                    @enderror

                                    <div class="mb-5">
                                        <label for="point" class="form-label">Waktu</label>
                                        <input type="datetime-local" name="waktu" class="form-control">
                                    </div>
                                <div class="mb-5">
                                    <label for="point" class="form-label">Point</label>
                                    <input type="text" name="point" id="point" class="form-control" readonly>
                                </div>

                                
                                <button type="submit" name="submit" class="btn btn-info">Simpan</button>
                            
                            </form>
                            <!-- END: Form Layout -->
                        </div>
                    </div>
                </div>
                <!-- END: Content -->
            </div>
            @include('sweetalert::alert')
           
            @include('template.scricpt')
                <script>
                    function getPoint(selectObject) {
                        var data = <?php echo json_encode($pelanggaran)?>;
                        data.forEach(element => {
                            if(element.id_kategori_pelanggaran == selectObject.value) {
                                console.log(element);
                                document.getElementById("point").value = element.point;

                            }
                        });
                    }
                </script>
        </div>   
    </html>