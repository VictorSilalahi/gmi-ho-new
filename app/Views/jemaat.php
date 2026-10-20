<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jemaat Distrik | GMI Wil-I | SIGMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
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
                        <li class="nav-item"><a class="nav-link  active" aria-current="page" href="<?php echo(base_url()); ?>jemaat">Jemaat</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>gereja/stat">Gereja</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>seting">Seting</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>logout">Logout</a></li>
                    </ul>
                    </div>
                </div>
            </nav>

        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-6">

                <div class="card text-white bg-success">
                    <div class="card-body text-end">
                        <h5 class="card-title">Jumlah Jiwa</h5>
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
                                <h5 class="card-title">P2MI</h5>
                                <p class="card-text"><h1 class="divJumlahP2MI">0</h1></p>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">

                        <div class="card text-white bg-secondary">
                            <div class="card-body text-end">
                                <h5 class="card-title">P3MI</h5>
                                <p class="card-text"><h1 class="divJumlahP3MI">0</h1></p>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">

                        <div class="card text-white bg-secondary">
                            <div class="card-body text-end">
                                <h5 class="card-title">PWMI</h5>
                                <p class="card-text"><h1 class="divJumlahPWMI">0</h1></p>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">

                        <div class="card text-white bg-secondary">
                            <div class="card-body text-end">
                                <h5 class="card-title">PRMI</h5>
                                <p class="card-text"><h1 class="divJumlahPRWMI">0</h1></p>
                            </div>
                        </div>

                    </div>
            

        </div>

        <br><hr><br>

        <div class="row">

            <div class="col-sm-12 col-md-3 col-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tipe Jemaat</h5>
                        <canvas id="TipeJemaat"></canvas>
                    </div>
                    <div class="card-footer">
                        Tipe Jemaat
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="height:550px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Penuh</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="jPenuh">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Persiapan</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="jPersiapan">x</span></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="col-sm-12 col-md-3 col-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelompok Usia</h5>
                        <canvas id="KelompokUsia"></canvas>
                    </div>
                    <div class="card-footer">
                        Kelompok Usia
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="height:550px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Anak-anak</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="kuAnakAnak">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Remaja</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="kuRemaja">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Pemuda</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="kuPemuda">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Dewasa</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="kuDewasa">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Lansia</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="kuLansia">x</span></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="col-sm-12 col-md-3 col-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendidikan Terakhir</h5>
                        <canvas id="PendidikanTerakhir"></canvas>
                    </div>
                    <div class="card-footer">
                        Pendidikan Terakhir
                    </div>
                </div>


                <div class="card">
                    <div class="card-body" style="height:550px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">None</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptNone">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">SD</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptSD">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">SMP</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptSMP">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">SMA-SMK</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptSMASMK">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">D3</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptD3">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">S1</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptS1">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">S2</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptS2">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">S3</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="ptS3">x</span></h4></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-3 col-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pekerjaan</h5>
                        <canvas id="Pekerjaan"></canvas>
                    </div>
                    <div class="card-footer">
                        Pekerjaan
                    </div>
                </div>


                <div class="card">
                    <div class="card-body" style="height:550px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">None</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pNone">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">ASN</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pASN">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Dokter</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pDokter">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Karyawan Swasta</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pKaryawanSwasta">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Pedagang</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pPedagang">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Petani</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pPetani">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">TNI-Polri</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pTNIPolri">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Wiraswasta</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pWiraswasta">x</span></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>" />
    <input type="hidden" id="gereja_url" value="<?php echo(getenv('app.gerejaURL')); ?>" />
</body>
    <script src="<?php echo(base_url()); ?>assets/js/inside/jemaat.js" type="module"></script>

</html>