<?php
include '../../koneksi.php';
//delete
$id = $_POST['id'];
$querydelete = "DELETE FROM poli WHERE id = '$id' ";
$resultdelete = mysqli_query($conn, $querydelete);

if($resultdelete){
    header('location: ../datapoli.php');
}else{
    echo "Error: ". $querydelete. "<br>". mysqli_error($conn);
}
?>