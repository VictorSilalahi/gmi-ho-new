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


