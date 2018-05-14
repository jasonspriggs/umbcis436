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
            <li class="nav-item active">
              <a class="nav-link" href="/account">View Account</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <?php if(isset($_POST['number']) && isset($_POST['pin'])) { ?>
    <main role="main" class="container">
      <h1 class="mt-5">Account ID: <?php echo $_POST['number']; ?></h1>
      <p>Checked out Items:</p>
      <ul>
        <?php $items = get_checked_out_items($_POST['number']); ?>
        <?php foreach($items as $item) { ?>
        <li><?php echo get_media_name($item['media_id']); ?></li>
        <?php } ?>
      </ul>
    </main>
    <?php } else { ?>
    <main role="main" class="container">
      <h1 class="mt-5">Login to Account</h1>
      <form action="/account" method="POST">
        <input name="number" type="text" placeholder="Account Number">
        <input name="pin" type="password" placeholder="PIN">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
      </form>
    </main>
    <?php } ?>

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
