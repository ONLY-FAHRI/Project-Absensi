<?php
    include "koneksi.php";

    //baca mode absensi terakhir
    $mode_query = mysqli_query($konek, "SELECT * FROM status_absen");
    
    if ($mode_query) {
        $data_mode = mysqli_fetch_array($mode_query);
        $mode_absen = $data_mode['mode'];

        //status terahir di tambah 1
        $mode_absen = $mode_absen + 1;
        if ($mode_absen > 4)
            $mode_absen = 1;

        //simpan mode absen di tabel status_absen dengan cara update
        $simpan = mysqli_query($konek, "UPDATE status_absen SET mode='$mode_absen'");

        if ($simpan) {
            echo "BERHASIL UPDATE";
        } else {
            echo "Gagal saat mengupdate mode.";
        }
    } else {
        echo "Gagal saat membaca mode.";
    }
?>
