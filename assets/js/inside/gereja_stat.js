import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";

let markers = [];
let koordinat = [];
let map;

$(document).ready(function () {

    let base_url = $("#base_url").val();
    let distrik = localStorage.getItem('distrik');

    check_token();

    $.LoadingOverlay("show");

    let temp = ajax_post(base_url+"gereja/all", {"distrik": distrik});

    if (temp.msg=='ok') {
            let data = temp.data.data;

            console.log(data);
            let jumlah_gereja = data.length;

            let kepemilikan = {"Milik Sendiri": 0, "Disewa": 0, "Hak Pakai": 0};
            let kondisi = {"Permanen": 0, "Semi Permanen": 0, "Sementara": 0};
            let tipe = {"Jemaat Penuh": 0, "Jemaat Persiapan": 0, "Pos Pelayanan": 0};

            for (let i=0; i<data.length; i++) {

                // kepemilikan
                if (data[i]['kepemilikan']=='Milik Sendiri') {
                    kepemilikan['Milik Sendiri'] = kepemilikan['Milik Sendiri'] + 1;
                }

                if (data[i]['kepemilikan']=='Disewa') {
                    kepemilikan['Disewa'] = kepemilikan['Disewa'] + 1;
                }

                if (data[i]['kepemilikan']=='Hak Pakai') {
                    kepemilikan['Hak Pakai'] = kepemilikan['Hak Pakai'] + 1;
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

                // tipe
                if (data[i]['tipe']=='JPen') {
                    tipe['Jemaat Penuh'] = tipe['Jemaat Penuh'] + 1;
                }

                if (data[i]['tipe']=='JPer') {
                    tipe['Jemaat Persiapan'] = tipe['Jemaat Persiapan'] + 1;
                }

                if (data[i]['tipe']=='Pospel') {
                    tipe['Pos Pelayanan'] = tipe['Pos Pelayanan'] + 1;
                }
                
                koordinat.push({"lat": data[i]['lat'], "lng": data[i]['lng'], "kondisi": data[i]['kondisi_bangunan'], "kepemilikan": data[i]['kepemilikan']});

            }

            $(".divJumlahGereja").text(jumlah_gereja);


            Chart.register(ChartDataLabels);

            // grafik utk kepemilikan gereja
            const ctx_kepemilikan = document.getElementById('Kepemilikan');
            new Chart(ctx_kepemilikan, {
                        type: 'pie',
                        data: {
                        labels: ['Milik Sendiri', 'Disewa'],
                        datasets: [{
                            label: '#',
                            data: [kepemilikan['Milik Sendiri'], kepemilikan['Disewa']],
                            borderWidth: 0
                        }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: '#fff', // Font color for the labels
                                    font: {
                                        weight: 'bold',
                                        size: 18
                                    },
                                    formatter: (value, context) => {
                                    // Get the entire data array from the context
                                        const dataArray = context.dataset.data;
                                    
                                    // Calculate the total sum of all values
                                        const totalSum = dataArray.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
                                    
                                    // Calculate the percentage
                                        const percentage = ((value / totalSum) * 100).toFixed(1) + '%';
                                    
                                        return percentage; // Returns something like "35.4%"
                                    }  
                                }                          

                            }
                            // Do NOT include a 'scales' property here!
                        }

            });

            $("#pMilikSendiri").text(kepemilikan['Milik Sendiri']);
            $("#pDisewa").text(kepemilikan['Disewa']);
            $("#pHakPakai").text(kepemilikan['Hak Pakai']);

            // grafik kondisi gedung gereja
            const ctx_kondisi = document.getElementById('KondisiBangunan');
            new Chart(ctx_kondisi, {
                        type: 'pie',
                        data: {
                        labels: ['Permanen', 'Semi Permanen', 'Sementara'],
                        datasets: [{
                            label: '#',
                            data: [kondisi['Permanen'], kondisi['Semi Permanen'], kondisi['Sementara']],
                            borderWidth: 0
                        }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: '#fff', // Font color for the labels
                                    font: {
                                        weight: 'bold',
                                        size: 18
                                    },
                                    formatter: (value, context) => {
                                    // Get the entire data array from the context
                                        const dataArray = context.dataset.data;
                                    
                                    // Calculate the total sum of all values
                                        const totalSum = dataArray.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
                                    
                                    // Calculate the percentage
                                        const percentage = ((value / totalSum) * 100).toFixed(1) + '%';
                                    
                                        return percentage; // Returns something like "35.4%"
                                    }  
                                }                          

                            }
                            // Do NOT include a 'scales' property here!
                        }

            });

            $("#bPermanen").text(kondisi['Permanen']);
            $("#bSemiPermanen").text(kondisi['Semi Permanen']);
            $("#bSementara").text(kondisi['Sementara']);


            // grafik utk tipe gereja
            const ctx_tipe = document.getElementById('TipeGereja');
            new Chart(ctx_tipe, {
                        type: 'pie',
                        data: {
                        labels: ['Jemaat Penuh', 'Jemaat Persiapan', 'Pos Pelayanan'],
                        datasets: [{
                            label: '#',
                            data: [tipe['Jemaat Penuh'], tipe['Jemaat Persiapan'], tipe['Pos Pelayanan']],
                            borderWidth: 0
                        }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: '#fff', // Font color for the labels
                                    font: {
                                        weight: 'bold',
                                        size: 18
                                    },
                                    formatter: (value, context) => {
                                    // Get the entire data array from the context
                                        const dataArray = context.dataset.data;
                                    
                                    // Calculate the total sum of all values
                                        const totalSum = dataArray.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
                                    
                                    // Calculate the percentage
                                        const percentage = ((value / totalSum) * 100).toFixed(1) + '%';
                                    
                                        return percentage; // Returns something like "35.4%"
                                    }  
                                }                          

                            }
                            // Do NOT include a 'scales' property here!
                        }

            });

            $("#jPenuh").text(tipe['Jemaat Penuh']);
            $("#jPersiapan").text(tipe['Jemaat Persiapan']);
            $("#jPospel").text(tipe['Pos Pelayanan']);


        } else {
            pesan_error("Terjadi error pada remote api!");
            return false;
        }

        $.LoadingOverlay("hide");

        

});

