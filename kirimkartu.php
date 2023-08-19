<?php
    include "koneksi.php";

    //baca nomor kartu dari NODEMCU
    $nomorkartu = $_GET['nomorkartu'];
    //kosongkan tabel rfid
    mysqli_query($konek, "delete from tmprfid");


    //simpan nomor kartu yang baru ke tabel rfid
    $simpan = mysqli_query($konek, "insert into tmprfid(nomorkartu)values('$nomorkartu')");
    if($simpan)
        echo "BERHASIL";
    else
        echo "GAGAL";
?>