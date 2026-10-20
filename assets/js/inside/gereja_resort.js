import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";

let markers = [];
let koordinat = [];
let map;

$(document).ready(function () {

    let gereja_url = $("#gereja_url").val();
    let distrik = localStorage.getItem('distrik');

    check_token();

    $.LoadingOverlay("show");

    loadDataResort(gereja_url, distrik);
    loadDataGereja(distrik);

    $.LoadingOverlay("hide");

        

});



$(document).on("click", ".btn-hapus-gereja", function() {

    let gereja_url = $("#gereja_url").val();

    let jumlah_gereja = $(this).parent().prev().text();

    let resort_id = $(this).parent().parent().attr("id");

    if (jumlah_gereja>0) {

        pesan_error("Data resort tidak bisa dihapus!");
        return false;

    }

    Swal.fire({
        title: "Apakah Resort ini akan dihapus?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!"
        }).then((result) => {
            if (result.isConfirmed) {

                let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/del", {"resort_id": resort_id});

                if (temp.msg=='ok') {

                    let distrik = localStorage.getItem('distrik');

                    $.LoadingOverlay("show");

                    loadDataResort(gereja_url, distrik);

                    $.LoadingOverlay("hide");


                }


            }
        });    

});


$(document).on("click", ".btn-tambah-resort", function() {

    $("#titleAddEditResort").text("Tambah Resort");
    $("#txtOperasiResort").val("tambah");
    $("#txtResortID").val("");
    $("#txtNamaResort").val("");
    $("#modalAddEditResort").modal("show");


});


$(document).on("click", ".btn-edit-resort", function() {

    let resort_id = $(this).parent().parent().attr("id");
    let nama_resort = $(this).parent().prev().prev().text();
    $("#titleAddEditResort").text("Edit Resort");
    $("#txtOperasiResort").val("edit");
    $("#txtResortID").val(resort_id);
    $("#txtNamaResort").val(nama_resort);
    $("#modalAddEditResort").modal("show");


});

$(document).on("click", ".btn-ok-resort", function() {

    let gereja_url = $("#gereja_url").val();

    if ($("#txtNamaResort").val()=='') {

        pesan_error("Masukkan nama resort!");
        return false;
    }


    if ($("#txtOperasiResort").val()=='tambah') {

        let nama_resort = $("#txtNamaResort").val();

        let operasi = "tambah";

        addEditDataResort(nama_resort, operasi, '');


    } else {

        let resort_id = $(this).parent().parent().attr("id");

        let nama_resort = $("#txtNamaResort").val();

        let operasi = "edit";

        resort_id = $("#txtResortID").val();

        addEditDataResort(nama_resort, operasi, resort_id);


    }

    $("#modalAddEditResort").modal("hide");

});

$(document).on("click", ".btn-set-gereja", function() {

    let nama_resort = $(this).parent().prev().prev().text();
    let resort_id = $(this).parent().parent().attr("id");
    let distrik = localStorage.getItem('distrik');


    $("#txtResortIDforGereja").val(resort_id);
    $("#titleSetGereja").html("Set Anggota Resort : "+nama_resort);

    loadDataGerejaDiResort(resort_id, "input");
    loadDataGerejaNonResort(distrik);

    $("#modalGereja").modal("show");


});


$(document).on("click", ".btn-info-gereja", function() {

    let nama_resort = $(this).parent().prev().prev().text();
    let resort_id = $(this).parent().parent().attr("id");

    $("#namaResort").html("<h4><span class='badge bg-primary'>"+nama_resort+"</span></h4>");

    loadDataGerejaDiResort(resort_id, "");

});



$(document).on("click", ".btn-detail-gereja", function() {

    let gereja_id = $(this).parent().prev().prev().prev().find("input").val();

    loadDetailGereja(gereja_id);

});

$(document).on("click", ".btn-out-from-resort", function() {

    let gereja_url = $("#gereja_url").val();

    let data_check_gereja_to_out = [];
    let panjang_row = $("#tblGerejaAnggotaResort tbody tr").length;

    let resort_id = $("#txtResortIDforGereja").val();
    let distrik = localStorage.getItem('distrik');


    for (let i=0; i<panjang_row; i++) {

        if ($("#tblGerejaAnggotaResort tbody tr:eq("+i+") td:eq(0)").find("input").is(":checked")) {

            let anggotaresort_id = $("#tblGerejaAnggotaResort tbody tr:eq("+i+")").attr("id");
            data_check_gereja_to_out.push({"anggotaresort_id": anggotaresort_id});

        }

    }

    if (data_check_gereja_to_out.length==0) {

        alert("Pilih gereja yang akan dikeluarkan dari Resort!");
        return false;

    }
    

    let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/memberout", {"daftar": data_check_gereja_to_out})

    if (temp.msg=='ok') {

        pesan_sukses("Gereja berhasil dikeluarkan dari Resort!");

        loadDataGerejaDiResort(resort_id, "input");
        loadDataGerejaNonResort(distrik);

        loadDataResort(gereja_url, distrik);

        return false;

    }


});

$(document).on("click", ".btn-in-to-resort", function() {

    let gereja_url = $("#gereja_url").val();

    let resort_id = $("#txtResortIDforGereja").val();
    let distrik = localStorage.getItem('distrik');

    let data_check_gereja_to_in = [];
    
    let panjang_row = $("#tblGerejaNonAnggotaResort tbody tr").length;

    for (let i=0; i<panjang_row; i++) {

        if ($("#tblGerejaNonAnggotaResort tbody tr:eq("+i+") td:eq(0)").find("input").is(":checked")) {

            let gereja_id = $("#tblGerejaNonAnggotaResort tbody tr:eq("+i+")").attr("id");
            data_check_gereja_to_in.push({"gereja_id": gereja_id});

        }

    }

    if (data_check_gereja_to_in.length==0) {

        alert("Pilih gereja yang akan dimasukkan ke Resort!");
        return false;

    }
    

    let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/memberin", {"resort_id": resort_id, "daftar": data_check_gereja_to_in})
    
    if (temp.msg=='ok') {

        pesan_sukses("Gereja berhasil dimasukkan ke Resort!");
        loadDataGerejaDiResort(resort_id, "input");
        loadDataGerejaNonResort(distrik);

        loadDataResort(gereja_url, distrik);

        return false;

    }


});


function addEditDataResort(nama_resort, operasi, resort_id) {

    let distrik = localStorage.getItem('distrik');

    let gereja_url = $("#gereja_url").val();

    if (operasi=='tambah') {

        let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/add", {"nama_resort": nama_resort, "distrik": distrik});

    } else {

        let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/edit", {"nama_resort": nama_resort, "resort_id": resort_id});

    }

    loadDataResort(gereja_url, distrik);

}

function loadDataGerejaDiResort(res_id, lokasi) {

    let resort_id = res_id;

    let gereja_url = $("#gereja_url").val();

    let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/gereja", {"resort_id": resort_id});

    let data_gereja = [];


    if (lokasi=='') {


        $("#tblGereja tbody").html("");

        $("#tblGereja tbody").LoadingOverlay("show");

        if (temp.msg=='ok') {

            data_gereja = temp.data;
            
            let str = '';
            let no = 1;
            for(let i=0; i<data_gereja.length; i++) {

                str = str + "<tr id='"+data_gereja[i]['anggotaresort_id']+"'><td><input type='hidden' value='"+data_gereja[i]['gereja_id']+"'>"+no+"</td><td>"+data_gereja[i]['nama_gereja']+"</td><td>"+data_gereja[i]['alamat']+"</td><td><button class='btn btn-success btn-detail-gereja'>Data</button></td></tr>";
                no++;
            }

            $("#tblGereja tbody").LoadingOverlay("hide");
            $("#tblGereja tbody").html(str);

        }


    } else {


        $("#tblGerejaAnggotaResort tbody").html("");

        $("#tblGerejaAnggotaResort tbody").LoadingOverlay("show");

        if (temp.msg=='ok') {

            data_gereja = temp.data;
            
            let str = '';
            let no = 1;
            for(let i=0; i<data_gereja.length; i++) {

                str = str + "<tr id='"+data_gereja[i]['anggotaresort_id']+"'><td><input class='form-check-input row-checkbox' type='checkbox'></td><td>"+data_gereja[i]['nama_gereja']+"</td><td>"+data_gereja[i]['alamat']+"</td></tr>";
                no++;

            }

            $("#tblGerejaAnggotaResort tbody").LoadingOverlay("hide");
            $("#tblGerejaAnggotaResort tbody").html(str);

        }        

    }

}

function loadDataResort(gereja_url, distrik) {

    let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/all", {"distrik": distrik});

    let data_resort = null;

    // console.log(temp);

    if (temp.msg=='ok') {

        data_resort = temp.data;

        let str = '';

        let no = 1;

        
        $(".divJumlahResort").html(data_resort.length);

        $("#tblResort tbody").html("");

        let jumlah_gereja = 0;

        for (let i=0; i<data_resort.length; i++) {

            str = str + "<tr id='"+data_resort[i]['resort_id']+"'><td>"+no+"</td><td><div class='link-secondary'>"+data_resort[i]['nama_resort']+"</div></td><td>"+data_resort[i]['jumlah_gereja']+"</td><td><button class='btn btn-success btn-set-gereja'>Set Gereja</button>&nbsp;<button class='btn btn-warning btn-edit-resort'>Edit</button>&nbsp;<button class='btn btn-danger btn-hapus-gereja'>Hapus</button>&nbsp;<button class='btn btn-primary btn-info-gereja'>&#8594;</button></td></tr>";

            jumlah_gereja = jumlah_gereja + parseInt(data_resort[i]['jumlah_gereja']);
            no++;

        }

        str = str + "<tr><td></td><td>Jumlah Gereja dalam distrik</td><td><h3><span class='badge text-bg-secondary'>"+jumlah_gereja+"</span></h3></td><td></td></tr>";
        
        $("#tblResort tbody").html(str);

    }

}


function loadDataGerejaNonResort(distrik) {

    let gereja_url = $("#gereja_url").val();
    
    let temp = ajax_post(gereja_url+"webapi/v1/distrik/resort/gereja/outside", {"distrik": distrik});

    let data_gereja = null;

    console.log(temp);

    if (temp.msg=='ok') {

        data_gereja = temp.data;

        let str = '';
        for (let i=0; i<data_gereja.length; i++) {

            str = str + "<tr id='"+data_gereja[i]['gereja_id']+"'><td><input class='form-check-input row-checkbox' type='checkbox'></td><td>"+data_gereja[i]['nama_gereja']+"</td><td>"+data_gereja[i]['alamat']+"</td></tr>";

        }

        $("#tblGerejaNonAnggotaResort tbody").html(str);


    }


}

function loadDataGereja(distrik) {

    let base_url = $("#base_url").val();

    let temp = ajax_post(base_url+"gereja/all", {"distrik": distrik});

    // console.log(distrik);

    if (temp.msg=='ok') {

        let data = temp.data.data;

        let jumlah_gereja = data.length;

        $(".divJumlahGereja").text(jumlah_gereja);

    }

}


function loadDetailGereja(gereja_id) {

    gereja_id = gereja_id;

    let gereja_url = $("#gereja_url").val()+"webapi/v1/distrik/resort/gereja/detail";

    let temp = ajax_post(gereja_url, {"gereja_id": gereja_id});

    console.log(temp);

    if (temp.msg=='ok') {

        let data = temp.data;

        let jumlah_jiwa = data[0]['anggota']['jumlah anggota jemaat kk aktif'];
        let jumlah_kk = data[0]['kk']['jumlah kk jemaat aktif'];

        let jumlah_p2mi = data[0]['seksi']['P2MI'];
        let jumlah_p3mi = data[0]['seksi']['P3MI'];
        let jumlah_pwmi = data[0]['seksi']['PWMI'];
        let jumlah_prmi = data[0]['seksi']['PRMI'];


        let data_kelompok_umur = data[0]['kelompok umur'];
        let data_pendidikan = data[0]['sebaran pendidikan'];
        let data_pekerjaan = data[0]['sebaran pekerjaan'];
        let data_tipe_jemaat = data[0]['sifat keanggotaan'];

        let temp_aktifitas = data[0]['aktifitas'];

        let temp_jumlah_jemaat_perbulan = data[0]['jumlah_jemaat_perbulan'];

        let label_bulan = [];
        let data_kebaktian = [];
        data_kebaktian['tambah'] = [];
        data_kebaktian['ubah'] = [];
        data_kebaktian['hapus'] = [];
        let data_jemaat = [];
        data_jemaat['tambah'] = [];
        data_jemaat['ubah'] = [];
        data_jemaat['hapus'] = [];
        let data_kegiatan = [];
        data_kegiatan['tambah'] = [];
        data_kegiatan['ubah'] = [];
        data_kegiatan['hapus'] = [];
        let data_jemaat_perbulan = [];
        

        for (let i=temp_aktifitas.length-1; i>=0; i--) {

            label_bulan.push(temp_aktifitas[i]['masa_waktu']);

            data_kebaktian["tambah"].push(parseInt(temp_aktifitas[i]['data']['kebaktian']['tambah']));
            data_kebaktian['ubah'].push(parseInt(temp_aktifitas[i]['data']['kebaktian']['ubah']));
            data_kebaktian['hapus'].push(parseInt(temp_aktifitas[i]['data']['kebaktian']['hapus']));

            data_jemaat['tambah'].push(parseInt(temp_aktifitas[i]['data']['jemaat']['tambah']));
            data_jemaat['ubah'].push(parseInt(temp_aktifitas[i]['data']['jemaat']['ubah']));
            data_jemaat['hapus'].push(parseInt(temp_aktifitas[i]['data']['jemaat']['hapus']));

            data_kegiatan['tambah'].push(parseInt(temp_aktifitas[i]['data']['kegiatan']['tambah']));
            data_kegiatan['ubah'].push(parseInt(temp_aktifitas[i]['data']['kegiatan']['ubah']));
            data_kegiatan['hapus'].push(parseInt(temp_aktifitas[i]['data']['kegiatan']['hapus']));

        }

        for (let i=temp_jumlah_jemaat_perbulan.length-1; i>=0; i--) {

            data_jemaat_perbulan.push(parseInt(temp_jumlah_jemaat_perbulan[i]['jumlah']))
        }

        // console.log(data_jemaat_perbulan);

        $("#nama_gereja").text(data[0]['gereja']['nama_gereja']);
        $("#alamat_gereja").text(data[0]['gereja']['alamat']);
        $("#tipe_gereja").text(data[0]['gereja']['tipe']);
        $("#kondisi_gereja").text(data[0]['gereja']['kondisi']);
        $("#kepemilikan_gereja").text(data[0]['gereja']['kepemilikan']);

        $("#nama_pimpinan_jemaat").text(data[0]['pimpinan_jemaat']['nama']);
        $("#mobile_phone_pimpinan").text(data[0]['pimpinan_jemaat']['mobile_phone']);
        $("#email_pimpinan").text(data[0]['pimpinan_jemaat']['email']);


        // tampilkan kk dan jiwa
        $(".divJumlahJiwa").text(jumlah_jiwa);
        $(".divJumlahKK").text(jumlah_kk);


        // tampilkan p2mi, p3mi, pwmi, prmi
        $(".divJumlahP2MI").text(jumlah_p2mi);
        $(".divJumlahP3MI").text(jumlah_p3mi);
        $(".divJumlahPWMI").text(jumlah_pwmi);
        $(".divJumlahPRMI").text(jumlah_prmi);


        let existingChart = Chart.getChart("TipeJemaat"); 

        if (existingChart) {
            existingChart.destroy();
        }

        // grafik utk tipe jemaat
        const ctx_tipe_jemaat = document.getElementById('TipeJemaat');
        new Chart(ctx_tipe_jemaat, {
                    type: 'pie',
                    data: {
                    labels: ['Penuh', 'Persiapan'],
                    datasets: [{
                        label: '#',
                        data: [data_tipe_jemaat['penuh'], data_tipe_jemaat['persiapan']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
        });


        existingChart = Chart.getChart("KelompokUsia"); 

        if (existingChart) {
            existingChart.destroy();
        }
        
        // grafik utk kelompok umur
        const ctx_kelompok_umur = document.getElementById('KelompokUsia');
        new Chart(ctx_kelompok_umur, {
                    type: 'pie',
                    data: {
                    labels: ['Anak-anak', 'Remaja', 'Pemuda', 'Dewasa', 'Lansia'],
                    datasets: [{
                        label: '#',
                        data: [data_kelompok_umur['anak-anak'], data_kelompok_umur['remaja'], data_kelompok_umur['pemuda'], data_kelompok_umur['dewasa'], data_kelompok_umur['lansia']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
        });


        existingChart = Chart.getChart("PendidikanTerakhir"); 

        if (existingChart) {
            existingChart.destroy();
        }

        // grafik utk pendidikan terakhir
        const ctx_pendidikan_terakhir = document.getElementById('PendidikanTerakhir');
        new Chart(ctx_pendidikan_terakhir, {
                    type: 'pie',
                    data: {
                    labels: ['None', 'SD', 'SMP', 'SMA_SMK', 'D3', 'S1', 'S2', 'S3'],
                    datasets: [{
                        label: '#',
                        data: [data_pendidikan['None'], data_pendidikan['SD'], data_pendidikan['SMP'], data_pendidikan['SMA_SMK'], data_pendidikan['D3'], data_pendidikan['S1'], data_pendidikan['S2'], data_pendidikan['S3']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
        });


        existingChart = Chart.getChart("Pekerjaan"); 

        if (existingChart) {
            existingChart.destroy();
        }
        
        // grafik utk pekerjaan
        const ctx_pekerjaan = document.getElementById('Pekerjaan');
        new Chart(ctx_pekerjaan, {
                    type: 'pie',
                    data: {
                    labels: ['None', 'ASN', 'Dokter', 'Karyawan-Swasta', 'Pedagang', 'Petani', 'TNI-Polri', 'Wiraswasta'],
                    datasets: [{
                        label: '#',
                        data: [data_pekerjaan['None'], data_pekerjaan['ASN'], data_pekerjaan['Dokter'], data_pekerjaan['Karyawan-Swasta'], data_pekerjaan['Pedagang'], data_pekerjaan['Petani'], data_pekerjaan['TNI-Polri'], data_pekerjaan['Wiraswasta']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
                });


        existingChart = Chart.getChart("Kebaktian"); 

        if (existingChart) {
            existingChart.destroy();
        }        

        // grafik aktifitas kebaktian
        const ctx_kebaktian = document.getElementById('Kebaktian');
        new Chart(ctx_kebaktian, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'tambah',
                                    data: data_kebaktian['tambah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'ubah',
                                    data: data_kebaktian['ubah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'hapus',
                                    data: data_kebaktian['hapus'],
                                    borderWidth: 1
                                }

                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
        });


        existingChart = Chart.getChart("OperasiDataJemaat"); 

        if (existingChart) {
            existingChart.destroy();
        }        

        // grafik aktifitas data jemaat
        const ctx_operasi_jemaat = document.getElementById('OperasiDataJemaat');
        new Chart(ctx_operasi_jemaat, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'tambah',
                                    data: data_jemaat['tambah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'ubah',
                                    data: data_jemaat['ubah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'hapus',
                                    data: data_jemaat['hapus'],
                                    borderWidth: 1
                                }

                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
        });

        existingChart = Chart.getChart("Kegiatan"); 

        if (existingChart) {
            existingChart.destroy();
        }        
        
        // grafik aktifitas Kegiatan
        const ctx_kegiatan = document.getElementById('Kegiatan');
        new Chart(ctx_kegiatan, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'tambah',
                                    data: data_kegiatan['tambah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'ubah',
                                    data: data_kegiatan['ubah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'hapus',
                                    data: data_kegiatan['hapus'],
                                    borderWidth: 1
                                }

                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
        });


        existingChart = Chart.getChart("JumlahJemaat"); 

        if (existingChart) {
            existingChart.destroy();
        }        
        
        // grafik jumlah jemaat perbulan
        const ctx_jumlah_jemaat = document.getElementById('JumlahJemaat');
        new Chart(ctx_jumlah_jemaat, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'jumlah',
                                    data: data_jemaat_perbulan,
                                    borderWidth: 1
                                }

                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
        });        
        

        let jemaat_awal = data_jemaat_perbulan[0];
        let jemaat_akhir = data_jemaat_perbulan[data_jemaat_perbulan.length-1];
        console.log(jemaat_awal, jemaat_akhir);
        let sisa = 0;
        let perubahan = null;

        $(".jiwaAwal").text(jemaat_awal);
        $(".jiwaAkhir").text(jemaat_akhir);


        $("#modalDetailGereja").modal("show");

        if (jemaat_akhir==jemaat_awal) {
            
            perubahan = 0;
            $(".jiwaPerubahan").text(perubahan+" %");
            return false;

        } 

        if (jemaat_akhir<jemaat_awal) {

            sisa = jemaat_akhir-jemaat_awal;
            perubahan = (sisa/jemaat_awal)*100;
            $(".jiwaPerubahan").text(perubahan+" %");
            return false;

        } 

        if (jemaat_akhir>jemaat_awal) {

            if (jemaat_awal==0) {
                perubahan = 100;
                $(".jiwaPerubahan").text(perubahan+" %");
                return false;

            } else {
                sisa = jemaat_akhir-jemaat_awal;
                perubahan = (sisa/jemaat_awal)*100;
                $(".jiwaPerubahan").text(perubahan+" %");
                return false;

            }

        } 

        if (jemaat_awal==0 && jemaat_akhir>0) {
            perubahan = 100;
            $(".jiwaPerubahan").text(perubahan+" %");
            return false;
        }





 

    }


}

