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
      isset($_POST['education']) && 
      isset($_POST['experience'])) {
    $stmt = $conn->prepare("INSERT INTO job_seekers (email, fname, lname, password, education, category, experience, role) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $email, $fname, $lname, $password, $education, $category, $experience, $role);

    $email = get_post($conn, 'email');
    $fname = get_post($conn, 'fname');
    $lname = get_post($conn, 'lname');
    $category = get_post($conn, 'category');
    $password = get_post($conn, 'password');
    $education = get_post($conn, 'education');
    $experience = get_post($conn, 'experience');
    $role = 0;

    if($stmt->execute()) {
      $_SESSION['login'] = "success";
      $_SESSION['email'] = $email;
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      $_SESSION['education'] = $education;
      $_SESSION['experience'] = $experience;
      $_SESSION['role'] = 0;
      header("Location: " . $url . "job-seekers/dashboard.php");
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

  $postURL = $url . "job-seekers/registration.php";
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
        <h1 class="pt-2">Job Seeker Registration</h1>
        
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
            <label for="education">Education</label>
            <textarea class="form-control" rows="3" name="education" id="education" placeholder="Education here..." required></textarea>
          </div>
          
          <div class="form-group">
            <label for="experience">Experience</label>
            <textarea rows="3" class="form-control" name="experience" id="experience" placeholder="Experience here..." required></textarea>
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