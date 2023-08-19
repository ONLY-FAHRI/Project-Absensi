<!-- proses penyimpanan -->

<?php
    include "koneksi.php";

    //baca ID data yang akan di edit
    $id = $_GET['id'];

    //baca data karyawan berdasarkan id 
    $cari = mysqli_query($konek, "select * from siswa where id='$id'");
    $hasil = mysqli_fetch_array($cari);

    //jika tombol simpan di klick
    if(isset($_POST['btnSimpan']))
    {
        //baca isi inputan form
        $nomorkartu = $_POST['nomorkartu'];
        $nama       = $_POST['nama'];
        $kelas      = $_POST['kelas'];
        $alamat     = $_POST['alamat'];

        //simpan ke table siswa
        $simpan = mysqli_query($konek, "insert into siswa(nomorkartu,
            nama, kelas, alamat)values('$nomorkartu', '$nama', '$kelas', '$alamat')");

        //jika berhasil tersimpan, tampilkan pesan tersimpan,
        //kembali ke data karyawan
        if($simpan)
        {
            echo "
                <script>
                    alert('tersimpan');
                    location.replace('datasiswa.php');
                </script>
            ";
        }
        else
        {
            echo "
                <script>
                    alert('gagal tersimpan');
                    location.replace('datasiswa.php');
                </script>
            ";
        }

     }

?>

<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
    <title>Tambah Data Siswa</title>
</head>
<body>
    
    <?php include "menu.php"; ?>

    <!-- isi -->

    <div class="container-fluid">
        <h3>Tambah Data Siswa</h3>

        <!-- form input -->
        <form method="POST">
            <div class="form-group">
                <label>No.Kartu</label>
                <input type="text" name="nomorkartu" id="nomorkartu" placeholder
                ="Nomor Kartu Rfid" class="form-control" style="width:400px" 
                    value="<?php echo $hasil['nomorkartu']; ?>">
            </div>
            <div class="form-group">
                <label>Nama Siswa</label>   
                <input type="text" name="nama" id="nama" placeholder
                ="Nama Siswa" class="form-control" style="width:400px" 
                    value="<?php echo $hasil['nama']; ?>">
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" id="kelas" placeholder
                ="Kelas" class="form-control" style="width:400px"
                    value="<?php echo $hasil['kelas']; ?>"> 
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat"
                placeholder="alamat" style="width:400px"><?php echo $hasil['alamat']; ?></textarea>
            </div>

            <button class="btn btn-primary" name="btnSimpan" id="btnSimpan
            ">Simpan</button>
        </form>

    </div>


    <?php include "footer.php"; ?>


    
</body>
</html>