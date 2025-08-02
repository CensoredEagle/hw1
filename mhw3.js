function cambio() {
  const img = document.getElementById("copertina2");
  const currentSrc = img.getAttribute("src");

  if (currentSrc.includes("g2a2.jpg")) {
    img.setAttribute("src", "g2aF2.jpg");
  } else {
    img.setAttribute("src", "g2a2.jpg");
  }
}



function updateCartCount(count) {
    const el = document.getElementById('cart-count');
    if (el) el.textContent = count;
}


function setupCart() {
    fetch('add_to_cart.php', { method: 'POST' })
        .then(r => r.json())
        .then(data => updateCartCount(data.cart_count));

    if (!window.cartListenerAdded) {
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.classList && form.classList.contains('add-to-cart-form')) {
                e.preventDefault();
                const id = form.dataset.id;
                const name = form.dataset.name;
                const price = form.dataset.price;
                const quantity = form.querySelector('input[name="quantity"]').value;
                fetch('add_to_cart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${encodeURIComponent(id)}&name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}&quantity=${encodeURIComponent(quantity)}`
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        updateCartCount(data.cart_count);
                        alert('Articolo aggiunto al carrello!');
                    }
                });
            }
        });
        window.cartListenerAdded = true;
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupCart);
} else {
    setupCart();
}

  function aggiungiBordo(){ 
  document.querySelector(".esplora").classList.add("bordo")
}
const button_add = document.querySelector(".esplora");
if (button_add) {
  button_add.addEventListener("click", aggiungiBordo);
}
function showDiv() {
  var x = document.getElementById("Sconto");
  x.classList.remove("nascosto");
}

function hideDiv() {
  var x = document.getElementById("Sconto");
  x.classList.add("nascosto");
}


var condivisione = document.createElement('div');

document.body.appendChild(condivisione);

var Tasto = document.createElement('button');

Tasto.textContent = 'Condividi sui social la nostra pagina!';

Tasto.addEventListener('click', function() {
  alert('Grazie per aver condiviso!');
});

document.body.appendChild(Tasto);



const gameButtons = document.querySelectorAll(".compra");

gameButtons.forEach((button) => {
  const gameId = button.dataset.gameId;
  button.addEventListener("click", () => {
    alert(`Acquistato gioco ${gameId}`);
  });
});




window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const code = urlParams.get('code');
    if (code) {
        fetchData(code);
    }
};

async function Frees(){
const url = 'https://free-epic-games.p.rapidapi.com/free';
const options = {
  method: 'GET',
  headers: {
    'X-RapidAPI-Key': 'Secret',//rimossa API key per evitare la rimozione da parte di GitHub 
    'X-RapidAPI-Host': 'free-epic-games.p.rapidapi.com'
  }
};

try {
  const response = await fetch(url, options);
  const result = await response.text();
  console.log(result);
} catch (error) {
  console.error(error);
}
}


async function cercaGiveaway() {
  const query = document.getElementById('ricerca').value.trim();
  if (query.length === 0) return;
  window.location.href = 'giveaway.php?query=' + encodeURIComponent(query);
}

document.getElementById('cerca').addEventListener('click', cercaGiveaway);