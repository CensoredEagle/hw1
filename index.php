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
<article>
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
        <span id="cart-count">0</span>

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
            
            <div id="novita">
                <img id="copertina1" src="g2a1.png" alt="Copertina 1">
                <img id="copertina2" src="g2a2.jpg" alt="Copertina 2" onclick= "cambio()">
                <img id="copertina3" src="g2a3.png" alt="Copertina 3">
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
            
            <div id="Gratis">
            <img src="iconagame.png" alt="epic" id="ggratis">
            <div id="testo">
            <p id="ttl">Giochi gratis su EpicGames!</p>
            <p id="des">EpicGames possiede una vasta selezione di giochi gratuiti disponibili per tutti gli utenti</p>
        </div>
            <button onclick="Frees()" id="button1">Scopri di più</button>
            </div>

            <div class="prom"><div class="prom1">
                 <div class="prom2">
                <h1 class="titolo">Novità</h1>
                <h2 class="sottotitolo">Scopri le ultime novità del nostro marketplace: titoli appena arrivati, trend emergenti e sorprese tutte da esplorare!</h2>
        </div><div class="prom3">
                <button class="info" onclick="window.location.href='nuovi.php'">Guarda tutti</button> </div> </div>
           <?php
include "db.php";
$comando = "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno = " . date('Y') . " ORDER BY id DESC";
$risultato = $conn->query($comando);
$am = [];
while($rc = mysqli_fetch_array($risultato)) {
    $am[] = $rc;
}
echo '<div class="container" id="novita-container">';
if (count($am) >= 4) {
    for($n = 0; $n < 4; $n++) {
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
</div>'
   ;
    }
} else {
    echo '<p>Nessun gioco trovato.</p>';
}
echo '</div>';
?>

 <div class="prom1">
                 <div class="prom2">
                <h1 class="titolo">I più venduti</h1>
                <h2 class="sottotitolo">Gli articoli più popolari del nostro marketplace - scopri cosa ha conquistato il cuore dei nostri utenti!</h2>
        </div><div class="prom3">
                <button class="info" onclick="window.location.href='venduti.php'">Guarda tutti</button> </div> </div>
           <?php
$comando= "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno <= " . date('Y') . " ORDER BY RAND() LIMIT 4"; //SISTEMARE CON DATI CORRETTI
$risultato = $conn->query($comando);
$am = [];
while($rc = mysqli_fetch_array($risultato)) {
    $am[] = $rc;
}
echo '<div class="container" id="venduti-container">';
for($n = 0; $n < 4; $n++) {
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
echo '</div>';
?>

</div>

<div id="sez3">
<div class="prom" id="special">
    <div id="spprom">
                <h1 id="titolo2">Prossime uscite</h1></div>
           <?php
$comando = "SELECT DISTINCT id, immagine, titolo, descrizione, prezzo FROM gioco WHERE anno >" . date('Y') . " LIMIT 6";//SISTEMARE CON DATI CORRETTI
$risultato = $conn->query($comando);
$am = [];
while($rc = mysqli_fetch_array($risultato)) {
    $am[] = $rc;
}
echo '<div class="container">';
for($n = 0; $n < 6; $n++) {
    echo '<div class="game-card2">
        <img src="'.htmlspecialchars($am[$n]["immagine"]).'" alt="'.htmlspecialchars($am[$n]["titolo"]).'" class="box2" />
        <div class="incolonna">
            <div class="gm">
                <p>'.htmlspecialchars($am[$n]["titolo"]).'</p>
                <p class="descr2">'.htmlspecialchars($am[$n]["descrizione"]).'</p>
            </div>
                <form class="add-to-cart-form add2form" data-id="'.htmlspecialchars($am[$n]["id"]).'" data-name="'.htmlspecialchars($am[$n]["titolo"]).'" data-price="'.htmlspecialchars($am[$n]["prezzo"]).'" style="display:inline;">
                    <input type="hidden" name="quantity" value="1"/>
                    <div class="add2">
                        <p class="prezzo2">'.htmlspecialchars($am[$n]["prezzo"]).'€</p>
                        <button type="submit" class="addimg2" title="Aggiungi al carrello"></button>
                    </div>
                </form>
        </div>
    </div>';
}
echo '</div>';
?>

</div>
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