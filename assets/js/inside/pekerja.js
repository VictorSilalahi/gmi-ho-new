import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function () {

    $.LoadingOverlay("show");

    check_token();

    loadDataPekerja();

    $.LoadingOverlay("hide");

});


$(document).on("click", ".btn-tambah-pekerja", function() {

    $("#opAddEditPekerja").text("Tambah Pekerja");
    $("#opPekerja").val("tambah");
    $("#modalAddEditPekerja").modal("show");

 
});

$(document).on("click", ".btn-ok-simpan-pekerja", function() {

    if ($("#txtNamaPekerja").val()=='') {
        pesan_error("Masukkan nama pekerja!");
        return false;
    }

    if ($("#txtMobilePhone").val()=='') {
        pesan_error("Masukkan nomor mobile phone!");
        return false;
    }

    if ($("#txtTanggalLahir").val()=='') {
        pesan_error("Masukkan tanggal lahir pekerja!");
        return false;
    }

    if ($("#txtTanggalDiterima").val()=='') {
        pesan_error("Masukkan tanggal penerimaan pekerja!");
        return false;
    }

    if ($("#txtTanggalSK").val()=='') {
        pesan_error("Masukkan tanggal SK Penempatan!");
        return false;
    }

    let pekerja_id = null;

    let nama = $("#txtNamaPekerja").val();
    let email = $("#txtEmail").val();
    let mobile_phone = $("#txtMobilePhone").val();
    let tanggal_lahir = $("#txtTanggalLahir").val();
    let tanggal_diterima = $("#txtTanggalDiterima").val();
    let tanggal_tahbis = $("#txtTanggalTahbis").val();
    let status = $(".bg-status").text();
    let penempatan = $("#slcPenempatan").val();
    let tanggal_sk = $("#txtTanggalSK").val();

    if ($("#opPekerja").val()=='edit') {



    }
    let gereja_url = $("#gereja_url").val();

    let temp = ajax_post(gereja_url+"webapi/v1/pekerja/add", {   
                "nama": nama, 
                "email": email, 
                "mobile_phone": mobile_phone, 
                "tanggal_lahir": tanggal_lahir, 
                "tanggal_diterima": tanggal_diterima,
                "tanggal_tahbis": tanggal_tahbis,
                "status": status,
                "penempatan": penempatan,
                "tanggal_sk": tanggal_sk
        });

    if (temp.msg=='ok') {

        pesan_sukses("Data berhasil ditambah!");
        loadDataPekerja();
        $("#modalAddEditPekerja").modal("hide");

    } else {

        pesan_error("Error!");

    }


});


$(document).on("click", ".btn-delete", function() {

    let jawab = confirm("Apakah akan menghapus data pekerja ini?");

    if (jawab==true) {

        let gereja_url = $("#gereja_url").val();

        let pekerja_id = $(this).parent().parent().attr("id");

        let temp = ajax_post(gereja_url+"webapi/v1/pekerja/del", {"pekerja_id": pekerja_id });

        if (temp.msg=='ok') {

            loadDataPekerja();
            pesan_sukses("Data pekerja berhasil dihapus!");

        }
    }


});

$(document).on("click", ".btn-edit", function() {

    $("#opAddEditPekerja").text("Edit Pekerja");
    $("#opPekerja").val("edit");
    $("#pekerja_id").val($(this).parent().parent().attr("id"));

    let pekerja_id = $(this).parent().parent().attr("id");

    let temp = ajax_get(gereja_url+"webapi/v1/pekerja/"+pekerja_id, {});

    $("#modalAddEditPekerja").modal("show");


});

$(document).on("change", "#txtTanggalTahbis", function() {

    
    if ($(this).val()!='') {
        $(".bg-status").text("Pendeta");
    } else {
        $(".bg-status").text("Guru Injil");
    }


});



function loadDataPekerja() {

    let gereja_url = $("#gereja_url").val();
    let temp = ajax_get(gereja_url+"webapi/v1/pekerja/all", {});

            // console.log(temp);
    if (temp.msg=='ok') {

        
        let str = "";
        let data = temp.data;

        console.log(data);

        let no = 1;
        for (let i=0; i<data.length; i++) {

            let lama_bekerja = data[i]['lama_bekerja'];
            str = str + "<tr id='"+data[i]['pekerja_id']+"'><td>"+no+"</td><td>"+data[i]['nama']+"</td><td>"+data[i]['email']+"</td><td>"+data[i]['mobile_phone']+"</td><td>"+set_tanggal(data[i]['tanggal_lahir'])+"</td><td>"+set_tanggal(data[i]['tanggal_diterima'])+"</td><td>"+set_tanggal(data[i]['tanggal_tahbis'])+"</td><td>"+data[i]['status']+"</td><td>"+data[i]['penempatan']+"</td><td>"+set_tanggal(data[i]['tanggal_sk'])+"</td><td>"+lama_bekerja['y']+" tahun dan "+lama_bekerja['m']+" bulan"+"</td><td><button class='btn btn-warning btn-edit'>Edit</button>&nbsp;<button class='btn btn-danger btn-delete'>Delete</button></td>";
            no++;
        }

        $("#tblGereja tbody").html(str);

        const table = new DataTable('#tblGereja');
    }    

}

