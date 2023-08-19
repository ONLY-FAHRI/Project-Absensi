<!-- proses penyimpanan -->

<?php
    include "koneksi.php";
    

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

     //kosongkan tabel rfid
     mysqli_query($konek, "delete from tmprfid");

?>

<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
    <title>Tambah Data Siswa</title>

    <!-- pembacaam nomor kartu otomatis -->
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#nomorrfid").load('nomorkartu.php')
            }, 0);  //pembacaan file nomorkartu.php, tiap 1 detik = 1000
        });
 
    </script>

</head>
<body>
    
    <?php include "menu.php"; ?>

    <!-- isi -->

    <div class="container-fluid">
        <h3>Tambah Data Siswa</h3>

        <!-- formm input -->
        <form method="POST">
            <div id="nomorrfid"></div>

            <div class="form-group">
                <label>Nama Siswa</label>   
                <input type="text" name="nama" id="nama" placeholder
                ="Nama Siswa" class="form-control" style="width:400px" >
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" id="kelas" placeholder
                ="Kelas" class="form-control" style="width:400px" >
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat"
                placeholder="alamat" style="width: 400px"></textarea>
            </div>

            <button class="btn btn-primary" name="btnSimpan" id="btnSimpan
            ">Simpan</button>
        </form>

    </div>


    <?php include "footer.php"; ?>


    
</body>
</html>