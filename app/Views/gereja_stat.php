<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gereja | GMI Wil-I | SIGMI</title>
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<body>

    <div class="container-fluid">

        <div class="row">

            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">SIGMI | HeadOffice</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>jemaat">Jemaat</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>gereja/stat">Gereja</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>distrik">Distrik</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>pencarian">Pencarian</a></li>
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
                    <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>gereja/stat">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo(base_url()); ?>gereja/pemetaan">Pemetaan</a>
                </li>
            </ul>        

            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="card text-white bg-secondary">
                        <div class="card-body text-end">
                            <h4 class="card-title">Jemaat Penuh</h4>
                            <p class="card-text"><h1 class="divJumlahJemaatPenuh">0</h1></p>
                        </div>
                        <div class="card-footer">
                            <h7>Jemaat Penuh</h7>
                        </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="card text-white bg-secondary">
                        <div class="card-body text-end">
                            <h4 class="card-title">Jemaat Persiapan</h4>
                            <p class="card-text"><h1 class="divJumlahJemaatPersiapan">0</h1></p>
                        </div>
                        <div class="card-footer">
                            <h7>Jemaat Persiapan</h7>
                        </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="card text-white bg-secondary">
                        <div class="card-body text-end">
                            <h4 class="card-title">Pos Pelayanan</h4>
                            <p class="card-text"><h1 class="divJumlahPospel">0</h1></p>
                        </div>
                        <div class="card-footer">
                            <h7>Pos Pelayanan</h7>
                        </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3">

                <div class="card text-white bg-info">
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


            <div class="col-sm-12 col-md-4 col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kondisi Bangunan</h5>
                        <canvas id="KondisiBangunan" style="height:400px"></canvas>
                    </div>
                    <div class="card-footer">
                        Kondisi Bangunan
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Permanen</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="bPermanen">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Semi Permanen</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="bSemiPermanen">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Sementara</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="bSementara">x</span></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



            <div class="col-sm-12 col-md-4 col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kepemilikan</h5>
                        <canvas id="Kepemilikan" style="width:400px"></canvas>
                    </div>
                    <div class="card-footer">
                        Kepemilikan
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Milik Sendiri</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pMilikSendiri">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Disewa</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pDisewa">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Hak Pakai</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="pHakPakai">x</span></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <div class="col-sm-12 col-md-4 col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tipe Gereja</h5>
                        <canvas id="TipeGereja" style="height:400px"></canvas>
                    </div>
                    <div class="card-footer">
                        Tipe Gereja
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Jemaat Penuh</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="jPenuh">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Jemaat Persiapan</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="jPersiapan">x</span></h4></td>
                                </tr>
                                <tr>
                                    <td><h4><span class="badge text-bg-secondary">Pos Pelayanan</span></h4></td>
                                    <td><h4><span class="badge text-bg-secondary" id="jPospel">x</span></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>                

            </div>



        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12">

            </div>

        </div>

    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>" />
    <input type="hidden" id="gereja_url" value="<?php echo(getenv('app.gerejaURL')); ?>" />
</body>
    <script src="<?php echo(base_url()); ?>assets/js/inside/gereja_stat.js" type="module"></script>

</html>