<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "header.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Absensi</title>
</head>
<body>

    <?php include "menu.php"; ?>

    <!-- isi -->
    <div class="container-fluid">
        <h3>Rekap Absensi</h3>
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: grey; color:white">
                    <th style="width: 10px; text-align: center">No.</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">Kelas</th>
                    <th style="text-align: center">Tanggal</th>
                    <th style="text-align: center">Jam Masuk</th>
                    <th style="text-align: center">Jam Istirahat</th>
                    <th style="text-align: center">Jam Kembali</th>
                    <th style="text-align: center">Jam Pulang</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "koneksi.php";

                    //baca tabel absensi dan relasikan dengan siswa berdasarkan nomor kartu RFID untuk tanggal hari ini 

                    //baca tanggal saat ini
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal = date('Y-m-d');

                    //filter absensi berdasarkan tanggal saat ini
                    $sql = mysqli_query($konek, "select b.nama, 
                        b.kelas, a.tanggal, a.jam_masuk, a.jam_istirahat, 
                        a.jam_kembali, a.jam_pulang from absensi a,
                        siswa b where a.nomorkartu=b.nomorkartu and 
                        a.tanggal='$tanggal' ");

                    $no = 0;
                    while($data = mysqli_fetch_array($sql))
                    {
                        $no++;
                ?>
                <tr>
                    <td> <?php echo $no; ?> </td>
                    <td> <?php echo $data['nama']; ?> </td>
                    <td> <?php echo $data['kelas']; ?> </td>
                    <td> <?php echo $data['tanggal']; ?> </td>
                    <td> <?php echo $data['jam_masuk']; ?> </td>
                    <td> <?php echo $data['jam_istirahat']; ?> </td>
                    <td> <?php echo $data['jam_kembali']; ?> </td>
                    <td> <?php echo $data['jam_pulang']; ?> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <!-- export exel-->

    <p align='center'>
    <input type="button" value="Eksport Excel" onclick="window.open('laporan-excel.php')" style="background-color: 
    #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">

    <!-- export word-->
    
    <input type="button" value="Eksport Word" onclick="window.open('laporan-word.php')" style="background-color: 
    #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
    </p> <br>



    <?php include "footer.php"; ?> 


    

</body>
</html>
