<?php
  require_once '../login.php';
  require_once '../env.php';

  session_start();

  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error);

  if ($_SESSION['login'] !== "success") {
    header($url);
  }

  $query = "SELECT * FROM job_seekers";
  $result = $conn->query($query);

  if (!result) die("Database access failed: " . $conn->error);

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

    <?php
      echo "<table id=\"table\"><thead><tr><th>Email</th><th>First Name</th><th>Last Name</th><th>Category</th><th>Education</th><th>Experience</th></tr></thead>";
        for ($j = 0 ; $j < $rows ; ++$j)
        {
          $result->data_seek($j);
          $row = $result->fetch_array(MYSQLI_NUM);

          echo "<tr>";
            for ($k = 0; $k < 5; ++$k) {
              if ($k != 3)
                echo "<td>$row[$k]</td>";
            }
          echo "</tr>";
        }
        echo "</table>";
      ?>
      </main>
    </div>
  </div>

  <?php include '../components/scripts.php'; ?>
  <script>
    $(document).ready(function() {
      $('#table').DataTable();
    });
  </script>
</body>

</html>