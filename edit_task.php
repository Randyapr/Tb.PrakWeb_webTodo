<?php
session_start();
if (!isset($_SESSION["login"])) {
     header("Location: login.php");
     exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <title>Update Task</title>
     <link rel="stylesheet" href="styleAdd.css">
</head>

<body>
     <div class="kotak">
          <h1> Update Task</h1>
          <?php
          include 'koneksi.php';

          $id = $_GET['id'];
          $query = "SELECT * FROM todo WHERE id = $id";
          $result = mysqli_query($koneksi, $query);

          while ($data = mysqli_fetch_array($result)) {
          ?>
               <form action="./crud/update.php" method="post">
                    <label for="task"><span style="color: red;">* </span> Task</label>
                    <input type="text" value="<?= $data['task'] ?>" name="task" class="form input" maxlength="35" required>
                    <br>

                    <label for="date"><span style="color: red;">* </span> Date</label>
                    <input type="date" value="<?= $data['waktu'] ?>" name="date" class="form input" maxlength="35" required>

                    <label for="desc">Desc</label>
                    <input type="text" value="<?= $data['desc'] ?>" name="desc" class="form input" maxlength="35" ><br>
                    <br>

                    <input type="hidden" name="id" value="<?= $data['id'] ?>">

                    <button type="submit" id="btnKirim">
                         Update
                    </button>
               </form>
          <?php } ?>
     </div>
</body>

</html>