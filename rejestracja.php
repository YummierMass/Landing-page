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

  <title> maseczki profilowane jednokolorowe</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/heroic-features.css" rel="stylesheet">
  <link href="css/register_form.css" rel="stylesheet">

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
            <li class="nav-item">
              <a class="nav-link" href="logowanie.php">Zaloguj się!</a>
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
            <h3 class="display-3 color:btn-lg">Rejestracja</h3>
            <hr />
            <form method="post">
            <div class="form-group">
                <label for="email">Podaj adres e-mail:</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="podpowiedzEmail" placeholder="Wpisz Email">
                <small id="podpowiedzEmail" class="form-text text-muted">W powyższym polu wpisujesz swój adres email.</small>
              </div>
              <div class="form-group">
                <label for="firstname">Podaj imie</label>
                <input type="text" name="imie"  class="form-control" id="firstname"  placeholder="Wpisz imie">
                <small id="podpowiedzEmail" class="form-text text-muted">W powyższym polu wpisujesz swoje imie.</small>
              </div>
              <div class="form-group">
                <label for="surname">Podaj nazwisko</label>
                <input type="text" name="nazwisko" class="form-control" id="surname"  placeholder="Wpisz nazwisko">
                <small id="podpowiedzEmail" class="form-text text-muted">W powyższym polu wpisujesz swoje nazwisko.</small>
              </div> 
              <div class="form-group">
                <label for="przykladoweHaslo">Hasło</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Wpisz hasło">
              </div>
                <!-- TODO: Pozmeiniać pola i zmienić nazwy pól w klasie -> dodać email, imie i nazwisko oraz username, password-->
                <input type="submit" class="btn btn-primary" value="Zarejestruj się!" name="Submit1">
                <hr />
                <?php
                  if(isset($_POST["Submit1"]))
                  {
                    try
                    {
                      $newId = $account->addAccount(
                        $_POST["username"], 
                        $_POST["firstname"],
                        $_POST["surname"],
                        $_POST["email"],
                        $_POST["password"]
                      );
                    }
                    catch (Exception $e)
                    {
                      echo $e->getMessage();
                      die();
                    }
                    echo 'The new account ID is ' . $newId;
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
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
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
