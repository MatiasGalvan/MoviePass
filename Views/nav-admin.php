<?php
  use Controllers\HomeController as HomeController;

  if(empty($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    $home = new HomeController();
    $home->ShowLoginView("You are not allowed to see this page");
  }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Administrator</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddCinemaView">Add</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowCinemas">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ReloadMovies">ReloadMovies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/SaveGenres">ReloadGenres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>