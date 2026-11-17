import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function () {

    $.LoadingOverlay("show");

    check_token();

    loadDataDistrik();

    $.LoadingOverlay("hide");

});


$(document).on("change", "#slcDistrik", function() {

    let distrik = $(this).val();

    let gereja_url = $("#gereja_url").val();

    let str = '';

    let temp = ajax_post(gereja_url+"webapi/v1/distrik/gereja/indistrik", {"distrik": distrik});

    if (temp.msg=='ok') {

        console.log(temp.data);

        let data = temp.data;

        let no = 1;

        for (let i=0; i<data.length; i++) {

            str = str + "<tr id='"+data[i]['penempatan_id']+"'><td>"+no+"</td><td>"+data[i]['nama_gereja']+"</td><td>"+data[i]['alamat']+"</td><td>"+data[i]['email_gereja']+"</td><td>"+data[i]['nama_pendeta']+"</td><td>"+data[i]['email_pendeta']+"</td><td>"+data[i]['mobile_phone']+"</td><td><button type='button' class='btn btn-dark btn-set'>Seting</button></td></tr>";
            no++;

        }

        $("#tblGereja tbody").html(str);

    };

2    
});

function loadDataDistrik() {

    let gereja_url = $("#gereja_url").val();
    let temp = ajax_get(gereja_url+"webapi/v1/distrik/all", {});

            // console.log(temp);
    if (temp.msg=='ok') {

        let str = "<option value=''></option>";

        for (let i=0; i<temp.data.length; i++) {

            str = str + "<option value='"+temp.data[i]['nama_distrik']+"'>"+temp.data[i]['nama_distrik']+"</option>";

        }

        $("#slcDistrik").html(str);
    }    

}

