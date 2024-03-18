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
                            Tambah Penanganan
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <!-- BEGIN: Form Layout -->
                            <form action="{{ route('storepng') }}" method="POST">
                                @csrf

                                <div  class="mb-5">
                                    <label for="id_pelanggaran" class="form-label">Pelanggaran</label>
                                    
                                    <div  >
                                        {{-- <option value="">Pilih Kategori Pelanggaran</option> --}}
                                        <select class="tom-select w-full"  onchange="getSiswa()" name="id_pelanggaran" required>
                                            {{-- <option value="">Pilih Kategori Pelanggaran</option> --}}
                                            @foreach ($pelanggaran as $plg)
                                            <option  value="">--PILIH PELANGGARAN--</option>
                                            <option value="{{ $plg->id_pelanggaran}}">{{ $plg->id_pelanggaran }}</option>
                                            
                                        @endforeach
                                        </select >
                                    </div>
                                </div>

                                <div  class="mb-5">
                                    <label for="name" class="form-label">Nama Siswa</label>
                                    <div>
                                        <select class="w-full" id="selectSiswa" onchange="getSiswa()" name="id_siswa" required>
                                            {{-- @foreach ($siswa as $ket)
                                            <option  value="">--PILIH SISWA--</option>
                                            <option value="{{ $ket->id_siswa }}">{{ $ket->nama }}</option>
                                            
                                        @endforeach --}}
                                        </select >
                                    </div>
                                </div>
                                <div  class="mb-5">
                                    <label for="name" class="form-label">Status</label>
                                    <div  >
                                        <select class="tom-select w-full" name="status" required>
                                            <option  value="">--PILIH Status--</option>
                                            <option  value="Belum Ditangani">Belum Ditangani</option>
                                            <option  value="Sudah Ditangani">Sudah Ditangani</option>
                                            
                                        
                                        </select >
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label for="tindak_lanjut">Tindak Lanjut:</label>
                                    <textarea name="tindak_lanjut" id="tindak_lanjut" class="form-control"></textarea>
                                </div>

                                <div class="mb-5">
                                    <label for="point">Point:</label>
                                    <input type="number" name="point" id="point" class="form-control" readonly>
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
              
                function getSiswa() {
                    // var data = <?php echo json_encode($pelanggaran) ?>;
                    // var parent = document.getElementById('selectSiswa');
                    // var tmpData = [];
                    // var html = "";
                    // var point = 0;
                    // data.forEach(element => {
                    // if (element['point'] >= 100 && !tmpData.some(item => item['id_siswa'] === element['siswa']['id_siswa'])) {
                    //     tmpData.push(element['siswa']);
                    //     point = parseInt(element['point']);
                    // } else {
                    //         point += parseInt(element['point']);
                    //     }
                    // });
                    // console.log(point);
                    // tmpData.forEach(item => {
                    //         html += `<option value="${item['id_siswa']}">${item['nama']}</option>`;
                    // });
                    // parent.innerHTML = html;
                    // document.getElementById("point").value = point;
                    var data = <?php echo json_encode($pelanggaran) ?>;
var parent = document.getElementById('selectSiswa');
var tmpData = {};
var html = "";
var point = 0;

data.forEach(element => {
  var idSiswa = element['siswa']['id_siswa'];
  var siswa = element['siswa']['nama'];
  var idPelanggaran = element['id_pelanggaran'];
  var pelanggaranPoint = parseInt(element['point']);

  if (tmpData[idPelanggaran]) {
    tmpData[idPelanggaran].point += pelanggaranPoint;
  } else {
    tmpData[idPelanggaran] = {
      siswa: siswa,
      point: pelanggaranPoint
    };
  }
});

Object.keys(tmpData).forEach(idPelanggaran => {
  var pelanggaran = tmpData[idPelanggaran];
  html += `<option value="${idPelanggaran}">${pelanggaran.siswa} - ${pelanggaran.point} Point</option>`;
  point += pelanggaran.point;
});

console.log(point);
parent.innerHTML = html;
document.getElementById("point").value = point;

                    // <select class="tom-select w-full" name="id_siswa" required>
                    //                         @foreach ($siswa as $ket)
                    //                         <option  value="">--PILIH SISWA--</option>
                    //                         <option value="{{ $ket->id_siswa }}">{{ $ket->nama }}</option>
                                            
                    //                     @endforeach
                    //                     </select >
                }
            </script>
            
        </div>
    </html>
