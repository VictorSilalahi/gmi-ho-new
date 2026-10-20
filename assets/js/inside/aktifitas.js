import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function () {

    check_token();

});

$(document).on("change","#slcWaktu", function() {

    if ($(this).val()!='') {

        let base_url = $("#base_url").val();
        let distrik = localStorage.getItem('distrik');
        let waktu = $(this).val();

        $.LoadingOverlay("show");

        let temp = ajax_post(base_url+"aktifitas/all", {"distrik": distrik, "waktu": waktu });

        let bulan_tahun = [];
        
        let jemaat_tambah = [];
        let jemaat_ubah = [];
        let jemaat_hapus = [];

        let kegiatan_tambah = [];
        let kegiatan_ubah = [];
        let kegiatan_hapus = [];
        
        let anggota_organisasi_tambah = [];
        let anggota_organisasi_ubah = [];
        let anggota_organisasi_hapus = [];


        //   console.log(temp);
        if (temp.msg=='ok') {
            let data = temp.data.data;

            // console.log(data);
            

            for (let i=0; i<data.length; i++) {
                
                bulan_tahun.unshift(data[i]['masa_waktu']);

                jemaat_tambah.unshift(data[i]['data']['jemaat']['tambah']);
                jemaat_ubah.unshift(data[i]['data']['jemaat']['ubah']);
                jemaat_hapus.unshift(data[i]['data']['jemaat']['hapus']);

                kegiatan_tambah.unshift(data[i]['data']['kegiatan']['tambah']);
                kegiatan_ubah.unshift(data[i]['data']['kegiatan']['ubah']);
                kegiatan_hapus.unshift(data[i]['data']['kegiatan']['hapus']);

                anggota_organisasi_tambah.unshift(data[i]['data']['organisasi']['tambah']);
                anggota_organisasi_ubah.unshift(data[i]['data']['organisasi']['ubah']);
                anggota_organisasi_hapus.unshift(data[i]['data']['organisasi']['hapus']);

            }

            // Menghancurkan chart bila ketemu
            const existingChartJemaat = Chart.getChart("Jemaat"); 

            if (existingChartJemaat) {
                existingChartJemaat.destroy();
            }

            const existingChartKegiatan = Chart.getChart("Kegiatan"); 

            if (existingChartKegiatan) {
                existingChartKegiatan.destroy();
            }

            const existingChartAnggotaOrganisasi = Chart.getChart("AnggotaOrganisasi"); 

            if (existingChartAnggotaOrganisasi) {
                existingChartAnggotaOrganisasi.destroy();
            }


            // grafik utk kegiatan
            const ctx_kegiatan = document.getElementById('Kegiatan');
            new Chart(ctx_kegiatan, {
                        type: 'line',
                        data: {
                        labels: bulan_tahun,
                        datasets: [{
                                fill: false,
                                label: "tambah",
                                data: kegiatan_tambah,
                                backgroundColor: 'green'
                            },{
                                fill: false,
                                label: "ubah",
                                data: kegiatan_ubah,
                                backgroundColor: 'orange'
                            },{
                                fill: false,
                                label: "hapus",
                                data: kegiatan_hapus,
                                backgroundColor: 'red'
                            },

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

            // grafik utk jemaat
            const ctx_jemaat = document.getElementById('Jemaat');
            new Chart(ctx_jemaat, {
                        type: 'line',
                        data: {
                        labels: bulan_tahun,
                        datasets: [{
                                fill: false,
                                label: "tambah",
                                data: jemaat_tambah,
                                backgroundColor: 'green'
                            },{
                                fill: false,
                                label: "ubah",
                                data: jemaat_ubah,
                                backgroundColor: 'orange'
                            },{
                                fill: false,
                                label: "hapus",
                                data: jemaat_hapus,
                                backgroundColor: 'red'
                            },

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

            // grafik utk anggota organisasi
            const ctx_anggota_organisasi = document.getElementById('AnggotaOrganisasi');
            new Chart(ctx_anggota_organisasi, {
                        type: 'line',
                        data: {
                        labels: bulan_tahun,
                        datasets: [{
                                fill: false,
                                label: "tambah",
                                data: anggota_organisasi_tambah,
                                backgroundColor: 'green'
                            },{
                                fill: false,
                                label: "ubah",
                                data: anggota_organisasi_ubah,
                                backgroundColor: 'orange'
                            },{
                                fill: false,
                                label: "hapus",
                                data: anggota_organisasi_hapus,
                                backgroundColor: 'red'
                            },

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
            // console.log(jemaat_tambah);

        }

        
        $.LoadingOverlay("hide");    

    }
});
