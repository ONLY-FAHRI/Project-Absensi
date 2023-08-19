<?php 
include "koneksi.php";

//baca isi tabel tmprfid
$sql = mysqli_query($konek, "select * from tmprfid");

//baca nomorkartu if data is available, otherwise set it to an empty string
$nomorkartu = "";
if ($sql && mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_array($sql);
    $nomorkartu = $data['nomorkartu'];
}
?>

<div class="form-group">
    <label>No.Kartu</label>
    <input type="text" name="nomorkartu" id="nomorkartu" placeholder="Tempelkan Kartu Rfid Anda" class="form-control" style="width:400px" value="<?php echo $nomorkartu; ?>">
</div>
