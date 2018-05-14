<?php 
if(isset($_POST['checklcn']) && isset($_POST['checkitem'])){
  require_once('functions.php');
  change_item_state($_POST['checkitem'], $_POST['checklcn']);
}

if(isset($_POST['signuplcn']) && isset($_POST['signuppin']) && isset($_POST['signupname']) && isset($_POST['signupaddress']) && isset($_POST['signupphone']) && isset($_POST['signupemail'])){
  require_once('functions.php');
  create_account($_POST['signuplcn'], $_POST['signuppin'], $_POST['signupname'], $_POST['signupaddress'], $_POST['signupphone'], $_POST['signupemail']);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sticky Footer Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Alexandria Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/admin">Admin Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout">Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <main role="main" class="container">
      <h1 class="mt-5">Admin Functions</h1>
      <div class="row">
        <div class="col-md">
          <h3>Checkin/out Media</h3>
          <form action="/admin" method="POST">
            <input name="checklcn" type="text" placeholder="Library Card Number">
            <input name="checkitem" type="text" placeholder="Item ID">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Check In/Out</button>
          </form>
        </div>
        <div class="col-md">
          <h3>Add User</h3>
          <form action="/admin" method="POST">
            <input name="signuplcn" type="text" placeholder="Library Card Number">
            <input name="signuppin" type="password" placeholder="PIN">
            <input name="signupname" type="text" placeholder="Name">
            <input name="signupaddress" type="text" placeholder="Address">
            <input name="signupphone" type="text" placeholder="Phone Number">
            <input name="signupemail" type="text" placeholder="Email">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Create Account</button>
          </form>
        </div>
      </div>
    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">UMBC IS436 | Spring 2018 - Team Alexandria | <a href="/login">Admin Login</a></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"><\/script>')</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.min.js"></script>
    <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
