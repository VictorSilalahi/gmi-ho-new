<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Distrik | GMI Wil-I</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<body>

    <div class="container-fluid">

        <div class="row">
            <!-- Takes full width on mobile, half on tablets, one-third on desktops -->
            <div class="col-sm-6 vh-100 bg-dark bg-gradient">
                
            </div>
            <div class="col-sm-6">


              <div class="card-body p-md-5 mx-md-4">


                <p>
                    <h2>Pendaftaran Distrik</h2>
                </p>

                <p>
                    <hr>
                </p>
                
                <form id="formDaftar" action="<?php echo(base_url()); ?>daftar/tambah_distrik" method="post">
                  
                  <div data-mdb-input-init class="form-outline mb-4">
                        <select class="form-control" id="slcDistrik" name="slcDistrik">
                            <option value="D-I">D-I</option>
                            <option value="D-II">D-II</option>
                            <option value="D-III">D-III</option>
                            <option value="D-IV">D-IV</option>
                            <option value="D-V">D-V</option>
                            <option value="D-VI">D-VI</option>
                            <option value="D-VII">D-VII</option>
                            <option value="D-VIII">D-VIII</option>
                            <option value="D-IX">D-IX</option>
                            <option value="D-X">D-X</option>
                            <option value="D-XI">D-XI</option>
                            <option value="D-XII">D-XII</option>
                        </select>
                        <label class="form-label" for="slcDistrik">Distrik</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="txtPassword1" name="txtPassword1" class="form-control" />
                    <label class="form-label" for="txtPassword1">Password</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="txtPassword2" class="form-control" />
                    <label class="form-label" for="txtPassword2">Ketik kembali Password</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="txtEmailDistrik" name="txtEmailDistrik" class="form-control" />
                    <label class="form-label" for="txtEmailDistrik">Email Distrik</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <select id="slcProvinsi" class="form-control"></select>
                    <label class="form-label" for="slcProvinsi">Provinsi</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <select id="slcKabKota" name="slcKabKota" class="form-control"></select>
                    <label class="form-label" for="slcKabKota">Kabupaten/Kota</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="test" id="txtAlamat" name="txtAlamat" class="form-control" />
                    <label class="form-label" for="txtAlamat">Alamat</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 btn-daftar" type="button">Daftar</button>
                  </div>


                </form>

              </div>


            </div>
        </div>

    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">
    <input type="hidden" id="gereja_url" value="<?php echo(getenv('app.gerejaURL')); ?>">
</body>
    <script src="assets/js/inside/pendaftaran.js" type="module"></script>

</html>