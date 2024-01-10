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
     <title>Form tamu</title>
     <link rel="stylesheet" href="styleAdd.css">
     <style>
          .required {
               color: red;
          }
     </style>
</head>

<body>
     <header class="header">
          <a href="#" class="todo">Todo</a>
          <nav class="navbar">
               <a href="index.php"> Lihat data</a>
          </nav>
     </header>
     <div class="container">
          <h1>Add Task</h1>
          <form action="./crud/create.php" method="post">
               <label for="task"><span class="required">*</span> Task</label>
               <input type="text" name="task" maxlength="255" required> <br><br>

               <label for="date"><span class="required">*</span> Date</label>
               <input type="date" name="date" required> <br><br>

               <label for="desc"> Description</label><br>
               <textarea name="desc" rows="4" cols="50"></textarea> <br>

               <button type="submit" id="btnKirim">
                    Add Task
               </button>
          </form> <br>
     </div>
</body>

</html>
