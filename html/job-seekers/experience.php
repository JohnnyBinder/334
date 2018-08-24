<?php
  require_once '../login.php';
  require_once '../env.php';
  require_once '../functions.php';

  session_start();

  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error);

  if ($_SESSION['login'] !== "success") {
    header($url);
  }

  $education = $_SESSION['experience'];

  if (isset($_POST['experience'])) {
    $experience = get_post($conn, 'experience');
    $_SESSION['experience'] = $experience;
    $email = $_SESSION['email'];

    $query = "UPDATE job_seekers SET experience=\"$experience\" WHERE email=\"$email\"";
    $result = $conn->query($query);

    if (!$result) die("Database access failed: " . $conn->error);

    header("Location: " . $url . "job-seekers/experience.php");
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
        <h1 class="pt-2">Your Experience</h1>
        
        <hr>

        <form action="<?= $url . "job-seekers/experience.php" ?>" method="POST">
          <div class="form-group">
            <label for="experience">Experience</label>
            <textarea name="experience" class="form-control"><?= $_SESSION['experience'] ?></textarea>
          </div>

          <input type="submit" class="btn btn-primary" value="Save">
        </form>


      </main>
    </div>
  </div>

  <?php include '../components/scripts.php'; ?>
</body>

</html>