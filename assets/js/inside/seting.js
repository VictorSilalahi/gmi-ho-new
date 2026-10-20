import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { check_session } from "../sess.js";

let gereja_url = $("#gereja_url").val();
let base_url = $("#base_url").val();

let kab_kota_per_provinsi = [];

let distrik = null;
let nama_gereja = null;
let alamat = null;
let kabupaten_id = null;
let provinsi_id = null;


$(document).ready(function() {


  check_token();

  $.LoadingOverlay("show");

  setProvinsi();

  getInfoDistrik();

  $.LoadingOverlay("hide");


  $(".btn-update-password").on("click", function() {
    
    if ($("#txtPassword1").val()=='') {
      alert("Masukkan password baru!");
      $("#txtPassword1").focus();
      return false;
    }

    if ($("#txtPassword2").val()=='') {
      alert("Masukkan kembali password baru!");
      $("#txtPassword2").focus();
      return false;
    }

    if ($("#txtPassword1").val()!=$("#txtPassword2").val()) {
      alert("Password baru masih salah!");
      $("#txtPassword1").focus();
      return false;
    }

    if (confirm("Apakah password akan diubah?")==true) {
      
      var password_baru = $("#txtPassword1").val();
      let token = localStorage.getItem('4pp_t0k3n');
      var jawab = ajax_post(base_url+"seting/password/change", {"password_baru": password_baru, "token": token });

      if (jawab.msg=='ok') {
        alert("Password telah diubah dan disimpan!");
        $("#txtPassword1").val("");
        $("#txtPassword2").val("");
      } else {
        alert("Password gagal disimpan. Error!");
      }

    }
  });

});



$(document).on("click", ".btn-update-alamat-distrik", function() {

    let alamat_distrik = '';

    if ($("#txtAlamatDistrik").val()=='') {

      alert("Masukkan alamat distrik!");
      $("#txtAlamatDistrik").focus();
      return false;
      
    }

    if (confirm("Apakah akan mengubah alamat distrik?")==true) {

      alamat_distrik = $("#txtAlamatDistrik").val();
      let token = localStorage.getItem('4pp_t0k3n');
      let temp = ajax_post(base_url+"seting/simpanalamatdistrik", {"token": token, "alamat_distrik": alamat_distrik});

    }



});


$(document).on("click", ".btn-update-kabkota-distrik", function() {

    let kabkota_distrik = $("#slcKabKota").val();
    let token = localStorage.getItem('4pp_t0k3n');

    if (confirm("Apakah akan mengubah kabupaten/kota distrik?")==true) {

      let temp = ajax_post(base_url+"seting/simpankabkotadistrik", {"token": token, "kabkota_id": kabkota_distrik});

    }



});


function setProvinsi() {

    let gereja_url = $("#gereja_url").val()
    let temp = ajax_get(gereja_url+"webapi/v1/provinsi", {});

    if (temp.status=='ok') {

        if (temp.data.length!=0) {
            

            let opts = '';
            for (let i=0; i<temp.data.length; i++) {

                let provinsi_id = temp.data[i]['provinsi_id'];

                let temp_kab_kota = ajax_post(gereja_url+"daftar/kabkota", {"provinsi_id": provinsi_id});

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



function getInfoDistrik()
{

    let base_url = $("#base_url").val();

    let token = localStorage.getItem('4pp_t0k3n');
    
    var jawab = ajax_post(base_url+"/seting/getinfodistrik", {"token": token});

    console.log(jawab);


    distrik = jawab.pesan.distrik;

    alamat = jawab.pesan.alamat;
    kabupaten_id = jawab.pesan.kabupaten_id;
    provinsi_id = jawab.pesan.provinsi_id;

    $("#nama_distrik").text(distrik);
    $("#txtAlamatDistrik").val(alamat);
    $("#slcProvinsi").val(provinsi_id).change();
    $("#slcKabKota").val(kabupaten_id).change();

}