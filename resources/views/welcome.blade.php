<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test Indoprima Gemilang</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
    @vite(['resources/js/app.js'])

</head>

<body>
    <div id="app">
        <main>
            <h2 class="m-4 text-center"><b>Soal Test Indoprima Gemilang</b></h2>
            <div class="card m-3">
                <div class="card-header">
                    <h5>Soal 3</h5>
                </div>
                <div class="card-body">
                    <h6><b>Departemen</b></h6>
                    <button type="button" class="btn btn-sm btn-primary mt-3 mb-3" data-bs-toggle="modal"
                        data-bs-target="#ModalDepartemen">Tambah</button>
                    <div class="table-responsive mt-3">
                        <table class="table" id="departemen">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No.
                                    </th>
                                    <th>Nama Departemen</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($departemen as $departemens)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $departemens->nama_dept }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" id="edit-departemen"><i
                                                    class="fas fa-pen"
                                                    onclick="edit_departemen('{{ $departemens->id }}')"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class='fas fa-trash'
                                                    onclick="hapus_departemen('{{ $departemens->id }}')"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h6><b>Karyawan</b></h6>
                    <button type="button" class="btn btn-sm btn-primary mt-3 mb-3" data-bs-toggle="modal"
                        data-bs-target="#ModalKaryawan">Tambah</button>
                    <a class="btn btn-success btn-sm" href="{{ route('export') }}">Export File</a>
                    <div class="table-responsive">
                        <table class="table" id="karyawan">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No.
                                    </th>
                                    <th>Nama</th>
                                    <th>Departemen</th>
                                    <th>Kota Penempatan</th>
                                    <th>Masa Kerja</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($karyawan as $karyawans)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $karyawans->nama }}</td>
                                        <td>{{ $karyawans->nama_dept }}</td>
                                        <td>{{ $karyawans->kota_penempatan }}</td>
                                        <?php $awal = new DateTime($karyawans->tanggal_masuk);
                                        $akhir = new DateTime(); // Waktu sekarang
                                        $diff = $awal->diff($akhir); ?>
                                        <td>{{ $diff->y }} tahun, {{ $diff->m }} bulan</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" id="edit-karyawan"><i
                                                    class="fas fa-pen"
                                                    onclick="edit_karyawan('{{ $karyawans->id }}')"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class='fas fa-trash'
                                                    onclick="hapus_karyawan('{{ $karyawans->id }}')"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h6><b>Kalender Ulang Tahun Karyawan</b></h6>
                    <div id="calendar"></div>
                    <hr>
                    <h6><b>Rekap Laporan Jumlah Karyawan per Department dan Penempatan</b></h6>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach ($departemen as $departemens)
                                    <tr>
                                        <td><b>{{ $departemens->nama_dept }}<b></td>
                                        <td>
                                            <?php $cdepartemen = ('App\Models\Karyawan')::where('departemen_id', $departemens->id)->count(); ?>
                                            {{ $cdepartemen }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach ($karyawan as $karyawans)
                                    <tr>
                                        <td><b>{{ $karyawans->kota_penempatan }}<b></td>
                                        <td>
                                            <?php $ckaryawan = ('App\Models\Karyawan')::where('kota_penempatan', $karyawans->kota_penempatan)->count(); ?>
                                            {{ $ckaryawan }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="ModalDepartemen">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Departemen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-tambah-departemen">
                                <label for="nama_dept" class="col-form-label">Nama Departemen</label>
                                <input type="text" name="nama_dept" id="nama_dept" class="form-control"
                                    placeholder="Masukkan Nama Departemen" required>
                                @error('nama_dept')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close-departemen"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="simpan-departemen">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="ModalDepartemenUpdate">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Departemen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-departemen-update">
                                <input type="hidden" name="id_edit" id="id_edit" class="form-control">
                                <label for="nama_dept_edit" class="col-form-label">Nama Departemen</label>
                                <input type="text" name="nama_dept_edit" id="nama_dept_edit" class="form-control"
                                    required>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close-departemen-edit"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="update-departemen">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="ModalHapusDepartemen">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Departemen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus departemen?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="btn-hapus-departemen">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="ModalKaryawan">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-tambah-karyawan">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="nama" class="col-form-label">Nama Karyawan</label>
                                        <input type="text" name="nama" id="nama" class="form-control"
                                            placeholder="Masukkan Nama Karyawan" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="noKTP" class="col-form-label">Nomor KTP</label>
                                        <input type="text" name="noKTP" id="noKTP" class="form-control"
                                            placeholder="Masukkan Nomor KTP" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="telp" class="col-form-label">Nomor Telepon</label>
                                        <input type="text" name="telp" id="telp" class="form-control"
                                            placeholder="Masukkan Nomor Telepon" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="kota_tinggal" class="col-form-label">Kota Tinggal</label>
                                        <input type="text" name="kota_tinggal" id="kota_tinggal"
                                            class="form-control" placeholder="Masukkan Kota Tinggal" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tanggal_lahir" class="col-form-label">Tinggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            class="form-control" placeholder="Masukkan Tanggal Lahir" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="tanggal_masuk" class="col-form-label">Tinggal Masuk</label>
                                        <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                                            class="form-control" placeholder="Masukkan Tanggal Masuk" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="kota_penempatan" class="col-form-label">Kota Penempatan</label>
                                        <input type="text" name="kota_penempatan" id="kota_penempatan"
                                            class="form-control" placeholder="Masukkan Kota Penempatan" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="departemen_id" class="col-form-label">Departemen</label>
                                        <select class="form-select" id="departemen_id"
                                            aria-label="Default select example" name="departemen_id" required>
                                            <option selected disabled>Pilih Departemen</option>
                                            @foreach ($departemen as $departemens)
                                                <option value="{{ $departemens->id }}">{{ $departemens->nama_dept }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close-karyawan"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="simpan-karyawan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="ModalHapusKaryawan">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus karyawan?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="btn-hapus-karyawan">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="ModalKaryawanUpdate">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-karyawan-update">
                                <input type="hidden" name="id_edit" id="id_edit" class="form-control">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="nama_edit" class="col-form-label">Nama</label>
                                        <input type="text" name="nama_edit" id="nama_edit" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="noKTP_edit" class="col-form-label">Nomor KTP</label>
                                        <input type="text" name="noKTP_edit" id="noKTP_edit" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tanggal_masuk_edit" class="col-form-label">Tanggal Masuk</label>
                                        <input type="text" name="tanggal_masuk_edit" id="tanggal_masuk_edit"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="tanggal_lahir_edit" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir_edit" id="tanggal_lahir_edit"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="kota_tinggal_edit" class="col-form-label">Kota Tinggal</label>
                                        <input type="text" name="kota_tinggal_edit" id="kota_tinggal_edit"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="kota_penempatan_edit" class="col-form-label">Kota
                                            Penempatan</label>
                                        <input type="text" name="kota_penempatan_edit" id="kota_penempatan_edit"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="telp_edit" class="col-form-label">Nomor Telepon</label>
                                        <input type="text" name="telp_edit" id="telp_edit" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="testsub">
                                            <label for="kota_penempatan_edit" class="col-form-label">Departemen</label>
                                            <select name="departemen_id" class="form-control" id="departemen_id">
                                                <option selected disabled>Pilih Departemen</option>
                                                @foreach ($departemen as $departemens)
                                                    <option value="{{ $departemens->id }}">
                                                        {{ $departemens->nama_dept }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close-karyawan-edit"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="update-karyawan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: [
                    @foreach ($karyawan as $karyawans)
                        {
                            title: '{{ $karyawans->nama }}',
                            start: '{{ $karyawans->tanggal_lahir }}',
                            url: '{{ route('detailKaryawan', $karyawans->id) }}'
                        },
                    @endforeach
                ]
            })
        });
    </script>
    <script type="text/javascript">
        $("#departemen").dataTable();
        $("#karyawan").dataTable();
        var msg = "{{ Session::get('alert') }}";
        var exist = "{{ Session::has('alert') }}";
        if (exist) {
            alert(msg);
        }

        $('#simpan-departemen').click(function() {
            if ($("#form-tambah-departemen")[0].checkValidity()) {
                var formdata = new FormData(document.getElementById("form-tambah-departemen"));
                $.ajax({
                    type: "POST",
                    url: "/add-departemen/save",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#form-tambah-departemen')[0].reset();
                        $('#close-departemen').click();
                        window.location.reload();
                    },
                    error: function(error) {
                        alert("Data Sudah Pernah Diinputkan!");
                    }
                });

            } else {
                $("#form-tambah-departemen")[0].reportValidity();
            }
        });

        function edit_departemen(id) {
            //console.log(id);
            $.ajax({
                type: "GET",
                url: "/edit-departemen",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    // show modal
                    $('#ModalDepartemenUpdate').modal('show');
                    // fill form in modal
                    $('#id_edit').val(response.data.id);
                    $('#nama_dept_edit').val(response.data.nama_dept);
                },
            });
        }

        $('#update-departemen').click(function() {
            if ($("#form-departemen-update")[0].checkValidity()) {
                var formdata = new FormData(document.getElementById("form-departemen-update"));
                $.ajax({
                    type: "POST",
                    url: "/update-departemen",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#close-departemen-edit').click();
                        window.location.reload();
                    },
                });
            } else {
                $("#form-departemen-update")[0].reportValidity();
            }
        });

        function hapus_departemen(id) {
            $.ajax({
                type: "GET",
                url: "/hapus-departemen",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(id);
                    // show modal
                    $('#ModalHapusDepartemen').modal('show');
                    $('#btn-hapus-departemen').attr('onclick', `del_data_departemen(` + response.data + `)`);
                },
            });
        }


        function del_data_departemen(id) {
            $.ajax({
                type: "POST",
                url: "/destroy-departemen",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    $('#ModalHapusDepartemen').modal('hide');
                    window.location.reload();
                },
            });
        }

        $('#simpan-karyawan').click(function() {
            if ($("#form-tambah-karyawan")[0].checkValidity()) {
                var formdata = new FormData(document.getElementById("form-tambah-karyawan"));
                $.ajax({
                    type: "POST",
                    url: "/add-karyawan/save",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#form-tambah-karyawan')[0].reset();
                        $('#close-karyawan').click();
                        window.location.reload();
                    },
                    error: function(error) {
                        alert("No. KTP Sudah Pernah Diinputkan!");
                    }
                });

            } else {
                $("#form-tambah-karyawan")[0].reportValidity();
            }
        });

        function hapus_karyawan(id) {
            $.ajax({
                type: "GET",
                url: "/hapus-karyawan",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(id);
                    // show modal
                    $('#ModalHapusKaryawan').modal('show');
                    $('#btn-hapus-karyawan').attr('onclick', `del_data_karyawan(` + response.data + `)`);
                },
            });
        }


        function del_data_karyawan(id) {
            $.ajax({
                type: "POST",
                url: "/destroy-karyawan",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    $('#ModalHapusKaryawan').modal('hide');
                    window.location.reload();
                },
            });
        }

        function edit_karyawan(id) {
            //console.log(id);
            $.ajax({
                type: "GET",
                url: "/edit-karyawan",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    // show modal
                    $('#ModalKaryawanUpdate').modal('show');
                    // fill form in modal
                    $('#id_edit').val(response.data.id);
                    $('#nama_edit').val(response.data.nama);
                    $('#telp_edit').val(response.data.telp);
                    $('#noKTP_edit').val(response.data.noKTP);
                    $('#kota_tinggal_edit').val(response.data.kota_tinggal);
                    $('#kota_penempatan_edit').val(response.data.kota_penempatan);
                    $('#tanggal_masuk_edit').val(response.data.tanggal_masuk);
                    $('#tanggal_lahir_edit').val(response.data.tanggal_lahir);
                    $("div#testsub select").val(response.data.depatemen_id).change();
                },
            });
        }

        $('#update-karyawan').click(function() {
            if ($("#form-karyawan-update")[0].checkValidity()) {
                var formdata = new FormData(document.getElementById("form-karyawan-update"));
                $.ajax({
                    type: "POST",
                    url: "/update-karyawan",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#close-karyawan-edit').click();
                        window.location.reload();
                    },
                });
            } else {
                $("#form-karyawan-update")[0].reportValidity();
            }
        });
    </script>
</body>

</html>
