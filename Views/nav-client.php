<?php
  use Controllers\HomeController as HomeController;

  if(empty($_SESSION['email'])){
    $home = new HomeController();
    $home->ShowLoginView("You are not allowed to see this page");
  }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">User</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ShowMovies">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Logout <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </div>
</nav>