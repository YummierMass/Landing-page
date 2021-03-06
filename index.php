<?php
session_start();
require './db_inc.php';
require './account_class.php';
$account = new Account();

try
{
  $login = $account->sessionLogin();
}
catch (Exception $e)
{
  die();
}

if(!$account->isAuthenticated())
{
  header("Location: logowanie.php");
}
else
{
  echo "Witaj: ".$account->getEmail();
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Landing page for laboratories">
  <meta name="author" content="Daria Bednarz">

  <title>Strona główna</title>

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
            <a class="nav-link" href="logowanie.php">zaloguj</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
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

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <div class="row text-center">    
        <div style="position: relative; text-align: center;">
          <h1 class="display-3 color:btn-lg">Witamy na naszej stronie!</h1>
        </div>
        <div style="position: relative; margin-top: 0cm;">
          <img class="card-img-top" src="https://cdn.pixabay.com/photo/2020/10/18/01/07/family-5663603_1280.png" class="img-fluid" alt="Cinque Terre">
        </div>
      </div>
    </header>

    <!-- Page Features -->
    <div class="row text-center">

      <div class="container-fluid">
        <div class="jumbotron">
          <h2 class="display-3 text-center">Nasze motto?</h2>
          <h4 class="text-center">Dbaj o siebie i innych :)</h4>
          <div class="display-3 text-center">
            <a  href="index.html#anchor-name" class="btn btn-success btn-lg text-center">Sprawdz co oferujemy!</a>
          </div>
        </div>
      </div>
      
      <div class="container-fluid">
        <div class="jumbotron">
          <div class="display-3 text-center" id="anchor-name">Co oferujemy?
            <h4 class="text-center">Nasz sklep zaopatrzony jest w wszelkiego rodzaju maski ochronne oraz płyny dezynfekcyjne <br>Mamy nadzieję, ze nasze produkty pozwolą ci pracować bezpieczniej</h4>
          </div>
        </div>  
      </div>
  
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top " src="https://blackparrot.pl/userdata/public/gfx/2674/maseczki-ochronne-bawelniane-z-flizelina-trzy-kolory-bialy%2C-czerwony-i-czarny.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">maski profilowane jednokolorowe</h4>
            <p class="card-text">Maska BAWEŁNIANA Ochronna Dwuwarstwowa Wielorazowa STREETWEAR Maseczka na Twarz bardzo przyjemna w dotyku , nie podrażnia skóry
                                  Maseczka z bardzo wygodnymi w codziennym użytku gumkami na uszy !</p>
          </div>
          <div class="card-footer">
            <a href="page1.html" class="btn btn-primary" >Czytaj więcej!</a>
          </div>
        </div>
      </div>
  
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="https://almamed.pl/userdata/gfx/90474f268ff151d2b63345c95d4ded5a.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">maski dziecięce</h4>
            <p class="card-text">Maseczki bawełniane w rozmiarach dziecięcych, rózne wzory i kolory. Z najwyższej jakości TKANINA użyta do uszycia maseczki spełnia wszelkie standardy bezpieczeństwa oraz normy OECO-TEX, dzięki czemu możesz być pewny, że maseczka jest całkowicie bezpieczna dla skóry, hipoalergiczna i certyfikowana na obecność substancji szkodliwych.

              Produkt wyprodukowany w POLSCE</p>
          </div>
          <div class="card-footer">
            <a href="page2.html" class="btn btn-primary">Czytaj więcej!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="https://sklep-testcovid19.pl/wp-content/uploads/2020/08/maski-ochronne-na-twarz-1.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">maski jednorazowe</h4>
            <p class="card-text">Maski jednorazowe polipropelynowe 50 szt. Maska jest wygodna, pasuje zarówno dla dorosłych i dzieci, ponieważ została wyposażona w specjalny drucik modelujący na nos, który zapewnia swobodę ruchu twarzy w czasie mówienia. Produkt hipoalergiczny mocowany gumkami co umożliwia idealne dopasowanie niezależnie od wielkości głowy..</p>
          </div>
          <div class="card-footer">
            <a href="page3.html" class="btn btn-primary">Czytaj więcej!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="https://patulove.com/userdata/public/assets//DSC07392.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">maski profilowane-kolorowe</h4>
            <p class="card-text">Wyprodukowana ręcznie Maseczka dwuwarstwowa: spodnia warstwa, przylegająca do twarzy - 100% bawełna, wierzchnia warstwa z nadrukiem - tkanina mikrofibra (100% poliester)</p>
          </div>
          <div class="card-footer">
            <a href="page4.html" class="btn btn-primary">Czytaj więcej!</a>
          </div>
        </div>
      </div>

      <!-- Map -->
      <div class="container my-4">
        <div class="jumbotron" >
            <section id="contact" class="map">
              <iframe class="text-center" width="100%" height="80%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
              <br />
              <small>
                <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a>
              </small>
            </section>
        </div>
      </div>

    </div>
    <!-- /.row -->

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
