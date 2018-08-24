<?php
  require_once '../login.php';
  require_once '../env.php';

  session_start();

  $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['email']) &&
      isset($_POST['fname']) && 
      isset($_POST['lname']) && 
      isset($_POST['category']) && 
      isset($_POST['password']) &&  
      isset($_POST['company']) && 
      isset($_POST['job_details'])) {
    $stmt = $conn->prepare("INSERT INTO hiring_managers (email, fname, lname, password, company, category, job_details, role) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $email, $fname, $lname, $password, $company, $category, $job_details, $role);

    $email = get_post($conn, 'email');
    $fname = get_post($conn, 'fname');
    $lname = get_post($conn, 'lname');
    $category = get_post($conn, 'category');
    $password = get_post($conn, 'password');
    $education = get_post($conn, 'company');
    $experience = get_post($conn, 'job_details');
    $role = 1;

    if($stmt->execute()) {
      $_SESSION['login'] = "success";
      $_SESSION['email'] = $email;
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      $_SESSION['company'] = $company;
      $_SESSION['job_details'] = $job_details;
      $_SESSION['role'] = 1;
      header("Location: " . $url . "hiring-managers/dashboard.php");
    } 
    else {
      $_SESSION['login'] = "failed";
      header("Location: " . $url);
    }

    $stmt->close();
  }

  function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
  }

  $postURL = $url . "hiring-managers/registration.php";
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
        <h1 class="pt-2">Hiring Manager Registration</h1>
        
        <hr>

        <form action="<?= $postURL ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="example@website.com" required>
          </div>

          <div class="form-group">
            <label for="fname">First name</label>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="John" required>
          </div>

          <div class="form-group">
            <label for="lname">Last name</label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Smith" required>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="yourpassword@123" required>
          </div>

          <div class="form-group">
            <label for="category">Job Area</label>
            <input type="text" class="form-control" name="category" id="category" placeholder="Software Engineer" required>
          </div>

          <div class="form-group">
            <label for="company">Company</label>
            <input class="form-control" name="company" id="company" placeholder="Company name here..." required>
          </div>
          
          <div class="form-group">
            <label for="job_details">Job Details</label>
            <textarea rows="3" class="form-control" name="job_details" id="job_details" placeholder="Details here..." required></textarea>
          </div>

          <hr>

          <input class="btn btn-primary" type="submit" value="Save">
        </form>
      </main>
    </div>
  </div>

  <?php include '../components/scripts.php'; ?>
</body>

</html>