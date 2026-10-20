import { pesan_error } from "../pesan.js";
import { ajax_post, ajax_get, fetch_post, fetch_get, fetch_post2 } from "../ajx.js";

let fileSize = 0;

let kab_kota_per_provinsi = [];

$(document).ready(function() {

    $.LoadingOverlay("show");

    setProvinsi();

    $.LoadingOverlay("hide");


});



$(document).on("click", ".btn-daftar", function() {

    let distrik = '';
    let email_distrik = '';


    if ($("#txtPassword1").val()=='') {
        pesan_error("Masukkan password!");
        return false;
    }

    if ($("#txtPassword2").val()=='') {
        pesan_error("Masukkan kembali password!");
        return false;
    }

    if ($("#txtPassword1").val()!==$("#txtPassword2").val()) {
        pesan_error("Password tidak sama!");
        return false;
    }


    if ($("#txtEmailDistrik").val()=='') {
        pesan_error("Masukkan email distrik!");
        return false;
    }

    if ($("#txtAlamat").val()=='') {
        pesan_error("Masukkan alamat distrik!");
        return false;
    }

    // cek format email gereja
    email_distrik = $("#txtEmailDistrik").val();

    if (isEmail(email_distrik)==false) {
        pesan_error("Format email distrik salah!");
        return false;
    }

    // cek keberadaan email distrik
    let cek_ada_email_distrik = cek_keberadaan_email("distrik", email_distrik);
    
    if (cek_ada_email_distrik==true) {
        pesan_error("Email Distrik sudah terdaftar!");
        return false;
    }

    // cek keberadaan distrik
    let sudah_ada_distrik = cek_keberadaan_distrik(distrik);

    if (sudah_ada_distrik==true) {
        pesan_error("Distrik sudah terdaftar!");
        return false;
    }

    
    $.LoadingOverlay("show");

    $("#formDaftar").submit();


});



function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function cek_keberadaan_email(jenis, email) {

    let email_temp = email;
    let base_url = $("#base_url").val()

    let temp = ajax_post(base_url+"daftar/cek_email", {"jenis": jenis, "email": email_temp});

    if (temp.status=='ok') {

        if (temp.jumlah==0) {

            return false;

        } else {

            return true;
        }
    }

}

function cek_keberadaan_distrik(distrik) {
    
    let dist = distrik;
    let base_url = $("#base_url").val()

    let temp = ajax_post(base_url+"daftar/cek_distrik", {"distrik": dist});

    if (temp.status=='ok') {

        if (temp.jumlah==0) {

            return false;

        } else {

            return true;
        }
    }


}

$(document).on("change", "#slcProvinsi", function() {

    let provinsi_id = $("#slcProvinsi").val();

    for (let i=0; i<kab_kota_per_provinsi.length; i++) {

        if (kab_kota_per_provinsi[i]['provinsi id']==provinsi_id) {
            console.log(kab_kota_per_provinsi[i]['data']);

            let data = kab_kota_per_provinsi[i]['data'];

            let opts = '';

            for (let j=0; j<data.length; j++) {

                opts = opts + "<option value='"+data[j]['kabupaten_id']+"'>"+data[j]['kabupaten']+"</option>";

            }

            $("#slcKabKota").html(opts);

        }
    }


});


function setProvinsi() {

    let base_url = $("#gereja_url").val()
    let temp = ajax_get(base_url+"daftar/provinsi", {});

    if (temp.status=='ok') {

        if (temp.data.length!=0) {
            

            let opts = '';
            for (let i=0; i<temp.data.length; i++) {

                let provinsi_id = temp.data[i]['provinsi_id'];

                let temp_kab_kota = ajax_post(base_url+"daftar/kabkota", {"provinsi_id": provinsi_id});

                let kab_kota = [];
                
                if (temp_kab_kota.status=='ok') {

                    for (let i=0; i<temp_kab_kota.data.length; i++) {

                        kab_kota.push({"kabupaten_id": temp_kab_kota.data[i]['kabupaten_id'], "kabupaten": temp_kab_kota.data[i]['kabupaten']});

                    }
                    
                }

                kab_kota_per_provinsi.push({"provinsi id":temp.data[i]['provinsi_id'], "nama": temp.data[i]['provinsi'], "data": kab_kota });
                opts = opts + "<option value='"+temp.data[i]['provinsi_id']+"'>"+temp.data[i]['provinsi']+"</option>";

            }

            $("#slcProvinsi").html(opts);

            let sbox = document.getElementById("slcProvinsi");
            sbox.selectedIndex = 0;
            const event = new Event('change', { bubbles: true });
            sbox.dispatchEvent(event);


        } else {

            return true;
        }
    }

}
