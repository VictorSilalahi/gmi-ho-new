<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pekerja | GMI Wil-I | SIGMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/3.1.5/css/dataTables.dataTables.min.css" />
</head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.datatables.net/3.1.5/js/dataTables.min.js"></script>

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
                
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <button class="btn btn-primary btn-tambah-pekerja">Tambah</button>
            </div>
        </div>

        <br>

        <div class="row">

            <div class="col-sm-12 col-md-2 col-lg-2"></div>

            <div class="col-sm-12 col-md-8 col-lg-8">

                <table class="table display" id="tblGereja">
                    <thead>
                        <tr>
                            <td>#</th>
                            <td>Nama </th>
                            <td>Email</th>
                            <td>Mobile Phone</th>
                            <td>Tanggal Lahir</th>
                            <td>Tanggal Diterima</th>
                            <td>Tanggal Pentahbisan</th>
                            <td>Status</th>
                            <td>Penempatan</th>
                            <td>Tanggal S.K</th>
                            <td>Lama Penempatan</th>
                            <td>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>

            <div class="col-sm-12 col-md-2 col-lg-2"></div>
        </div>


    </div>
    


    <!-- Modal -->
    <div class="modal fade" id="modalAddEditPekerja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="opAddEditPekerja">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtNamaPekerja" placeholder="nama pekerja">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="txtEmail" placeholder="name@example.com">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Mobile Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtMobilePhone" placeholder="mobile phone">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="txtTanggalLahir" placeholder="">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-4 col-form-label">Tanggal Diterima</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="txtTanggalDiterima" placeholder="">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-4 col-form-label">Tanggal Tahbis</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="txtTanggalTahbis" placeholder="">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <h5><span class="badge bg-secondary bg-status">Guru Injil</span></h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-4 col-form-label">Penempatan</label>
                        <div class="col-sm-10">
                            <select id="slcPenempatan">
                                <option value="PimpinanWilayah">Pimpinan Wilayah</option>
                                <option value="PimpinanDistrik">Pimpinan Distrik</option>
                                <option value="PimpinanJemaat">Pimpinan Jemaat</option>
                                <option value="Asisten">Asisten</option>
                                <option value="Lembaga">Lembaga</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tanggal S.K</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="txtTanggalSK" placeholder="">
                        </div>
                    </div>
                    <input type="hidden" id="opPekerja">
                    <input type="hidden" id="pekerja_id">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-ok-simpan-pekerja">OK</button>
            </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>" />
    <input type="hidden" id="gereja_url" value="<?php echo(getenv('app.gerejaURL')); ?>" />
</body>
    <script src="<?php echo(base_url()); ?>assets/js/inside/pekerja.js" type="module"></script>

</html>