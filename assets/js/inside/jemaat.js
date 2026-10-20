import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function () {

  let gereja_url = $("#gereja_url").val()+"webapi/v1/distrik/jemaat/all";
  let distrik = localStorage.getItem('distrik');

  check_token();
  
  $.LoadingOverlay("show");

  let temp = ajax_post(gereja_url, {"distrik": distrik});

  if (temp.msg=='ok') {
        let data = temp.data;

        // console.log(data);
        
        if (data.length===0) {
            $.LoadingOverlay("hide");            
            return false;
        }


        let jumlah_jiwa = data.jumlah_jiwa;
        let jumlah_kk = data.jumlah_kk;
        let data_kelompok_umur = data.kelompok_usia;
        let data_pendidikan = data.pendidikan;
        let data_pekerjaan = data.pekerjaan;
        let data_tipe_jemaat = data.tipe_jemaat;
        let data_seksi = data.seksi;
        
        // console.log(data_seksi);

        $(".divJumlahJiwa").text(jumlah_jiwa);
        $(".divJumlahKK").text(jumlah_kk);

        $(".divJumlahP2MI").text(data_seksi['P2MI']);
        $(".divJumlahP3MI").text(data_seksi['P3MI']);
        $(".divJumlahPWMI").text(data_seksi['PWMI']);
        $(".divJumlahPRMI").text(data_seksi['PRMI']);



        Chart.register(ChartDataLabels);
        
        // grafik utk kelompok umur
        const ctx_tipe_jemaat = document.getElementById('TipeJemaat');
        new Chart(ctx_tipe_jemaat, {
                    type: 'pie',
                    data: {
                    labels: ['Penuh', 'Persiapan'],
                    datasets: [{
                        label: '#',
                        data: [data_tipe_jemaat['penuh'], data_tipe_jemaat['persiapan']],
                        borderWidth: 1
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

        $("#jPenuh").text(data_tipe_jemaat['penuh']);
        $("#jPersiapan").text(data_tipe_jemaat['persiapan']);

        // grafik utk kelompok umur
        const ctx_kelompok_umur = document.getElementById('KelompokUsia');
        new Chart(ctx_kelompok_umur, {
                    type: 'pie',
                    data: {
                    labels: ['Anak-anak', 'Remaja', 'Pemuda', 'Dewasa', 'Lansia'],
                    datasets: [{
                        label: '#',
                        data: [data_kelompok_umur['anak-anak'], data_kelompok_umur['remaja'], data_kelompok_umur['pemuda'], data_kelompok_umur['dewasa'], data_kelompok_umur['lansia']],
                        borderWidth: 1
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

        $("#kuAnakAnak").text(data_kelompok_umur['anak-anak']);
        $("#kuRemaja").text(data_kelompok_umur['remaja']);
        $("#kuPemuda").text(data_kelompok_umur['pemuda']);
        $("#kuDewasa").text(data_kelompok_umur['dewasa']);
        $("#kuLansia").text(data_kelompok_umur['lansia']);
        



        // grafik utk pendidikan terakhir
        const ctx_pendidikan_terakhir = document.getElementById('PendidikanTerakhir');
        new Chart(ctx_pendidikan_terakhir, {
                    type: 'pie',
                    data: {
                    labels: ['None', 'SD', 'SMP', 'SMA_SMK', 'D3', 'S1', 'S2', 'S3'],
                    datasets: [{
                        label: '#',
                        data: [data_pendidikan['None'], data_pendidikan['SD'], data_pendidikan['SMP'], data_pendidikan['SMA_SMK'], data_pendidikan['D3'], data_pendidikan['S1'], data_pendidikan['S2'], data_pendidikan['S3']],
                        borderWidth: 1
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

        $("#ptNone").text(data_pendidikan['None']);
        $("#ptSD").text(data_pendidikan['SD']);
        $("#ptSMP").text(data_pendidikan['SMP']);
        $("#ptSMASMK").text(data_pendidikan['SMA_SMK']);
        $("#ptD3").text(data_pendidikan['D3']);
        $("#ptS1").text(data_pendidikan['S1']);
        $("#ptS2").text(data_pendidikan['S2']);
        $("#ptS3").text(data_pendidikan['S3']);

        // grafik utk pekerjaan
        const ctx_pekerjaan = document.getElementById('Pekerjaan');
        new Chart(ctx_pekerjaan, {
                    type: 'pie',
                    data: {
                    labels: ['None', 'ASN', 'Dokter', 'Karyawan-Swasta', 'Pedagang', 'Petani', 'TNI-Polri', 'Wiraswasta'],
                    datasets: [{
                        label: '#',
                        data: [data_pekerjaan['None'], data_pekerjaan['ASN'], data_pekerjaan['Dokter'], data_pekerjaan['Karyawan-Swasta'], data_pekerjaan['Pedagang'], data_pekerjaan['Petani'], data_pekerjaan['TNI-Polri'], data_pekerjaan['Wiraswasta']],
                        borderWidth: 1
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

        $("#pNone").text(data_pekerjaan['None']);
        $("#pASN").text(data_pekerjaan['ASN']);
        $("#pDokter").text(data_pekerjaan['Dokter']);
        $("#pKaryawanSwasta").text(data_pekerjaan['Karyawan-Swasta']);
        $("#pPedagang").text(data_pekerjaan['Pedagang']);
        $("#pPetani").text(data_pekerjaan['Petani']);
        $("#pTNIPolri").text(data_pekerjaan['TNI-Polri']);
        $("#pWiraswasta").text(data_pekerjaan['Wiraswasta']);


    } else {
        pesan_error("Terjadi error pada remote api!");
        return false;
    }

    $.LoadingOverlay("hide");

});
