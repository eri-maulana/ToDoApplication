<?php
$todos = [];
if (file_exists('todo.txt')) {
   $file = file_get_contents('todo.txt');
   $todos = unserialize($file);
}

if (isset($_POST['todo'])) {
   $data = $_POST['todo'];

   $todos[] = [
      'todo' => $data,
      'status' => 0.
   ];
   file_put_contents('todo.txt', serialize($todos));
   header('Location: index.php');
}

if (isset($_GET['status'])) {
   $todos[$_GET['todo']]['status'] = $_GET['status'];
   file_put_contents('todo.txt', serialize($todos));
   header('Location: index.php');
}

print_r($todos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>To Do Application</title>
</head>

<body>
   <h1>To Do Application</h1> <br>

   <form action="" method="post">
      <label>Apa Kegiatanmu Hari ini?</label> <br>
      <input type="text" name="todo" id="">
      <button type="submit">Simpan</button>
   </form>

   <ul>
      <?php
      foreach ($todos as $todo => $do) :
      ?>
      <li>
         <input type="checkbox" name="todo" id=""
            onclick="window.location.href='index.php?status=<?php echo ($do['status'] == 1) ? '0' : '1'; ?>&todo=<?= $todo; ?>'"
            <?php if ($do['status'] == 1) echo 'checked'; ?>>
         <label for="">
            <?php
               if ($do['status'] == 1) {
                  echo '<del>' . $do['todo'] . '</del>';
               } else {
                  echo $do['todo'];
               }  ?>
         </label>
         <a href="#">hapus</a>
      </li>
      <?php
      endforeach;
      ?>

   </ul>
</body>

</html>