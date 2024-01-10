<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}


include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Todo</title>
    <link rel="stylesheet" href="styleindex.css">
    <script>
        function konfirmasiLogout() {
            var dialog = confirm("Apakah Anda yakin ingin logout?");
            if (dialog == true) {
                window.location.href = 'logut.php';
            }
        }
    </script>
    
</head>

<body>



    <header class="header">
        <a href"#" class="todo">Todo</a>

        <nav class="navbar">
            <a href="?status=all">Semua Data</a>
            <a href="?status=completed">Selesai</a>
            <a href="?status=not_completed">Belum Selesai</a>
            <a href="#" class="logout" onclick="konfirmasiLogout()">Logout</a>

        </nav>

        


    </header>

    <div class="container">
        <h2>Data Todo</h2>
        <a href="add_task.php" class="btn btn-primary">Tambah Task</a>

        <table border="1">
            <tr>
                <th>NO</th>
                <th>TASK</th>
                <th>WAKTU</th>
                <th>DESKRIPSI</th>
                <th>STATUS</th>
                <th>Action</th>
            </tr>

            <?php
            $statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';
            $statusCondition = '';

            if ($statusFilter == 'completed') {
                $statusCondition = 'WHERE completed = 1';
            } elseif ($statusFilter == 'not_completed') {
                $statusCondition = 'WHERE completed = 0';
            }

            $query = "SELECT * FROM todo $statusCondition";
            $todo = mysqli_query($koneksi, $query);

            while ($data = mysqli_fetch_array($todo)) {
                $completedClass = $data['completed'] ? 'completed' : '';
                echo "<tr class='$completedClass'>";
                echo "<td>{$data['id']}</td>";
                echo "<td>{$data['task']}</td>";
                echo "<td>{$data['waktu']}</td>";
                echo "<td>{$data['desc']}</td>";
                echo "<td>";
                echo $data['completed'] ? 'Selesai' : 'Acan Selesai';
                echo "</td>";
                echo "<td class='action-buttons'>";
                echo "<a href='edit_task.php?id={$data['id']}' class='btn btn-primary'>Edit</a>";
                echo "<a href='./crud/delete.php?id={$data['id']}' onclick='return konfir({$data['id']})' class='btn btn-danger'>Hapus</a>";
                if ($data['completed']) {
                    echo "<span class='btn btn-success'>Selesai</span>";
                } else {
                    echo "<a href='./crud/complete.php?id={$data['id']}' class='btn btn-success'>Tandai Selesai</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <script>
        function konfir(id) {
            var dialog = confirm("Yakin ingin menghapus data?");
            if (dialog == true) {
                window.location.href = './crud/delete.php?id=' + id;
            }
            return dialog;
        }
        
    </script>

</body>

</html>