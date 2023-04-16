<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Detail</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="51">

    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Tentang</h1>
                <h1 class="position-absolute text-uppercase" style="color:#272358">Tentang Karyawan</h1>
            </div>
            <div class="row align-items-center">
                @foreach ($karyawan as $karyawans)
                    <div class="col-lg-7">
                        <h3 class="mb-4">{{ $karyawans->nama }}</h3>
                        <table class="tabel">
                            <tbody>
                                <tr>
                                    <td>Departemen</td>
                                    <td>: {{ $karyawans->nama_dept }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>: {{ $karyawans->telp }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td>: {{ $karyawans->tanggal_masuk }}</td>
                                </tr>
                                <tr>
                                    <td>Kota Tinggal</td>
                                    <td>: {{ $karyawans->kota_tinggal }}</td>
                                </tr>
                                <tr>
                                    <td>Penempatan</td>
                                    <td>: {{ $karyawans->kota_penempatan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/typed/typed.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
