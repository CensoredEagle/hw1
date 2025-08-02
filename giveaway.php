<?php
session_start();
$userLoggedIn = isset($_SESSION['username']);
$userName = $userLoggedIn ? $_SESSION['username'] : null;
$query = isset($_GET['query']) ? $_GET['query'] : '';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="mhw3.css" rel="stylesheet" type="text/css"/>
    <title>Risultati Giveaway</title>
</head>
<body>
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

    <div id="risultati-ricerca"></div>
    <script>
    async function cercaGiveaway(query) {
      const risultatiDiv = document.getElementById('risultati-ricerca');
      risultatiDiv.innerHTML = 'Caricamento...';
      try {
        const response = await fetch('proxy_gamerpower.php');
        const data = await response.json();
        const risultati = data.filter(g => g.title.toLowerCase().includes(query.toLowerCase()));
        if (risultati.length === 0) {
          risultatiDiv.innerHTML = 'Nessun giveaway trovato.';
          return;
        }
        risultatiDiv.innerHTML = risultati.map(g => `
          <div class="giveaway">
            <a href="${g.open_giveaway_url}" target="_blank">
              <img src="${g.thumbnail}" alt="${g.title}" style="width:100px;">
              <strong>${g.title}</strong>
            </a>
            <p>${g.description}</p>
          </div>
        `).join('');
      } catch (e) {
        risultatiDiv.innerHTML = 'Errore durante la ricerca.';
        console.error('Errore fetch:', e);
      }
    }

    function getQuery() {
      const params = new URLSearchParams(window.location.search);
      return params.get('query') || '';
    }

    document.addEventListener('DOMContentLoaded', function() {
      const query = getQuery();
      if (query) cercaGiveaway(query);
      document.getElementById('cerca').addEventListener('click', function() {
        const nuovaQuery = document.getElementById('ricerca').value.trim();
        if (nuovaQuery.length > 0) {
          window.location.href = 'giveaway.php?query=' + encodeURIComponent(nuovaQuery);
        }
      });
    });
    </script>
</body>
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
</html>