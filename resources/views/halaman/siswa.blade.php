<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.headerr')
    <title>E-vote | {{auth()->user()->level}} | Siswa </title>
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
                        <p class="mb-0">Data Siswa</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Siswa</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Siswa</h4>
                            <div class="text-right">
                                <div class="input-group search-area right d-lg-inline-flex d-none">
                                    <form id="searchForm">
                                        <input id="searchInput" type="text" class="form-control" placeholder="Cari sesuatu di sini..." name="query">
                                    </form>
                                </div>
                               
                            <!-- Tombol untuk membuka modal impor data siswa -->
<button type="button" class="btn btn-warning ml-2" title="Import" data-toggle="modal" data-target="#importModal">
    <i class="fa fa-upload"></i> 
</button>
<!-- Modal untuk impor data siswa -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <a href="{{ route('download-template') }}" class="btn btn-info btn-sm">
                        <i class="fa fa-download mr-1"></i> Download Template Excel
                    </a>
                </div>

                <div class="alert alert-info" role="alert">
                    <small>
                        <i class="fa fa-info-circle mr-1"></i>
                        Silakan download template terlebih dahulu sebelum melakukan import data
                    </small>
                </div>

                <!-- Form untuk mengunggah file Excel -->
                <form action="{{ route('import-siswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Pilih File Excel</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-upload mr-1"></i> Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                                <a href="/add_siswa" class="btn btn-success" title="Add">
                                    <i class="fa fa-plus"></i>
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
                                            <th style="width:50px;">
                                                <div class="custom-control custom-checkbox checkbox-info check-lg mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                                    <label class="custom-control-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th><strong>ID</strong></th>
                                            <th><strong>Name/Email</strong></th>
                                            <th><strong>Kelas</strong></th>
                                            <th><strong>Level</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th style="text-align: center;"><strong>Option</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody id="siswaTable">
                                        @foreach($users as $g)
                                        @if($g->level == 'siswa')
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox checkbox-info check-lg mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="customCheckBox2" required="">
                                                    <label class="custom-control-label" for="customCheckBox2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h6>{{$g->id}}</h6>
                                            </td>
                                            <td>
                                                <div class="media style-1">
                                                    <span class="icon-name mr-2 bgl-info text-info">{{ substr($g->name, 0, 1) }}</span>
                                                    <div class="media-body">
                                                        <h6>{{ $g->name }}</h6>
                                                        <span>{{ $g->email }}</a></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <h6>{{ $g->kelas }}</h6>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-lg badge-info light">{{$g->level}}</span></td>
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
                                                <form id="editForm_{{ $g->id }}" action="/siswa/{{ $g->id }}/edit_siswa" method="GET">
                                                    <button type="submit" class="btn btn-warning shadow btn-xs sharp"><i class="fa fa-pencil"></i></button>
                                                </form>

                                                <div class="mx-1"></div> <!-- Tambahkan jarak di sini -->

                                                <form id="deleteForm_{{ $g->id }}" action="{{ route('siswa.destroy', $g->id) }}" method="POST" class="delete-form">
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
                            <div class="d-flex justify-content-end">
                            <!-- Pagination links -->
                            {{ $users->links() }}
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    let searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        let searchValue = searchInput.value;

        fetch('/siswa/search?search=' + encodeURIComponent(searchValue))
            .then(response => response.json())
            .then(data => {
                updateTable(data);
            })
            .catch(error => console.error('Error:', error));
    });

            function updateTable(data) {
                let siswaTableBody = document.getElementById('siswaTable');
                siswaTableBody.innerHTML = '';

                data.forEach(g => {
                    let statusLabel = g.status_pemilihan == 'Belum Memilih' ? 'Belum Memilih' : 'Sudah Memilih';

                    let row = `
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox checkbox-info check-lg mr-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheckBox_${g.id}" required="">
                                    <label class="custom-control-label" for="customCheckBox_${g.id}"></label>
                                </div>
                            </td>
                            <td><h6>${g.id}</h6></td>
                            <td>
                                <div class="media style-1">
                                    <span class="icon-name mr-2 bgl-info text-info">${g.name.substring(0, 1)}</span>
                                    <div class="media-body">
                                        <h6>${g.name}</h6>
                                        <span>${g.email}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <h6>${g.kelas}</h6>
                                </div>
                            </td>
                            <td><span class="badge badge-lg badge-info light">${g.level}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle ${g.status_pemilihan == 'Sudah Memilih' ? 'text-success' : 'text-warning'} mr-1"></i>
                                    ${g.status_pemilihan}
                                </div>
                                </td>
                            <td class="text-align: left;">
                                <div class="d-flex justify-content-center">
                                    <form id="editForm_${g.id}" action="/siswa/${g.id}/edit_siswa" method="GET">
                                        <button type="submit" class="btn btn-warning shadow btn-xs sharp"><i class="fa fa-pencil"></i></button>
                                    </form>
                                    <div class="mx-1"></div>
                                    <form id="deleteForm_${g.id}" action="/siswa/${g.id}" method="POST" class="delete-form">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp delete-btn" data-id="${g.id}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `;
                    siswaTableBody.insertAdjacentHTML('beforeend', row);
                });
            }
        });
    </script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    $(document).ready(function() {
    // Menangani klik pada semua tombol hapus dengan class '.delete-btn'
    $(document).on('click', '.delete-btn', function() {
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