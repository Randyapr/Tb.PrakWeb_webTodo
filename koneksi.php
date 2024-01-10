<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_todolist");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

function registrasi($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);


    // cek user name sudah ada atau belum 
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");

    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah terdaftar!')
            <script>";
        return false;
    }

    // Cek koneksi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // tambahkan userbaru ke databse
    mysqli_query($koneksi, "INSERT INTO users VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($koneksi);

}
?>
