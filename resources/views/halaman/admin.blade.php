<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.headerr')
    <title>E-vote | {{auth()->user()->level}} | Admin</title>
    
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
                        <p class="mb-0">Data Admin</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Admin</h4>
                            <div class="text-right">
                          <div class="input-group search-area right d-lg-inline-flex d-none">
                            <form id="searchForm">
                                <input id="searchInput" type="text" class="form-control" placeholder="Cari sesuatu di sini..." name="query">
                            </form>
                          </div>
                    
                    <a href="/add_admin" class="btn btn-success" title="Add">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>

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
                            <div class="table-responsive">
                                <table id="adminTable" class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;">
                                                <div class="custom-control custom-checkbox checkbox-secondary check-lg mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                                    <label class="custom-control-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th><strong>ID</strong></th>
                                            <th><strong>Nama/Email</strong></th>
                                            <th><strong>Level</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th style="text-align: center"><strong>Option</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody  id="adminTableBody">
                                        @foreach($users as $g)
                                        @if($g->level == 'admin')
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox checkbox-secondary check-lg mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="customCheckBox2" required="">
                                                    <label class="custom-control-label" for="customCheckBox2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h6>{{$g->id}}</h6>
                                            </td>
                                            <td>
                                                <div class="media style-1">
                                                    <span class="icon-name mr-2 bgl-info text-secondary">{{ substr($g->name, 0, 1) }}</span>
                                                    <div class="media-body">
                                                        <h6>{{ $g->name }}</h6>
                                                        <span>{{ $g->email }}</a></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-lg badge-secondary light">{{$g->level}}</span></td>
                                           
                                                
                                            <td>
                                                @if($g->status_pemilihan == 'Belum Memilih')
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-circle text-warning mr-1"></i>Belum Memilih</div>
                                                @elseif($g->status_pemilihan == 'Sudah Memilih')
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-circle text-success mr-1"></i>Sudah Memilih</div>
                                                @endif
                                            </td>                                            
                                            <td class="text-align: left;">
                                                <div class="d-flex justify-content-center">
                                                <form id="editForm_{{ $g->id }}" action="/admin/{{ $g->id }}/edit_admin" method="GET">
                                                    <button type="submit" class="btn btn-warning shadow btn-xs sharp"><i class="fa fa-pencil"></i></button>
                                                </form>

                                                <div class="mx-1"></div> <!-- Tambahkan jarak di sini -->

                                                <form id="deleteForm_{{ $g->id }}" action="{{ route('admin.destroy', $g->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger shadow btn-xs sharp delete-btn" data-id="{{ $g->id }}"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                               <div class="d-flex justify-content-end">
                    {{ $users->links() }}
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

    <!-- Pencarian -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
    let searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        let searchValue = searchInput.value;

        fetch('/admin/search?search=' + encodeURIComponent(searchValue))
            .then(response => response.json())
            .then(data => {
                updateTable(data);
            })
            .catch(error => console.error('Error:', error));
    });

            function updateTable(data) {
                let adminTableBody = document.getElementById('adminTableBody');
                adminTableBody.innerHTML = '';

                data.forEach(g => {
                    let statusLabel = g.status_pemilihan == 'Belum Memilih' ? 'Belum Memilih' : 'Sudah Memilih';

                    let row = `
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-secondary check-lg mr-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheckBox_${g.id}" required="">
                                    <label class="custom-control-label" for="customCheckBox_${g.id}"></label>
                                </div>
                            </td>
                            <td><h6>${g.id}</h6></td>
                            <td>
                                <div class="media style-1">
                                    <span class="icon-name mr-2 bgl-info text-secondary">${g.name.substring(0, 1)}</span>
                                    <div class="media-body">
                                        <h6>${g.name}</h6>
                                        <span>${g.email}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-lg badge-secondary light">${g.level}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle ${g.status_pemilihan == 'Sudah Memilih' ? 'text-success' : 'text-warning'} mr-1"></i>
                                    ${g.status_pemilihan}
                                </div>
                            </td>
                            <td class="text-align: left;">
                                <div class="d-flex justify-content-center">
                                    <form id="editForm_${g.id}" action="/admin/${g.id}/edit_admin" method="GET">
                                        <button type="submit" class="btn btn-warning shadow btn-xs sharp"><i class="fa fa-pencil"></i></button>
                                    </form>
                                    <div class="mx-1"></div>
                                    <form id="deleteForm_${g.id}" action="/admin/${g.id}/delete" method="POST" class="delete-form">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp delete-btn" data-id="${g.id}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `;
                    adminTableBody.insertAdjacentHTML('beforeend', row);
                });
            }
        });
    </script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
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
                        // Jika pengguna mengonfirmasi penghapusan, kirim formulir hapus
                        $('#deleteForm_' + id).submit();
                        // Tampilkan alert ketika data berhasil dihapus
                        Swal.fire(
                            'Data dihapus!',
                            'Data berhasil dihapus',
                            'success'
                        )
                    }
                });
            });
        });
    </script>




</body>

</html>