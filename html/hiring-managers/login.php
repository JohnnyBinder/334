<?php
  require_once '../login.php';
  require_once '../env.php';
  require_once '../functions.php';

  session_start();

  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = get_post($conn, 'email');
    $password = get_post($conn, 'password');
    $query = "SELECT * FROM hiring_managers WHERE email=$email";
    $result = $conn->query($query);

    if (!$result) die("Database access failed: " . $conn->error);
    
    $_SESSION['login'] = "success";
    $_SESSION['email'] = $result->fetch_assoc()['email'];
    $_SESSION['fname'] = $result->fetch_assoc()['fname'];
    $_SESSION['lname'] = $result->fetch_assoc()['lname'];

    header("Location: " . $url . "hiring-managers/dashboard.php");
  }

  if ($_SESSION['login'] !== "success") {
    header("Location: " . $url);
  }
?>

<!doctype html>
<html lang="en">
  <body class="cover-image">
    <?php include '../components/nav.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include '../components/sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <h1 class="pt-2">Sign in</h1>
          
          <hr>

          <form action="">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="example@website.com" required>
            </div>

            <div class="form-group">
              <label for="password">Password:</label>
              <input type="passwod" class="form-control" name="password" id="password" placeholder="yourpassword@123" required>
            </div>

            <hr>

            <input type="submit" class="btn btn-success" value="Sign in">

          </form>

        </main>
      </div>
    </div>

    <?php include '../components/scripts.php'; ?>
  </body>
</html>