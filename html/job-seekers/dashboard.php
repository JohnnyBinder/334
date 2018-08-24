<?php
  require_once '../login.php';
  require_once '../env.php';

  session_start();

  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error);

  if ($_SESSION['login'] !== "success") {
    header($url);
  }

 ?>

<!doctype html>
<html lang="en">

<?php include '../components/header.php'; ?>

<body class="cover-image">
  <?php include '../components/nav.php'; ?>
  
  <div class="container-fluid">
    <div class="row">
      <?php include '../components/sidebar.php'; ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="pt-2">Welcome, <?= $_SESSION['fname'] ?></h1>
        
        <hr>

        Change first name, last name and category

        List of all jobs pertaining to their category

      </main>
    </div>
  </div>

  <?php include '../components/scripts.php'; ?>
</body>

</html>