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
    <title>Siswa - Si Beka</title>
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
                            Tambah Siswa
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <!-- BEGIN: Form Layout -->
                            <form action="/siswa/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-5">
                                    <label for="name" class="form-label">NISN</label>
                                    <input type="number" name="nisn"  id="nisn" class="form-control"   >
                                </div>
                                <div class="mb-5">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="nama"  id="nama" class="form-control" min="6" max="10" onkeyup="lettersOnly(this)"  >
                                </div>
                                <div  class="mb-5">
                                    <label for="name" class="form-label">Kelas</label>
                                    <div  >
                                        <select class="tom-select w-full" name="kelas" >
                                            <option  value="">--PILIH KELAS--</option>
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
                                            
                                        </select >
                                    </div>
                                </div>    
                                  <div class="mb-5">
                                    <label for="email" class="form-label">E mail</label>
                                    <input type="email" name="email" class="form-control"  >
                                  </div>
                                  <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control">
                                        <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                            <i id="passwordIcon"data-lucide="eye"></i>
                                        </button>
                                    </div>
                                </div> 
                                
                                <input type="submit" name="submit" class="btn btn-info" value="Simpan">
                            
                            </form>
                            <!-- END: Form Layout -->
                        </div>
                    </div>
                </div>
                <!-- END: Content -->
            </div>

           
            @include('template.scricpt')
            <!-- END: JS Assets-->

            @include('sweetalert::alert')
            <script>
                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#password');
                const passwordIcon = document.querySelector('#passwordIcon');
            
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
            
                    passwordIcon.classList.toggle('bi-eye');
                    passwordIcon.classList.toggle('bi-eye-slash');
                });
            </script>
            
            
        </div>   
    </html>