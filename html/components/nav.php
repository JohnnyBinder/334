<?php
  session_start();
  require_once '../env.php';

  $hiring = $url . "hiring-managers/login.php";
  $seeker = $url . "job-seekers/login.php";
?>

<nav class="navbar navbar-dark fixed-top bg-dark p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?= $url ?>">In the Circle</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="dropdown-item text-right text-primary" href="<?= $hiring ?>">
          <?php
            if ($_SESSION['login'] === "success" && $_SESSION['role'] === 0)
              echo "<span data-feather=\"log-out\"></span> Job Seeker Sign out";
            else
              echo "<span data-feather=\"log-in\"></span> Job Seeker Sign in"
          ?>
        </a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item text-right text-primary" href="<?= $seeker ?>">
          <?php
            if ($_SESSION['login'] === "success" && $_SESSION['role'] === 1)
              echo "<span data-feather=\"log-out\"></span> Hiring Sign out";
            else
              echo "<span data-feather=\"log-in\"></span> Hiring Sign in"
          ?>
        </a>
      </li>
    </ul>
</div>
</nav>