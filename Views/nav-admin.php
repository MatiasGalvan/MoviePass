<?php
  use Controllers\HomeController as HomeController;

  if(empty($_SESSION['email']) || $_SESSION['role'] != 'admin'){
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

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cinemas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddCinemaView">Add Cinema</a>
          <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Cinema/ShowCinemas">Cinema List</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Functions
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Function/ShowAddFunctionsView">Add Functions</a>
          <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Function/ShowFunctions">Functions List</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Update
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Movie/ShowUpdateMovies">Update Movies</a>
          <a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Movie/ShowUpdateGenres">Update Genres</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Logout</a>
      </li>
      
    </ul>
  </div>
</nav>