<?php
session_start();
require './db_inc.php';
require './account_class.php';
$account = new Account();
?>
<!DOCTYPE html>
<html lang="pl">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Landing page for laboratories">
  <meta name="author" content="Daria Bednarz">

  <title>Rejestracja</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/heroic-features.css" rel="stylesheet">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-NLVE6FYQHL"></script>

  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-NLVE6FYQHL');
  </script>

</head>

<body>

  <!-- pasek nawigacyjny -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Maseczki i nie tylko!</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="logowanie.php">Zaloguj się!</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home</a>
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

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3 color:btn-lg">Rejestracja</h1>
      <hr />
      <form method="post">
        <div class="form-group">
          <label for="email">Podaj adres e-mail:</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="wpisz e-mail">
          <small id="podpowiedzEmail" class="form-text text-muted">W powyższym polu wpisz e-mail.</small>
        </div>
        <div class="form-group">
          <label for="firstname">Podaj imię:</label>
          <input type="text" name="firstname"  class="form-control" id="firstname"  placeholder="wpisz imie">
          <small id="podpowiedzImie" class="form-text text-muted">W powyższym polu wpisujesz swoje imie.</small>
        </div>
        <div class="form-group">
        <label for="surname">Podaj nazwisko:</label>
        <input type="text" name="surname" class="form-control" id="surname"  placeholder="wpisz nazwisko">
        <small id="podpowiedzNazwisko" class="form-text text-muted">W powyższym polu wpisujesz swoje nazwisko.</small>
        </div> 
        <div class="form-group">
        <label for="password">Podaj hasło:</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="wpisz hasło">
        </div>
        <!-- TODO: Pozmeiniać pola i zmienić nazwy pól w klasie -> dodać email, imie i nazwisko oraz username, password-->
        <input type="submit" class="btn btn-primary" value="Zarejestruj się!" name="send">
        <hr />
        <?php
        if(isset($_POST["send"]))
        {
        try
        {
          $newId = $account->addAccount(
            $_POST["email"], 
            $_POST["firstname"],
            $_POST["surname"],
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
    </header>
  
    </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Daria Bednarz website 2020</p>
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
