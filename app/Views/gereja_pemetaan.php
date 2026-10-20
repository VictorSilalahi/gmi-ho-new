<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemetaan - Distrik | GMI Wil-I | SIGMI</title>
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
                    <a class="nav-link" href="<?php echo(base_url()); ?>gereja/resort">Resort</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>gereja/pemetaan">Pemetaan</a>
                </li>
            </ul>        

        
        </div>

        <br>

        <div class="row">

                <div class="card" style="width: 97%;">
                    <div class="card-header">
                        <p>
                            <h5>Pemetaan Lokasi Gereja</h5>
                        </p>

                        <form>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                    <label>Kepemilikan</label>
                                    <select id="slcKepemilikan">
                                        <option value="Milik Sendiri">Milik Sendiri</option>
                                        <option value="Disewa">Disewa</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Kondisi Bangunan</label>
                                    <select id="slcKondisiBangunan">
                                        <option value="Permanen">Permanen</option>
                                        <option value="Semi Permanen">Semi Permanen</option>
                                        <option value="Sementara">Sementara</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <button type="button" class="btn btn-primary btn-tampil-gereja">Tampilkan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-body">
                        <div id="MapGereja" style="width:100%; height:800px"></canvas>
                    </div>
                    <div class="card-footer">
                        Map Gereja
                    </div>
                </div>

        </div>



    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>" />
    <input type="hidden" id="gereja_url" value="<?php echo(getenv('app.gerejaURL')); ?>" />
</body>
    <script src="<?php echo(base_url()); ?>assets/js/inside/gereja_pemetaan.js" type="module"></script>

</html>