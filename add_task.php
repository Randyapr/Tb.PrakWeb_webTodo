<!DOCTYPE html>
<html lang="en">

<head>
     <title>Form tamu</title>
     <link rel="stylesheet" href="styleAdd.css">
</head>

<body>
     <header class="header">
          <a href"#" class="todo">Todo</a>

          <nav class="navbar">
               <a href="index.php"> Lihat data</a>

          </nav>

     </header>
     <div class="container">
          <h1>Add Task</h1>
          <form action="./crud/create.php" method="post">
               <label for="task">Task</label>
               <input type="text" name="task" maxlength="255" required> <br><br>

               <label for="date">Date</label>
               <input type="date" name="date" required> <br><br>

               <label for="desc">Description</label><br>
               <textarea name="desc" rows="4" cols="50"></textarea> <br>

               <button type="submit" id="btnKirim">
                    Add Task
               </button>
          </form> <br>
     </div>
</body>

</html>