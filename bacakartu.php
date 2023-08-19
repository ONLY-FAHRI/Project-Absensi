<?php 
include "koneksi.php";

// baca tabel status untuk absensi mode
$sql = mysqli_query($konek, "select * from status_absen");
$data = mysqli_fetch_array($sql);
$mode_absen = $data['mode'];

// uji mode absen
$mode = "";
if ($mode_absen == 1)
    $mode = "Masuk";
else if ($mode_absen == 2)
    $mode = "Istirahat";
else if ($mode_absen == 3)
    $mode = "Kembali";
else if ($mode_absen == 4)
    $mode = "Pulang";

// baca tabel tmprfid
$baca_kartu = mysqli_query($konek, "select * from tmprfid");
$data_kartu = mysqli_fetch_array($baca_kartu);

// Periksa apakah ada data dalam hasil kueri
if ($data_kartu !== null) {
    $nomorkartu = $data_kartu['nomorkartu'];
} else {
    $nomorkartu = ""; // Atur ke nilai default jika tidak ada data
}
?>

<div class="container-fluid" style="text-align: center;">
    <?php if ($nomorkartu == "") { ?>

    <h3>Silahkan Tempelkan Kartu Rfid Anda</h3>
    <img src="images/rfid.png" style="width: 400px"> <br>
    <img src="images/animasi2.gif" style="width: 400px"> <br>
    <h3>Absen Mode : <?php echo $mode; ?></h3>

    <?php } else {
        // cek nomor kartu rfid tersebut terdaftar di tabel siswa
        $cari_siswa = mysqli_query($konek, "select * from siswa
            where nomorkartu='$nomorkartu'");
        $jumlah_data = mysqli_num_rows($cari_siswa);

        if ($jumlah_data == 0)
            echo "<h1>Maaf, Kartu Tidak Di Kenali</h1>";

        else 
        {
            // ambil nama siswa
            $data_siswa = mysqli_fetch_array($cari_siswa);
            $nama = $data_siswa['nama'];

            // tanggal dan jam hari ini
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('y-m-d');
            $jam     = date('h:i:s');

            // cek tabel absensi, apakah nomor kartu tsb sudah ada
            // sesuai dengan tanggal ini
            // jika belum ada maka dianggap absen masuk 
            // dan kalau sudah ada maka update sesuai dengan mode absensi
            $cari_absen = mysqli_query($konek, "select * from absensi
                where nomorkartu='$nomorkartu' and tanggal='$tanggal'");
            // hitung jumlah datanya
            $jumlah_absen = mysqli_num_rows($cari_absen);
            if ($jumlah_absen == 0)
            {
                echo "<h1>Selamat Datang <br> $nama </h1>";
                mysqli_query($konek, "insert into absensi(nomorkartu,
                    tanggal, jam_masuk) values('$nomorkartu', '$tanggal', '$jam')");
            }
            else
            {
                // update sesuai pilihan mode absen
                if ($mode_absen == 2)
                {
                    echo "<h1>Selamat Istirahat <br> $nama</h1>";
                    mysqli_query($konek, "update absensi set
                        jam_istirahat='$jam' where nomorkartu='$nomorkartu' and
                        tanggal='$tanggal'");
                }
                elseif ($mode_absen == 3)
                {
                    echo "<h1>Selamat Datang Kembali <br> $nama</h1>";
                    mysqli_query($konek, "update absensi set jam_kembali='$jam' where nomorkartu='$nomorkartu' and tanggal='$tanggal'");
                }
                elseif ($mode_absen == 1)
                {
                    echo "<h1>Selamat Datang<br> $nama</h1>";
                    mysqli_query($konek, "update absensi set jam_kembali='$jam' where nomorkartu='$nomorkartu' and tanggal='$tanggal'");
                }
                elseif ($mode_absen == 4)
                {
                    echo "<h1>Selamat jalan <br> $nama</h1>";
                    mysqli_query($konek, "update absensi set jam_pulang='$jam' where nomorkartu='$nomorkartu' and tanggal='$tanggal'");
                }
            }
        }

        // kosongkan tabel tmprfid
        mysqli_query($konek, "delete from tmprfid");
    }?> 
</div>
