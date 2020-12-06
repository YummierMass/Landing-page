<!DOCTYPE html>
<html lang="en">

<?php
require './db_inc.php';
require './account_class.php';
$account = new Account();
?>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logowanie</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/heroic-features.css" rel="stylesheet">
    <link href="css/login_form.css" rel="stylesheet">

  </head>

  <body>

    <!-- pasek nawigacyjny -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Maseczki i nie tylko !</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Zaloguj się!</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="onas.html">O nas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kontakt.html">Kontakt</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Features -->
      <header class="jumbotron" >
        <div class="container-fluid">
          <div class="div-center">
            <div class="content">
              <h3 class="display-3 color:btn-lg">Logowanie</h3>
              <hr />
              <form method="post">
                <div class="form-group">
                  <label>Nazwa uzytkownika</label>
                  <input type="text" class="form-control" placeholder="e-mail" name="mail">
                </div>
                <div class="form-group">
                  <label>Hasło</label>
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <input type="submit" class="btn btn-primary" value="Login" name="Submit1">
                <hr />
                <button type="button" class="btn btn-link" onclick="location.href = 'rejestracja.php';" >Zarejestruj się!</button>
                <button type="button" class="btn btn-link">Reset hasła</button>
                <hr />
                <?php
                if(isset($_POST["Submit1"]))
                {
                  $login = FALSE;

                  try
                  {
                    $login = $account->login($_POST["mail"], $_POST["password"]);
                  }
                  catch (Exception $e)
                  {
                    echo $e->getMessage();
                    die();
                  }
                  
                  if ($login)
                  {
                    echo 'Authentication successful.<br>';
                    echo 'Account ID: ' . $account->getId() . '<br>';
                    echo 'Account name: ' . $account->getEmail() . '<br>';
                    $account->sessionLogin();
                    die();
                  }

                  else
                  {
                    echo 'Authentication failed.';
                  }
                
                }
                ?>
              </form>
            </div>
          </div>
        </div>
      </header>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Daria Bednarz 2020</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/8861274.js"></script>
    <!-- End of HubSpot Embed Code -->

  </body>
</html>

            <!-- <form method="GET" action="logowanie.php">
              <div class="form-group">
                <label for="przykladowyEmail">Adres Email</label>
                <input type="email" class="form-control" name="name" aria-describedby="podpowiedzEmail" placeholder="Wpisz Email">
                <small id="podpowiedzEmail" class="form-text text-muted">W powyższym polu wpisujesz swój adres email.</small>
              </div>
              <div class="form-group">
                <label for="przykladoweHaslo">Hasło</label>
                <input type="password" class="form-control" id="przykladoweHaslo" placeholder="Wpisz hasło">
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="przykladowyCheckbox">
                <label class="form-check-label" for="przykladowyCheckbox">Zaznacz mnie!</label>
              </div>
              <input type="submit" class="btn btn-primary" name="login" value="Submit">
              <div class="display-3 text-center">
                <a  href="rejestracja.html" class="btn btn-success btn-lg text-left">zarejestruj się!</a>
              </div>
            </form>  -->