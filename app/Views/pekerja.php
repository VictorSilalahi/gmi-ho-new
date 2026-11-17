<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pekerja | GMI Wil-I | SIGMI</title>
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
                    <a class="navbar-brand" href="#">SIGMI | HeadOffice</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>jemaat">Jemaat</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>gereja/stat">Gereja</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo(base_url()); ?>distrik">Distrik</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>pekerja">Pekerja</a></li>
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
            <div class="col-sm-12 col-md-4 col-lg-4">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">

                <label>Pilih Distrik</label>
                <select id="slcDistrik">
                </select>
                
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
            </div>
        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-2 col-lg-2"></div>

            <div class="col-sm-12 col-md-8 col-lg-8">

                <table class="table" id="tblGereja">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Gereja</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email Gereja</th>
                            <th scope="col">Pimpinan Jemaat</th>
                            <th scope="col">Email P.Jemaat</th>
                            <th scope="col">Mobile Phone P.Jemaat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>

            <div class="col-sm-12 col-md-2 col-lg-2"></div>
        </div>


    </div>
    



    
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>" />
    <input type="hidden" id="gereja_url" value="<?php echo(getenv('app.gerejaURL')); ?>" />
</body>
    <script src="<?php echo(base_url()); ?>assets/js/inside/pekerja.js" type="module"></script>

</html>