<?php
session_start();

$userLoggedIn = isset($_SESSION['username']);
$userName = $userLoggedIn ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="mhw3.css" rel="stylesheet" type="text/css"/>
    <title>Homepage G2A</title>
</head>
<body>
<script type="text/javascript" src="mhw3.js" defer></script>
<script src="giochi_async.js"></script>
<article style=" background:
    linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('sfvenduti.jpg'); backgroung-size:cover; background-position:center;">
    <div id="promo" class="head">
        <p>Spendi di più, risparmia di più! Fino al 20% con il codice G2ASPRING</p>
    </div>

   <div id="presentazione" class="head">
        <div id="contenitore">
         <a href="index.php">
        <img src="logo.jpeg" alt="logo"></a>
        <input id="ricerca" type="search" placeholder="Che stai cercando?">
        <button id="cerca" type="button" aria-label="Cerca">Cerca</button>
        <input type="button" id="Profilo" value="">
   <div id="Accesso">
           <?php if ($userLoggedIn): ?>
                <p style="color: white;">Benvenuto, <?php echo htmlspecialchars($userName); ?>!</p>
                <form method="post" action="logout.php" style="display:inline;">
                    <button type="submit">Logout</button>
                </form>
                
                
            <?php else: ?>
                <a href="signup.php">Iscriviti</a>
                <a href="login.php">/ Accedi</a>
            <?php endif; ?>
        </div>
        <a href="carrello.php" id="Carrello"></a>
            </div>
        <nav>
            <ul>
                <li id="categoria"><a href="costruzione.php"><img src="menu.png" alt="menu">CATEGORIE</a>
                <ul id="tendina">
                    <li><a href="costruzione.php">Giochi per cellulari</a></li>
                    <li><a href="costruzione.php">Software</a></li>
                    <li><a href="costruzione.php">Abbonamenti</a></li>
                    <li><a href="costruzione.php">Carte regalo</a></li> 
                </ul> 
                </li>
                <li><a href="venduti.php">I più venduti</a></li>
                <li><a href="nuovi.php">Preordini</a></li>
                <li><a href="costruzione.php">Chiavi random</a></li>
                <li><a href="costruzione.php">Software</a></li>
                <li id="plus"><a href="costruzione.php">Il miglior prezzo con g2a plus</a></li>
            </ul>
        </nav>
    </div>

            
            <div id="data"></div>
            <script>
            async function auth() {
                const clientId = 'Ov23li2Qac0rbbvD9Aak';
                const redirectUri = 'http://localhost:3000/oauth/callback'; 
                window.location.href = `https://providerOAuth2.com/authorize?client_id=${clientId}&redirect_uri=${redirectUri}&response_type=code`;
            }
            
            async function fetchData(code) {
                try {
                    const response = await fetch(`http://localhost:3000/oauth/callback?code=${code}`);
                    const data = await response.json();
            
                    document.getElementById('data').innerText = JSON.stringify(data);
                } catch (error) {
                    console.error('Errore durante il recupero dei dati:', error.message);
                }
            }
            </script>
            <div class="alternative" style=" background-image: url('sfvenduti2.jpg');">
  <div class="prom1">
                 <div class="prom2">
                <h1 class="titolo" style="color:white !important;">I giochi più venduti</h1>
                <h2 class="sottotitolo" style="color:#e4e4e4 !important;">I titoli più amati di sempre: scoprili tutti!</h2>
        </div></div></div>
        
        <div class="prom">
           <?php
include "db.php";
$comando= "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno <= " . date('Y') . " ORDER BY RAND()";
$risultato = $conn->query($comando);
$am = [];
while($rc = mysqli_fetch_array($risultato)) {
    $am[] = $rc;
}
echo '<div class="container" id="venduti-list">';
if (count($am) >= 1) {
    for($n = 0; $n <count($am); $n++) {
        echo '<div class="game-card">
    <input type="submit" value="" class="box" style="background-image: url(\''.$am[$n]["immagine"].'\');" /> 
    <p>'.htmlspecialchars($am[$n]["titolo"]).'</p>
    <p class="descr">'.htmlspecialchars($am[$n]["descrizione"]).'</p>
    <div class="add">
    <p class="prezzo">'.htmlspecialchars($am[$n]["prezzo"]).'€</p> 
    <form class="add-to-cart-form" data-id="'.htmlspecialchars($am[$n]["id"]).'" data-name="'.htmlspecialchars($am[$n]["titolo"]).'" data-price="'.htmlspecialchars($am[$n]["prezzo"]).'">
        <input type="hidden" name="quantity" value="1"/>
        <button type="submit" class="addimg" title="Aggiungi al carrello"></button>
    </form>
    </div>
</div>';
    }
} else {
    echo '<p>Nessun gioco trovato.</p>';
}
echo '</div>';
?>

</div>

        </article>
        
        <button class="codice" onclick="showDiv()">Mostra il tuo codice sconto personale</button>

<div id="Sconto" class="nascosto">
  <p>Ecco il tuo codice sconto personale: G2ASCONTOPASQUA</p>
</div>

<button class="codice" onclick="hideDiv()">Nascondi il tuo codice sconto personale</button>
        <footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <h3>Chi siamo</h3>
      <p>La tua piattaforma per il digital gaming, senza limiti.</p>
    </div>
    <div class="footer-section">
      <h3>Link utili</h3>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="costruzione.php">Contatti</a></li>
        <li><a href="costruzione.php">Privacy</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Seguici</h3>
      <ul class="social">
        <li><a href="costruzione.php">Facebook</a></li>
        <li><a href="costruzione.php">Instagram</a></li>
        <li><a href="costruzione.php">LinkedIn</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 G2A. Tutti i diritti riservati.</p>
  </div>
</footer>

        </body>
</html>