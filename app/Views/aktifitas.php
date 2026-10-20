<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktifitas Gereja Distrik | GMI Wil-I | SIGMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>gereja/stat">Gereja</a></li>
                        <li class="nav-item"><a class="nav-link  active" aria-current="page" href="<?php echo(base_url()); ?>aktifitas">Aktifitas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>logout">Logout</a></li>
                    </ul>
                    </div>
                </div>
            </nav>

        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12">
                <select class="form-select" id="slcWaktu">
                    <option value="" selected></option>
                    <option value="12">12 bulan terakhir (1 tahun)</option>
                    <option value="24">24 bulan terakhir (2 tahun)</option>
                </select>
            </div>
         
        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-6">

                <div class="card" style="width: 95%;">
                    <div class="card-body">
                        <h5 class="card-title">Aktifitas Jemaat</h5>
                        <canvas id="Jemaat"></canvas>
                    </div>
                    <div class="card-footer">
                        Aktifitas Jemaat
                    </div>
                </div>

            </div>


            <div class="col-sm-12 col-md-6 col-lg-6">

                <div class="card" style="width: 95%;">
                    <div class="card-body">
                        <h5 class="card-title">Aktifitas Kegiatan</h5>
                        <canvas id="Kegiatan"></canvas>
                    </div>
                    <div class="card-footer">
                        Aktifitas Kegiatan
                    </div>
                </div>
            
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">

                <div class="card" style="width: 95%;">
                    <div class="card-body">
                        <h5 class="card-title">Aktifitas Ibadah</h5>
                        <canvas id="AnggotaOrganisasi"></canvas>
                    </div>
                    <div class="card-footer">
                        Aktifitas Anggota Organisasi
                    </div>
                </div>
            
            </div>



        </div>

    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>" />
</body>
    <script src="<?php echo(base_url()); ?>assets/js/inside/aktifitas.js" type="module"></script>

</html>