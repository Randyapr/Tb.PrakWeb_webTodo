<?php
session_start();
require 'koneksi.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil usera=name berdasarkan id
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


// lamun eror ke langsung ka default
$error = false;

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me 
            if (isset($_POST['remember'])) {
                // buat cookie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sh256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        } else {
            $error = true;
            $errorMessage = "Password salah.";
        }
    } else {
        $error = true;
        $errorMessage = "Username tidak ditemukan.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background: url(asset/backg.jpg);
        }

        h1 {
            text-align: center;
            color: #f4f4f4;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #217dbb;
        }

        .error-message {
            color: #e74c3c;
            margin-top: 20px;
            text-align: center;
        }


        .register-link {
            color: red;
            padding: 10px;

        }

        /* CSS untuk elemen checkbox dan label dalam konteks div.checkbox */

        /* CSS */
        /* CSS */
        .checkbox-container {
            display: flex;
            align-items: baseline;
            margin-bottom: 15px;
            /* Tambahkan margin antara checkbox dan tombol login */
        }

        .checkboxouter {
            height: 25px;
            width: 25px;
            border-radius: 3px;
            position: relative;
            display: inline-block;
            /* Warna merah untuk checkbox */
            margin-right: 10px;
            /* Tambahkan margin antara checkbox dan label */
        }

        .checkbox {
            position: absolute;
            background-color: transparent;
            height: 16px;
            width: 6px;
            margin: auto;
            color: #e74c3c;
            /* Warna merah untuk tanda centang */
            left: 50%;
            transform: rotate(45deg);
            transform-origin: -35% 30%;
            transition: all 0.2s;
        }

        .checkboxouter input[type="checkbox"]:checked~.checkbox {
            background-color: transparent;
            /* Menghilangkan tanda centang saat checkbox dicentang */
        }


        /* CSS untuk link registrasi */
        .register-link {
            color: #217dbb;
            padding: 10px;
            text-decoration: none;
        }
    </style>

</head>

<body>


    <h1>Halaman Login</h1>

    <?php if ($error) : ?>
        <p class="error-message"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <!-- <div style="text-align: center;"> -->
            <!-- HTML -->
            <div class="checkbox-container">
                <div class="checkboxouter">
                    <input type="checkbox" name="rememberme" id="remember" value="Remember">
                    <label class="checkbox"></label>
                </div>
                <label for="remember">Remember me</label>
            </div>


            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>

        <p>belum punya akun ? <a href="registrasi.php" class="register-link">Register di sana.</a></p>

    </form>


</body>

</html>