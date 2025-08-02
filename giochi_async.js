function escapeHtml(text) {
    return text.replace(/[&<>"']/g, function(m) {
        return ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        })[m];
    });
}

async function caricaGiochi(apiUrl, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    container.innerHTML = 'Caricamento...';
    const response = await fetch(apiUrl);
    const giochi = await response.json();
    if (!giochi.length) {
        container.innerHTML = '<p>Nessun gioco trovato.</p>';
        return;
    }
    let html = '';
    for (let gioco of giochi) {
        html += `
        <div class="game-card">
            <input type="submit" value="" class="box" style="background-image: url('${gioco.immagine}');" /> 
            <p>${escapeHtml(gioco.titolo)}</p>
            <p class="descr">${escapeHtml(gioco.descrizione)}</p>
            <div class="add">
                <p class="prezzo">${escapeHtml(gioco.prezzo)}€</p>
                <form class="add-to-cart-form" data-id="${escapeHtml(gioco.id)}" data-name="${escapeHtml(gioco.titolo)}" data-price="${escapeHtml(gioco.prezzo)}">
                    <input type="hidden" name="quantity" value="1"/>
                    <button type="submit" class="addimg" title="Aggiungi al carrello"></button>
                </form>
            </div>
        </div>`;
    }
    container.innerHTML = html;
    if (typeof setupCart === "function") setupCart();
}

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('novita-container')) {
        caricaGiochi('api_novita.php', 'novita-container');
    }
    if (document.getElementById('venduti-container')) {
        caricaGiochi('api_venduti.php?limit=4', 'venduti-container');
    }
    if (document.getElementById('venduti-list')) {
        caricaGiochi('api_venduti.php', 'venduti-list');
    }
    if (document.getElementById('nuovi-container')) {
        caricaGiochi('api_nuovi.php', 'nuovi-container');
    }
});