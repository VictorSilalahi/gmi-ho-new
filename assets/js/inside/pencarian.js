import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function () {

    $.LoadingOverlay("show");

    check_token();

    $.LoadingOverlay("hide");

});

$(document).on("keydown", "#txtCari", function(e) {

    if (e.key === 'Enter') {
      // Prevent the default action (like submitting a form) if necessary
      e.preventDefault(); 

      if ($("#txtCari").val()!=='') {

        let kata = $("#txtCari").val();

        let gereja_url = $("#gereja_url").val()+"webapi/v1/wilayah/cari";

        let temp = ajax_post(gereja_url, {"cari": kata});

        let str = '';
        
        if (temp.msg=='ok') {

            console.log(temp.data);

            let no = 1
            for (let i=0; i<temp.data.length; i++) {

                str = str + "<tr id='"+temp.data[i]['gereja_id']+"'><td>"+no+"</td><td>"+temp.data[i]['nama_gereja']+"</td><td>"+temp.data[i]['alamat']+"</td><td>"+temp.data[i]['tipe']+"</td><td>"+temp.data[i]['distrik']+"</td><td><button class='btn btn-info btn-detail-gereja'>Detail</button></td></tr>";
                no++;

            }

            $("#tblGereja tbody").html(str);

        }

      }
    }    

});


$(document).on("click", ".btn-detail-gereja", function() {

    let gereja_id = $(this).parent().parent().attr("id");

    loadDetailGereja(gereja_id);    

});


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
        const ctx_tipe_jemaat = document.getElementById('dTipeJemaat');
        new Chart(ctx_tipe_jemaat, {
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
        const ctx_kelompok_umur = document.getElementById('dKelompokUsia');
        new Chart(ctx_kelompok_umur, {
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
        const ctx_pendidikan_terakhir = document.getElementById('dPendidikanTerakhir');
        new Chart(ctx_pendidikan_terakhir, {
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
        const ctx_pekerjaan = document.getElementById('dPekerjaan');
        new Chart(ctx_pekerjaan, {
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
        const ctx_kebaktian = document.getElementById('dKebaktian');
        new Chart(ctx_kebaktian, {
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
        const ctx_operasi_jemaat = document.getElementById('dOperasiDataJemaat');
        new Chart(ctx_operasi_jemaat, {
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
        const ctx_kegiatan = document.getElementById('dKegiatan');
        new Chart(ctx_kegiatan, {
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
        const ctx_jumlah_jemaat = document.getElementById('dJumlahJemaat');
        new Chart(ctx_jumlah_jemaat, {
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


