import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";

let markers = [];
let koordinat = [];
let map;

$(document).ready(function () {

    check_token();

    let base_url = $("#base_url").val();
    let gereja_url = $("#gereja_url").val();
    // let distrik = localStorage.getItem('distrik');

    $.LoadingOverlay("show");

    let temp = ajax_post(gereja_url+"webapi/v1/distrik/gereja/all", {});

    // console.log(temp);

    if (temp.msg=='ok') {
            let data = temp.data;

            console.log(data);

            let kepemilikan = {"Milik Sendiri": 0, "Disewa": 0};
            let kondisi = {"Permanen": 0, "Semi Permanen": 0, "Sementara": 0};


            for (let i=0; i<data.length; i++) {

                // kepemilikan
                if (data[i]['kepemilikan']=='Milik Sendiri') {
                    kepemilikan['Milik Sendiri'] = kepemilikan['Milik Sendiri'] + 1;
                }

                if (data[i]['kepemilikan']=='Disewa') {
                    kepemilikan['Disewa'] = kepemilikan['Disewa'] + 1;
                }

                // kondisi
                if (data[i]['kondisi_bangunan']=='Permanen') {
                    kondisi['Permanen'] = kondisi['Permanen'] + 1;
                }

                if (data[i]['kondisi_bangunan']=='Semi Permanen') {
                    kondisi['Semi Permanen'] = kondisi['Semi Permanen'] + 1;
                }

                if (data[i]['kondisi_bangunan']=='Sementara') {
                    kondisi['Sementara'] = kondisi['Sementara'] + 1;
                }

                koordinat.push({"lat": data[i]['lat'], "lng": data[i]['lng'], "kondisi": data[i]['kondisi_bangunan'], "kepemilikan": data[i]['kepemilikan'], "nama_gereja": data[i]['nama_gereja']});

            }
    }

    setMap();

    $.LoadingOverlay("hide");

        

});

$(document).on("click", ".btn-tampil-gereja", function() {

    let kepemilikan = $("#slcKepemilikan").val();
    let kondisi = $("#slcKondisiBangunan").val();

    map.eachLayer((layer) => {
    // Check if the layer has a lat/lng reference (typical for markers)
        if (layer._latlng) {
            map.removeLayer(layer);
        }
    });

    for (let i=0; i<koordinat.length; i++) {
        if (koordinat[i]['kepemilikan']==kepemilikan && koordinat[i]['kondisi']==kondisi) {

            let marker_lat = koordinat[i]['lat'];
            let marker_lng = koordinat[i]['lng'];
            // let marker = L.marker([marker_lat, marker_lng]).addTo(map);
            
            let color = '';

            if (kepemilikan=='Milik Sendiri' && kondisi=='Permanen') {
                color = 'blue';
            }
            if (kepemilikan=='Milik Sendiri' && kondisi=='Semi Permanen') {
                color = 'green';
            }
            if (kepemilikan=='Milik Sendiri' && kondisi=='Sementara') {
                color = 'grey';
            }
            if (kepemilikan=='Disewa') {
                color = 'black';
            }


            let marker = L.marker([marker_lat, marker_lng])
                .addTo(map)
                .bindTooltip(koordinat[i]['nama_gereja'], { 
                    permanent: true, 
                    direction: "top" 
            });            

            
        
    }

    }

});

function setMap() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error_map);
    } else {
        alert("Error, browser ini tidak support geolocation.");
    }
}

function success(position) {


    map = L.map('MapGereja').setView([0.556157, 101.2208913], 7);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);


}

function error_map() {
    alert("Error, koordinat tidak bisa didapatkan.");
}
