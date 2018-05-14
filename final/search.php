<?php 
if(isset($_POST['search_title']) && isset($_POST['search_author']) && isset($_POST['search_barcode'])){
  require_once('functions.php');
  if(!empty($_POST['search_title'])) { 
    $results = search_media_by_title($_POST['search_title']);
  } else if(!empty($_POST['search_author'])) { 
    $results = search_media_by_author($_POST['search_author']);
  } else if(!empty($_POST['search_barcode'])) { 
    $results = search_media_by_barcode($_POST['search_barcode']);
  } else {
    $results = array();
  }
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
            <li class="nav-item">
              <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/account">View Account</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0" action="/search" method="GET">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">Library Search</h1>
      <form action="/search" method="POST">
      	<input name="search_title" type="text" placeholder="Title"><br>
      	<input name="search_author" type="text" placeholder="Author"><br>
      	<input name="search_barcode" type="text" placeholder="ISBN"><br>
      	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
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
