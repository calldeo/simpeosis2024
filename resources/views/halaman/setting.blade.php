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
                        <p class="mb-0">Setting Waktu Vote</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Table</a></li>
                        <li class="breadcrumb-item active"><a href="#">Setting Waktu Vote</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Setting Waktu Vote</h4>
                        </div>
                        <div class="card-body">
                            @if(session('update_success'))
                            <div class="alert alert-warning alert-dismissible fade show">
                                <strong>Success!</strong> {{ session('update_success') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                            @endif
                            <div class="table-responsive" id="uptTable">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Waktu</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($settings as $waktu)
                                        <tr>
                                            <td>{{ $waktu->id_setting }}</td>
                                            <td>
                                                <span id="selectedDate_{{ $waktu->id_setting }}">
                                                    @if ($waktu->waktu)
                                                        {{ $waktu->waktu }}
                                                    @else
                                                        Tanggal belum dipilih
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#tanggalModal_{{ $waktu->id_setting}}">
                                                        Get Waktu
                                                    </button>
                                                    <button type="button" class="btn btn-primary" id="saveBtn_{{ $waktu->id_setting }}" style="display: none;">
                                                        Set Waktu
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
            <p>Copyright © Designed &amp; Developed by <a href="/home" target="_blank">SYNC</a> 2024</p>
        </div>
    </div>
    <!-- Footer end -->

    <!-- Modal -->
    @foreach($settings as $waktu)
    <div class="modal fade" id="tanggalModal_{{ $waktu->id_setting }}" tabindex="-1" role="dialog" aria-labelledby="tanggalModalLabel_{{ $waktu->id_setting }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tanggalModalLabel_{{ $waktu->id_setting }}">Get Waktu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_{{ $waktu->id_setting}}" data-id="{{ $waktu->id_setting }}" action="/save-date" method="POST">
                        @csrf
                        <input type="date" name="waktu" id="waktu"class="form-control">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveTanggal({{ $waktu->id_setting }})">Set Waktu</button>

                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Scripts -->
    <!-- Required vendors -->
    @include('template.scripts')

   <!-- JavaScript for handling save tanggal -->
<script>
    function saveTanggal(id) {
        var form = $('#form_' + id);
        var selectedDate = form.find('input[name="waktu"]').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '/update-waktu-vote', // URL endpoint baru
            method: 'POST', // Metode HTTP yang digunakan (POST sesuai dengan rute Laravel)
            data: {
                id: id,
                waktu: selectedDate,
                _token: csrfToken // Menambahkan csrf-token sebagai bagian dari data
            },
            dataType: 'json', // Tipe data yang diharapkan dari respons
            success: function(response) {
                // Log the response from the server
                console.log('Response:', response);

                // Periksa respons dari server
                if (response.success) {
                    // Tampilkan pesan sukses menggunakan SweetAlert2
                    Swal.fire(
                        'Success!',
                        'Update tanggal berhasil.',
                        'success'
                    ).then((result) => {
                        // Reload halaman setelah menampilkan pesan sukses
                        location.reload();
                    });
                } else {
                    // Jika respons tidak sukses, tampilkan pesan error
                    alert('Update tanggal gagal');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Tampilkan pesan kesalahan jika terjadi kesalahan saat melakukan permintaan AJAX
                alert('Terjadi kesalahan saat menyimpan tanggal');
            }
        });
    }
</script>

</body>
</html>