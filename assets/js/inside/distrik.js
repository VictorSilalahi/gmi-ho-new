import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function() {

    check_token();
  
    $.LoadingOverlay("show");    
    
    loadDataDistrik();

    $.LoadingOverlay("hide");

});


$(document).on('click', ".btn-detail-gereja", function() {

    let gereja_id = $(this).parent().parent().attr("id");

    loadDetailGereja(gereja_id);


});


$(document).on('change', "#slcDistrik", function() {


    if ($(this).val()!=='') {

        let distrik = $(this).val();

        let gereja_url = $("#gereja_url").val();

        let temp = ajax_post(gereja_url+"webapi/v1/distrik/jemaat/all", {"distrik": distrik});

        if (temp.msg=='ok') {
                let data = temp.data;

                // console.log(data);
                
                $(".divNamaDistrik").text(distrik);

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



        temp = ajax_post(gereja_url+"webapi/v1/distrik/gereja/all", {"distrik": distrik});


        if (temp.msg=='ok') {
                let data = temp.data;

                console.log(data);
                let jumlah_gereja = data.length;

                let str = '';
                let no = 1;

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
                    
                    // koordinat.push({"lat": data[i]['lat'], "lng": data[i]['lng'], "kondisi": data[i]['kondisi_bangunan'], "kepemilikan": data[i]['kepemilikan']});

                    // masukkan ke daftar gereja untuk ditampilkan di tabel
                    str = str + "<tr id='"+data[i]['gereja_id']+"'><td>"+no+"</td><td>"+data[i]['nama_gereja']+"</td><td>"+data[i]['alamat']+"</td><td>"+data[i]['email']+"</td><td><button class='btn btn-info btn-detail-gereja'>Detail</button></td></tr>";
                    no++;

                }

                $(".divJumlahJemaatPenuh").text(tipe['Jemaat Penuh']);
                $(".divJumlahJemaatPersiapan").text(tipe['Jemaat Persiapan']);
                $(".divJumlahPospel").text(tipe['Pos Pelayanan']);
                $(".divJumlahGereja").text(jumlah_gereja);

                $("#tblDaftarGereja tbody").html(str);

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


        }

});


function loadDataDistrik() {

    let gereja_url = $("#gereja_url").val();
    let temp = ajax_get(gereja_url+"webapi/v1/distrik/all", {});

    if (temp.msg=='ok') {

        let str = "<option value=''></option>";

        for (let i=0; i<temp.data.length; i++) {

            str = str + "<option value='"+temp.data[i]['nama_distrik']+"'>"+temp.data[i]['nama_distrik']+"</option>";

        }

        $("#slcDistrik").html(str);
    }

}

function loadDetailGereja(gereja_id) {

    gereja_id = gereja_id;

    let gereja_url = $("#gereja_url").val()+"webapi/v1/distrik/resort/gereja/detail";

    let temp = ajax_post(gereja_url, {"gereja_id": gereja_id});

    console.log(temp);

    if (temp.msg=='ok') {

        let data = temp.data;

        let jumlah_jiwa = data[0]['anggota']['jumlah anggota jemaat kk aktif'];
        let jumlah_kk = data[0]['kk']['jumlah kk jemaat aktif'];

        let data_kelompok_umur = data[0]['kelompok umur'];
        let data_pendidikan = data[0]['sebaran pendidikan'];
        let data_pekerjaan = data[0]['sebaran pekerjaan'];
        let data_tipe_jemaat = data[0]['sifat keanggotaan'];

        let temp_aktifitas = data[0]['aktifitas'];

        let temp_jumlah_jemaat_perbulan = data[0]['jumlah_jemaat_perbulan'];

        let label_bulan = [];
        let data_kebaktian = [];
        data_kebaktian['tambah'] = [];
        data_kebaktian['ubah'] = [];
        data_kebaktian['hapus'] = [];
        let data_jemaat = [];
        data_jemaat['tambah'] = [];
        data_jemaat['ubah'] = [];
        data_jemaat['hapus'] = [];
        let data_kegiatan = [];
        data_kegiatan['tambah'] = [];
        data_kegiatan['ubah'] = [];
        data_kegiatan['hapus'] = [];
        let data_jemaat_perbulan = [];
        

        for (let i=temp_aktifitas.length-1; i>=0; i--) {

            label_bulan.push(temp_aktifitas[i]['masa_waktu']);

            data_kebaktian["tambah"].push(parseInt(temp_aktifitas[i]['data']['kebaktian']['tambah']));
            data_kebaktian['ubah'].push(parseInt(temp_aktifitas[i]['data']['kebaktian']['ubah']));
            data_kebaktian['hapus'].push(parseInt(temp_aktifitas[i]['data']['kebaktian']['hapus']));

            data_jemaat['tambah'].push(parseInt(temp_aktifitas[i]['data']['jemaat']['tambah']));
            data_jemaat['ubah'].push(parseInt(temp_aktifitas[i]['data']['jemaat']['ubah']));
            data_jemaat['hapus'].push(parseInt(temp_aktifitas[i]['data']['jemaat']['hapus']));

            data_kegiatan['tambah'].push(parseInt(temp_aktifitas[i]['data']['kegiatan']['tambah']));
            data_kegiatan['ubah'].push(parseInt(temp_aktifitas[i]['data']['kegiatan']['ubah']));
            data_kegiatan['hapus'].push(parseInt(temp_aktifitas[i]['data']['kegiatan']['hapus']));

        }

        for (let i=temp_jumlah_jemaat_perbulan.length-1; i>=0; i--) {

            data_jemaat_perbulan.push(parseInt(temp_jumlah_jemaat_perbulan[i]['jumlah']))
        }

        // console.log(data_jemaat_perbulan);

        $("#nama_gereja").text(data[0]['gereja']['nama_gereja']);
        $("#alamat_gereja").text(data[0]['gereja']['alamat']);
        $("#tipe_gereja").text(data[0]['gereja']['tipe']);
        $("#kondisi_gereja").text(data[0]['gereja']['kondisi']);
        $("#kepemilikan_gereja").text(data[0]['gereja']['kepemilikan']);

        $("#nama_pimpinan_jemaat").text(data[0]['pimpinan_jemaat']['nama']);
        $("#mobile_phone_pimpinan").text(data[0]['pimpinan_jemaat']['mobile_phone']);
        $("#email_pimpinan").text(data[0]['pimpinan_jemaat']['email']);


        // tampilkan kk dan jiwa
        $(".divJumlahJiwa").text(jumlah_jiwa);
        $(".divJumlahKK").text(jumlah_kk);


        let existingChart = Chart.getChart("dTipeJemaat"); 

        if (existingChart) {
            existingChart.destroy();
        }

        // grafik utk tipe jemaat
        const ctx_tipe_jemaat_gereja = document.getElementById('dTipeJemaat');
        new Chart(ctx_tipe_jemaat_gereja, {
                    type: 'pie',
                    data: {
                    labels: ['Penuh', 'Persiapan'],
                    datasets: [{
                        label: '#',
                        data: [data_tipe_jemaat['penuh'], data_tipe_jemaat['persiapan']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
        });


        existingChart = Chart.getChart("dKelompokUsia"); 

        if (existingChart) {
            existingChart.destroy();
        }
        
        // grafik utk kelompok umur
        const ctx_kelompok_umur_gereja = document.getElementById('dKelompokUsia');
        new Chart(ctx_kelompok_umur_gereja, {
                    type: 'pie',
                    data: {
                    labels: ['Anak-anak', 'Remaja', 'Pemuda', 'Dewasa', 'Lansia'],
                    datasets: [{
                        label: '#',
                        data: [data_kelompok_umur['anak-anak'], data_kelompok_umur['remaja'], data_kelompok_umur['pemuda'], data_kelompok_umur['dewasa'], data_kelompok_umur['lansia']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
        });


        existingChart = Chart.getChart("dPendidikanTerakhir"); 

        if (existingChart) {
            existingChart.destroy();
        }

        // grafik utk pendidikan terakhir
        const ctx_pendidikan_terakhir_gereja = document.getElementById('dPendidikanTerakhir');
        new Chart(ctx_pendidikan_terakhir_gereja, {
                    type: 'pie',
                    data: {
                    labels: ['None', 'SD', 'SMP', 'SMA_SMK', 'D3', 'S1', 'S2', 'S3'],
                    datasets: [{
                        label: '#',
                        data: [data_pendidikan['None'], data_pendidikan['SD'], data_pendidikan['SMP'], data_pendidikan['SMA_SMK'], data_pendidikan['D3'], data_pendidikan['S1'], data_pendidikan['S2'], data_pendidikan['S3']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
        });


        existingChart = Chart.getChart("dPekerjaan"); 

        if (existingChart) {
            existingChart.destroy();
        }
        
        // grafik utk pekerjaan
        const ctx_pekerjaan_gereja = document.getElementById('dPekerjaan');
        new Chart(ctx_pekerjaan_gereja, {
                    type: 'pie',
                    data: {
                    labels: ['None', 'ASN', 'Dokter', 'Karyawan-Swasta', 'Pedagang', 'Petani', 'TNI-Polri', 'Wiraswasta'],
                    datasets: [{
                        label: '#',
                        data: [data_pekerjaan['None'], data_pekerjaan['ASN'], data_pekerjaan['Dokter'], data_pekerjaan['Karyawan-Swasta'], data_pekerjaan['Pedagang'], data_pekerjaan['Petani'], data_pekerjaan['TNI-Polri'], data_pekerjaan['Wiraswasta']],
                        borderWidth: 0
                    }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        }
                        }
                        // Do NOT include a 'scales' property here!
                    }
                });


        existingChart = Chart.getChart("dKebaktian"); 

        if (existingChart) {
            existingChart.destroy();
        }        

        // grafik aktifitas kebaktian
        const ctx_kebaktian_gereja = document.getElementById('dKebaktian');
        new Chart(ctx_kebaktian_gereja, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'tambah',
                                    data: data_kebaktian['tambah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'ubah',
                                    data: data_kebaktian['ubah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'hapus',
                                    data: data_kebaktian['hapus'],
                                    borderWidth: 1
                                }

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


        existingChart = Chart.getChart("dOperasiDataJemaat"); 

        if (existingChart) {
            existingChart.destroy();
        }        

        // grafik aktifitas data jemaat
        const ctx_operasi_jemaat_gereja = document.getElementById('dOperasiDataJemaat');
        new Chart(ctx_operasi_jemaat_gereja, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'tambah',
                                    data: data_jemaat['tambah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'ubah',
                                    data: data_jemaat['ubah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'hapus',
                                    data: data_jemaat['hapus'],
                                    borderWidth: 1
                                }

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

        existingChart = Chart.getChart("dKegiatan"); 

        if (existingChart) {
            existingChart.destroy();
        }        
        
        // grafik aktifitas Kegiatan
        const ctx_kegiatan_gereja = document.getElementById('dKegiatan');
        new Chart(ctx_kegiatan_gereja, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'tambah',
                                    data: data_kegiatan['tambah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'ubah',
                                    data: data_kegiatan['ubah'],
                                    borderWidth: 1
                                },
                                {
                                    label: 'hapus',
                                    data: data_kegiatan['hapus'],
                                    borderWidth: 1
                                }

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


        existingChart = Chart.getChart("dJumlahJemaat"); 

        if (existingChart) {
            existingChart.destroy();
        }        
        
        // grafik jumlah jemaat perbulan
        const ctx_jumlah_jemaat_gereja = document.getElementById('dJumlahJemaat');
        new Chart(ctx_jumlah_jemaat_gereja, {
                    type: 'bar',
                    data: {
                        labels: label_bulan,
                        datasets: [
                                {
                                    label: 'jumlah',
                                    data: data_jemaat_perbulan,
                                    borderWidth: 1
                                }

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
        

        let jemaat_awal = data_jemaat_perbulan[0];
        let jemaat_akhir = data_jemaat_perbulan[data_jemaat_perbulan.length-1];
        console.log(jemaat_awal, jemaat_akhir);
        let sisa = 0;
        let perubahan = null;

        $(".jiwaAwal").text(jemaat_awal);
        $(".jiwaAkhir").text(jemaat_akhir);


        $("#modalDetailGereja").modal("show");

        if (jemaat_akhir==jemaat_awal) {
            
            perubahan = 0;
            $(".jiwaPerubahan").text(perubahan+" %");
            return false;

        } 

        if (jemaat_akhir<jemaat_awal) {

            sisa = jemaat_akhir-jemaat_awal;
            perubahan = (sisa/jemaat_awal)*100;
            $(".jiwaPerubahan").text(perubahan+" %");
            return false;

        } 

        if (jemaat_akhir>jemaat_awal) {

            if (jemaat_awal==0) {
                perubahan = 100;
                $(".jiwaPerubahan").text(perubahan+" %");
                return false;

            } else {
                sisa = jemaat_akhir-jemaat_awal;
                perubahan = (sisa/jemaat_awal)*100;
                $(".jiwaPerubahan").text(perubahan+" %");
                return false;

            }

        } 

        if (jemaat_awal==0 && jemaat_akhir>0) {
            perubahan = 100;
            $(".jiwaPerubahan").text(perubahan+" %");
            return false;
        }

    }


}
