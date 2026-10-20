import { pesan_error } from "../pesan.js";
import { ajax_post, ajax_get, fetch_post, fetch_get, fetch_post2 } from "../ajx.js";


$(document).ready(function() {

});

$(document).on("click", ".btn-login", function() {

    if ($("#txtPassword").val()=='') {
        pesan_error("Masukkan password!");
        return false;
    }

    let password = $("#txtPassword").val();
    let base_url = $("#base_url").val();
    let distrik = $("#slcDistrik").val();

    let temp = ajax_post(base_url+"validasi", {"distrik": distrik, "password": password } );

    if (temp.status==200) {
        
        localStorage.setItem('4pp_t0k3n', temp.token);
        localStorage.setItem('distrik', temp.distrik);
        window.location.replace(base_url+"jemaat");

    
    } else {

        $.LoadingOverlay("hide");
        pesan_error("Login dan password salah!");

    }

});

