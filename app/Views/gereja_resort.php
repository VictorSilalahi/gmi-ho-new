<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resort - Distrik | GMI Wil-I | SIGMI</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>    
<body>

    <div class="container-fluid">

        <div class="row">

            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">SIGMI | Distrik</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>jemaat">Jemaat</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>gereja/stat">Gereja</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>seting">Seting</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>logout">Logout</a></li>
                    </ul>
                    </div>
                </div>
            </nav>

        </div>

        <br>

        <div class="row">


            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo(base_url()); ?>gereja/stat">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"  aria-current="page" href="<?php echo(base_url()); ?>gereja/resort">Resort</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo(base_url()); ?>gereja/pemetaan">Pemetaan</a>
                </li>
            </ul>        

        
        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card text-white bg-warning">
                        <div class="card-body text-end">
                            <h4 class="card-title">Jumlah Resort</h4>
                            <p class="card-text"><h1 class="divJumlahResort">0</h1></p>
                        </div>
                        <div class="card-footer">
                            <h7>Jumlah Resort</h7>
                        </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">

                <div class="card text-white bg-success">
                        <div class="card-body text-end">
                            <h4 class="card-title">Jumlah Gereja</h4>
                            <p class="card-text"><h1 class="divJumlahGereja">0</h1></p>
                        </div>
                        <div class="card-footer">
                            <h7>Jumlah Gereja</h7>
                        </div>
                </div>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-6">
                

                <div class="card">
                    <div class="card-header">
                        <p><h3>Data Resort</h3></p>
                    </div>
                    <div class="card-body">
                        <p>
                            <button class="btn btn-info btn-tambah-resort">Tambah Resort</button>
                        </p>
                        <table class="table table-hover" id="tblResort">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Resort</th>
                                    <th scope="col">Jumlah Gereja</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">

                <div class="card">
                    <div class="card-header">
                        <p><h3>Data Gereja</h3></p>
                    </div>
                    <div class="card-body">
                        <p id="namaResort">
                            
                        </p>
                        <table class="table" id="tblGereja">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Gereja</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalAddEditResort" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titleAddEditResort">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Nama Resort</label>
                        <input type="text" id="txtNamaResort" name="txtNamaResort" />
                        
                    </div>
                    <input type="hidden" id="txtOperasiResort" />
                    <input type="hidden" id="txtResortID" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-ok-resort">OK</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalGereja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titleSetGereja">Set Anggota Resort</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table" id="tblGerejaAnggotaResort">
                                        <thead>
                                            <th>#</th>
                                            <th>Nama Gereja</th>
                                            <th>Alamat</th>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <div class="form-check">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="1">
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>xxxx</td>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-6">
                                    <table class="table" id="tblGerejaNonAnggotaResort">
                                        <thead>
                                            <th>#</th>
                                            <th>Nama Gereja</th>
                                            <th>Alamat</th>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <div class="form-check">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="1">
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>xxxx</td>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 d-flex justify-content-end">
                                    <button class="btn btn-default btn-out-from-resort"><p class="text-end" style="font-size:60px;">&#8594;</p></button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-default btn-in-to-resort"><p style="font-size:60px;">&#8592;</p></button>
                                </div>
                            </div>

                        </div>                

                    <input type="hidden" id="txtResortIDforGereja" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalDetailGereja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detail Gereja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td><p class="text-end">Nama Gereja</p></td><td><h4><span class="badge bg-secondary" id="nama_gereja"></span></h4></td><td><p class="text-end">Pimpinan Jemaat</p></td><td><h4><span class="badge bg-secondary" id="nama_pimpinan_jemaat">Example heading </span></h4></td>
                                        </tr>
                                        <tr>
                                            <td><p class="text-end">Alamat</p></td><td><h4><span class="badge bg-secondary" id="alamat_gereja"></span></h4></td><td><p class="text-end">Mobile Phone</p></td><td><h4><span class="badge bg-secondary" id="mobile_phone_pimpinan">Example heading </span></h4></td>
                                        </tr>
                                        <tr>
                                            <td><p class="text-end">Tipe</p></td><td><h4><span class="badge bg-secondary" id="tipe_gereja"></span></h4></td><td><p class="text-end">Email</p></td><td><h4><span class="badge bg-secondary" id="email_pimpinan">Example heading </span></h4></td>
                                        </tr>
                                        <tr>
                                            <td><p class="text-end">Kondisi</p></td><td><h4><span class="badge bg-secondary" id="kondisi_gereja"></span></h4></td><td></td><td></td>
                                        </tr>
                                        <tr>
                                            <td><p class="text-end">Kepemilikan</p></td><td><h4><span class="badge bg-secondary" id="kepemilikan_gereja"></span></h4></td><td></td><td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    
                        <div class="row">

                            <div class="col-sm-12 col-md-6 col-lg-6">

                                <div class="card text-white bg-success">
                                    <div class="card-body text-end">
                                        <h4 class="card-title">Jumlah Jiwa</h4>
                                        <p class="card-text"><h1 class="divJumlahJiwa">0</h1></p>
                                    </div>
                                    <div class="card-footer">
                                        Jumlah Jiwa
                                    </div>
                                </div>

                            </div>
                            
                            
                            <div class="col-sm-12 col-md-6 col-lg-6">

                                <div class="card text-white bg-info">
                                        <div class="card-body text-end">
                                            <h4 class="card-title">Jumlah KK</h4>
                                            <p class="card-text"><h1 class="divJumlahKK">0</h1></p>
                                        </div>
                                        <div class="card-footer">
                                            <h7>Jumlah KK</h7>
                                        </div>
                                </div>

                            </div>
                        
                        </div>

                        <br>

                        <div class="row">

                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card text-white bg-secondary">
                                        <div class="card-body text-end">
                                            <h4 class="card-title">P2MI</h4>
                                            <p class="card-text"><h1 class="divJumlahP2MI">0</h1></p>
                                        </div>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card text-white bg-secondary">
                                        <div class="card-body text-end">
                                            <h4 class="card-title">P3MI</h4>
                                            <p class="card-text"><h1 class="divJumlahP3MI">0</h1></p>
                                        </div>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card text-white bg-secondary">
                                        <div class="card-body text-end">
                                            <h4 class="card-title">PWMI</h4>
                                            <p class="card-text"><h1 class="divJumlahPWMI">0</h1></p>
                                        </div>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card text-white bg-secondary">
                                        <div class="card-body text-end">
                                            <h4 class="card-title">PRMI</h4>
                                            <p class="card-text"><h1 class="divJumlahPRMI">0</h1></p>
                                        </div>
                                </div>

                            </div>

                        </div>

                        <br>

                        <div class="row">

                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card" style="width: 95%;">
                                    <div class="card-body">
                                        <h5 class="card-title">Tipe Jemaat</h5>
                                        <canvas id="TipeJemaat"></canvas>
                                    </div>
                                    <div class="card-footer">
                                        Tipe Jemaat
                                    </div>
                                </div>

                            </div>


                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card" style="width: 95%;">
                                    <div class="card-body">
                                        <h5 class="card-title">Kelompok Usia</h5>
                                        <canvas id="KelompokUsia"></canvas>
                                    </div>
                                    <div class="card-footer">
                                        Kelompok Usia
                                    </div>
                                </div>
                            
                            </div>


                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card" style="width: 95%;">
                                    <div class="card-body">
                                        <h5 class="card-title">Pendidikan Terakhir</h5>
                                        <canvas id="PendidikanTerakhir"></canvas>
                                    </div>
                                    <div class="card-footer">
                                        Pendidikan Terakhir
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-3 col-lg-3">

                                <div class="card" style="width: 95%;">
                                    <div class="card-body">
                                        <h5 class="card-title">Pekerjaan</h5>
                                        <canvas id="Pekerjaan"></canvas>
                                    </div>
                                    <div class="card-footer">
                                        Pekerjaan
                                    </div>
                                </div>

                            </div>

                        </div>

                        <br>
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Aktifitas : Kebaktian (12 bulan terakhir)</h5>
                                        <canvas id="Kebaktian" style="height:30px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Aktifitas : Kegiatan (12 bulan terakhir)</h5>
                                        <canvas id="Kegiatan" style="height:30px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Aktifitas : Data Jemaat (12 bulan terakhir)</h5>
                                        <canvas id="OperasiDataJemaat" style="height:30px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jumlah Jemaat (12 bulan terakhir)</h5>
                                        <canvas id="JumlahJemaat" style="height:30px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-12 col-md-4 col-lg-4">

                                <div class="card text-white bg-warning">
                                    <div class="card-body text-end">
                                        <h4 class="card-title">Jumlah Jiwa Awal</h4>
                                        <p class="card-text"><h1 class="jiwaAwal">0</h1></p>
                                    </div>
                                    <div class="card-footer">
                                        Jumlah Jiwa
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">

                                <div class="card text-white bg-warning">
                                    <div class="card-body text-end">
                                        <h4 class="card-title">Jumlah Jiwa Akhir</h4>
                                        <p class="card-text"><h1 class="jiwaAkhir">0</h1></p>
                                    </div>
                                    <div class="card-footer">
                                        Jumlah Jiwa
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">

                                <div class="card text-white bg-info">
                                    <div class="card-body text-end">
                                        <h4 class="card-title">Perubahan</h4>
                                        <p class="card-text"><h1 class="jiwaPerubahan">0</h1></p>
                                    </div>
                                    <div class="card-footer">
                                        Jumlah Jiwa
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
        </div>


    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>" />
    <input type="hidden" id="gereja_url" value="<?php echo(getenv('app.gerejaURL')); ?>" />
</body>
    <script src="<?php echo(base_url()); ?>assets/js/inside/gereja_resort.js" type="module"></script>

</html>