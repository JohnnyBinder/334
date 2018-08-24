<?php
  require_once '../env.php';

  session_start();
?>

<?php 
  if ($_SESSION['login'] === "success" && $_SESSION['role'] === 0) {
    $dashboard = $url . "job-seekers/dashboard.php";
    $education = $url . "job-seekers/education.php";
    $experience = $url . "job-seekers/experience.php";

    echo <<< HTML
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link " href="$url">
            <span data-feather="home"></span>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="$dashboard">
            <span data-feather="pie-chart"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="$education">
            <span data-feather="book-open"></span>
            Education 
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="$experience">
            <span data-feather="briefcase"></span>
            Experience
          </a>
        </li>
        </ul>
      </div>
    </nav>
HTML;
  } else if ($_SESSION['login'] === "success" && $_SESSION['role'] === 1) {
    $dashboard = $url . "hiring-managers/dashboard.php";
    $education = $url . "hiring-managers/education.php";
    $experience = $url . "hiring-managers/experience.php";

    echo <<< HTML
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link " href="$url">
            <span data-feather="home"></span>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="$dashboard">
            <span data-feather="pie-chart"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="$education">
            <span data-feather="book-open"></span>
            Company 
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="$experience">
            <span data-feather="briefcase"></span>
            Job Details
          </a>
        </li>
        </ul>
      </div>
    </nav>

  } else {

  echo <<< HTML
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="$url">
            <span data-feather="home"></span>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="info"></span>
            About us
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="phone"></span>
            Contact
          </a>
        </li>
        </ul>
      </div>
    </nav>
HTML;
  }
?>