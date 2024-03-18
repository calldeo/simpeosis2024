
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
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content">
                    <h2 class="intro-y text-lg font-medium mt-10">
                        Data Siswa
                    </h2>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                            {{-- <button  class="btn btn-primary shadow-md mr-2" href="/tambah_guru">Add</button> --}}
                            <div class="dropdown">
                                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                                </button>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li>
                                            <a href="/tambah_siswa" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Tambah Siswa </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal1"> <i data-lucide="printer" class="w-4 h-4 mr-1"></i> Import Siswa </a>
                                        </li>
                                    
                                    </ul>
                                </div>
                            </div>
                            {{-- <button id="update-selected" class="btn btn-primary" type="button">Update Terpilih</button> --}}
                            <div class="hidden md:block mx-auto text-slate-500"></div>
                            <form action="" class="form-inline" method="GET">
                            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                
                                <div class="w-56 relative text-slate-500">
                                    <input type="search" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
                                </div>
                            </div>
                        </form>
                        </div>
                        <!-- BEGIN: Data List -->
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                      {{-- <th class="text-center">
                                        <input type="checkbox" id="select-all-checkbox">
                                      </th> --}}
                                      <th class="text-center">NISN</th>
                                      <th class="text-center">Nama</th>
                                      <th class="text-center">Kelas</th>
                                      <th class="text-center">Email</th>
                                      <th class="text-center">Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($data as $ss)
                                    <tr>
                                      {{-- <td class="text-center">
                                        <input type="checkbox" name="selected[]" value="{{ $ss->id_siswa }}" class="record-checkbox">
                                      </td> --}}
                                      <td class="text-center">{{$ss->nisn}}</td>
                                      <td class="text-center">{{$ss->nama}}</td>
                                      <td class="text-center">{{$ss->kelas}}</td>
                                      <td class="text-center">{{$ss->email}}</td>
                                      <td class="table-report__action w-40">
                                        <div class="flex justify-center items-center">
                                          <!-- Tombol Edit -->
                                          <a class="btn btn-primary" href="/siswa/{{ $ss->id_siswa }}/edit_siswa">
                                            <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                          </a>
                                          <!-- Tombol Hapus -->
                                          <form action="{{ route('siswa.destroy', $ss->id_siswa) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#delete-confirmation-modal-{{ $ss->id_siswa }}">
                                              <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                            </button>
                                          </form>
                                        </div>
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                  
                                
                            </table>
                        <div class="my-5 ">
                            {{$data ->links() }}
                        </div>
                        </div>
                        
                        
                        <!-- END: Data List -->
                        <!-- BEGIN: Pagination -->
                        
                        
                        <!-- END: Pagination -->
                    </div>

                   
                    
                    <!-- BEGIN: Delete Confirmation Modal -->
                  
                        
                    @foreach($data as $ss1)
                    <div id="delete-confirmation-modal-{{ $ss1->id_siswa }}" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="p-5 text-center">
                                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                        <div class="text-3xl mt-5">Are you sure?</div>
                                        <div class="text-slate-500 mt-2">
                                            Do you really want to delete this record? 
                                            <br>
                                            This action cannot be undone.
                                        </div>
                                    </div>
                                    <div class="px-5 pb-8 text-center">
                                        <form action="/siswa/{{ $ss1->id_siswa }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                            <button type="submit" class="btn btn-danger w-24">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    
                    <div id="delete-confirmation-modal1" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="p-5 text-center">
                                        <i data-lucide="file" class="w-16 h-16 text-primary mx-auto mt-3"></i> 
                                        <div class="text-3xl mt-5">Import Data</div>
                                        <div class="text-slate-500 mt-2">
                                            Silahkan Masukkan Data
                                        </div>
                                    </div>
                                    <div class="px-5 pb-8 text-center">
                                        <form action="/importsiswa" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="file" name="file" required="required">
                                            </div>
                                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                            <button type="submit"  class="btn btn-primary w-24" >Import</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                   
                        
                    
                    
                      
                      <!-- Modal -->
                    
                    <!-- END: Delete Confirmation Modal -->
                </div>
                <!-- END: Content -->
            </div>
                <!-- END: Content -->
            </div>
        </div>

       

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Checkbox untuk memilih semua baris
                var selectAllCheckbox = document.getElementById('select-all');
                var checkboxes = document.querySelectorAll('input[name="selected[]"]');
        
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });
        
                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        var allChecked = true;
        
                        checkboxes.forEach(function(cb) {
                            if (!cb.checked) {
                                allChecked = false;
                            }
                        });
        
                        selectAllCheckbox.checked = allChecked;
                    });
                });
        
                // Tombol Hapus Terpilih
                var deleteSelectedButton = document.getElementById('delete-selected');
        
                deleteSelectedButton.addEventListener('click', function() {
                    var checkedIds = [];
                    checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                            checkedIds.push(checkbox.value);
                        }
                    });
        
                    if (checkedIds.length > 0) {
                        var result = confirm('Are you sure you want to delete the selected records?');
                        if (result) {
                            var deleteForm = document.getElementById('delete-selected-form');
                            deleteForm.elements['selected_ids'].value = checkedIds.join(',');
                            deleteForm.submit();
                        }
                    } else {
                        alert('Please select at least one record to delete.');
                    }
                });
            });
        </script>
         --}}
        <!-- BEGIN: Dark Mode Switcher-->
        
        <!-- END: Dark Mode Switcher-->
        
        <!-- BEGIN: JS Assets-->
        @include('template.scricpt')

        @include('sweetalert::alert')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteForms = document.querySelectorAll('.delete-form');
                var confirmationModal = document.getElementById('delete-confirmation-modal');
                
                deleteForms.forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        var result = confirm('Are you sure you want to delete this record?');
                        if (result) {
                            form.submit();
                        }
                    });
                });
            });


            document.addEventListener('DOMContentLoaded', function() {
    // Tombol Update Terpilih
    var updateSelectedButton = document.getElementById('update-selected');
    var checkboxes = document.querySelectorAll('.record-checkbox');

    updateSelectedButton.addEventListener('click', function() {
        var checkedIds = [];
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedIds.push(checkbox.value);
            }
        });

        if (checkedIds.length > 0) {
            var updateUrl = '/siswa/update-selected';
            var newKelas = prompt('Masukkan kelas baru:');
            if (newKelas !== null) {
                var formData = new FormData();
                formData.append('selected', checkedIds.join(','));
                formData.append('kelas', newKelas);

                fetch(updateUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    if (response.ok) {
                        alert('Update berhasil');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat melakukan update');
                    }
                })
                .catch(function(error) {
                    alert('Terjadi kesalahan saat melakukan update');
                    console.error(error);
                });
            }
        } else {
            alert('Pilih setidaknya satu data untuk diupdate.');
        }
    });
});
        </script>
        
        <!-- END: JS Assets-->
    </body>
</html>