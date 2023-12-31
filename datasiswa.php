<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
    <title>Data Siswa</title>
</head>
<body>

    <?php include "menu.php"; ?>

    <!--isi-->
    <div class="container-fluid">
        <h3>Data Siswa</h3>
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: grey; color: white;">
                    <th style="width: 10px; text-align:center">No.</th>
                    <th style="width: 300px; text-align:center">No.Kartu</th>
                    <th style="width: 400px; text-align:center">Nama</th>
                    <th style="width: 300px; text-align:center">Kelas</th>
                    <th style="text-align:center">Alamat</th>
                    <th style="width: 100px; text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 
                //koneksi ke database 
                include "koneksi.php";
                
                //baca data siswa
                $sql = mysqli_query($konek, "select * from siswa");
                $no = 0;
                while($data = mysqli_fetch_array($sql))
                {
                    $no++;
             ?>
                <tr>
                    <td> <?php echo $no; ?> </td>
                    <td> <?php echo $data['nomorkartu']; ?> </td>
                    <td> <?php echo $data['nama']; ?> </td>
                    <td> <?php echo $data['kelas']; ?> </td>
                    <td> <?php echo $data['alamat']; ?> </td>
                    <td>
                        <a href="edit.php?id=<?php echo $data['id']; ?>">
                        Edit</a> | 
                        <a href="hapus.php?id=<?php echo $data['id']; ?>"> Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <!-- tombol tambah data siswa-->
        <button class="btn btn-primary" style="background-color: #4CAF50;">Tambah Data Siswa</button>

    </div>

    <?php include "footer.php"; ?>


    
</body>
</html>