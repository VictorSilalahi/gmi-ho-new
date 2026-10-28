<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distrik | GMI Wil-I | SIGMI</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>    
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
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>distrik">Distrik</a></li>
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

            <div class="col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label>Pilih Distrik</label>
                <select class="form-control" id="slcDistrik"></select>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2 align-items-center">
               
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2 align-items-center">
                
                <div class="card text-white bg-success">
                    <div class="card-body text-end">
                        <h5 class="card-title">Distrik</h5>
                        <p class="card-text"><h1 class="divNamaDistrik">...</h1></p>
                    </div>
                    <div class="card-footer">
                        Distrik
                    </div>
                </div>

            </div>

        </div>

        <br>

        <div class="row">

            <br>

            <ul class="nav nav-tabs" id="tabDistrik" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="jemaat-tab" data-bs-toggle="tab" data-bs-target="#deskripsi-jemaat" type="button" role="tab" aria-selected="true">Data Jemaat</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="daftargereja-tab" data-bs-toggle="tab" data-bs-target="#daftargereja" type="button" role="tab" aria-selected="false">Data Gereja</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">


                <div class="tab-pane fade show active" id="deskripsi-jemaat" role="tabpanel">


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


                
                <div class="tab-pane fade" id="daftargereja" role="tabpanel">


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

                        <table class="table table-primary" id="tblDaftarGereja">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Gereja</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Email</th>
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

                                <div class="card" style="width: 95%;">
                                    <div class="card-body">
                                        <h5 class="card-title">Tipe Jemaat</h5>
                                        <canvas id="dTipeJemaat"></canvas>
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
                                        <canvas id="dKelompokUsia"></canvas>
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
                                        <canvas id="dPendidikanTerakhir"></canvas>
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
                                        <canvas id="dPekerjaan"></canvas>
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
                                        <canvas id="dKebaktian" style="height:30px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Aktifitas : Kegiatan (12 bulan terakhir)</h5>
                                        <canvas id="dKegiatan" style="height:30px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Aktifitas : Data Jemaat (12 bulan terakhir)</h5>
                                        <canvas id="dOperasiDataJemaat" style="height:30px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jumlah Jemaat (12 bulan terakhir)</h5>
                                        <canvas id="dJumlahJemaat" style="height:30px"></canvas>
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
    <script src="<?php echo(base_url()); ?>assets/js/inside/distrik.js" type="module"></script>

</html>