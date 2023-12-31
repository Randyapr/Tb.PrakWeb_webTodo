<!DOCTYPE html>
<html lang="en">

<head>
     <title>Update Task</title>
     <link rel="stylesheet" href="styleedit.css">
</head>

<body>
     <header class="header">
          <a href="#" class="todo">Todo</a>
          <nav class="navbar">
               <a href="index.php"> Lihat data</a>
          </nav>
     </header>
     <div class="container">
          <h1>Edit Task</h1>
          <?php
          include 'koneksi.php';

          $id = $_GET['id'];
          $query = "SELECT * FROM todo WHERE id = $id";
          $result = mysqli_query($koneksi, $query);

          while ($data = mysqli_fetch_array($result)) {
          ?>
               <form action="./crud/update.php" method="post">
                    <label for="task">Task</label>
                    <input type="text" value="<?= $data['task'] ?>" name="task" class="form input" maxlength="35" required>
                    <br>

                    <label for="date">Date</label>
                    <input type="date" value="<?= $data['waktu'] ?>" name="date" class="form input" maxlength="35" required>

                    <label for="desc">Description</label><br>
                    <textarea name="desc" class="form input" maxlength="255" required><?= $data['desc'] ?></textarea><br>
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
