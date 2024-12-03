<form action="" method="post">
    <table>
        <tr>
            <td>Nama </td>
            <td><input type="text" name="nama"></td>
        </tr>
        <tr>
            <td>email </td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>password </td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="daftar" name="daftar"></td>
        </tr>
    </table>
</form>

<?php
include "koneksi.php";

if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    mysqli_query($conn, "INSERT INTO user (nama, email, pass ) VALUES ('$nama', '$email' , '$password')");

}

?>