<?php
session_start();
if (!isset($_SESSION["shopping_cart"]) || empty($_SESSION["shopping_cart"])) {
    header("Location: carrello.php");
    exit;
}
$total = 0;
foreach($_SESSION["shopping_cart"] as $item) {
    $total += $item["item_quantity"] * $item["item_price"];
}
$pagato = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "db.php";
    $pagato = true;
    $nome_carta = isset($_POST["nome"]) ? $conn->real_escape_string($_POST["nome"]) : "";
    $user_id = isset($_SESSION["user_id"]) ? intval($_SESSION["user_id"]) : null;
    $data = date("Y-m-d H:i:s");
    $sql = "INSERT INTO ordini (user_id, nome_carta, data, totale) VALUES (" .
        ($user_id !== null ? "$user_id" : "NULL") . ", '" . $nome_carta . "', '" . $data . "', $total)";
    if ($conn->query($sql)) {
        $ordine_id = $conn->insert_id;
        if (isset($_SESSION["shopping_cart"])) {
            foreach ($_SESSION["shopping_cart"] as $item) {
                $gioco_nome = $conn->real_escape_string($item["item_name"]);
                $quantita = intval($item["item_quantity"]);
                $prezzo_unitario = floatval($item["item_price"]);
                $sql2 = "INSERT INTO ordini_prodotti (ordine_id, gioco_nome, quantita, prezzo_unitario) VALUES ($ordine_id, '$gioco_nome', $quantita, $prezzo_unitario)";
                $conn->query($sql2);
            }
        }
    }
    $_SESSION["shopping_cart"] = array();
    if (isset($conn)) $conn->close();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
    <link rel="stylesheet" href="pagamento.css">
</head>
<body>
<div class="pagamento-container">
    <h1>Pagamento</h1>
    <?php if ($pagato): ?>
        <div class="successo">
            <h2>Pagamento completato!</h2>
            <p>Grazie per il tuo acquisto.</p>
            <a href="index.php" class="btn">Torna alla Home</a>
        </div>
    <?php else: ?>
        <h2>Riepilogo Ordine</h2>
        <table>
            <tr>
                <th>Prodotto</th>
                <th>Quantità</th>
                <th>Prezzo</th>
                <th>Totale</th>
            </tr>
            <?php foreach($_SESSION["shopping_cart"] as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item["item_name"]); ?></td>
                <td><?php echo $item["item_quantity"]; ?></td>
                <td>€ <?php echo number_format($item["item_price"], 2); ?></td>
                <td>€ <?php echo number_format($item["item_quantity"] * $item["item_price"], 2); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="totale">
                <td colspan="3" style="align=right;"><b>Totale</b></td>
                <td><b>€ <?php echo number_format($total, 2); ?></b></td>
            </tr>
        </table>
        <h2>Dati di pagamento</h2>
        <form method="post" class="form-pagamento">
            <label>Nome sulla carta
                <input type="text" name="nome" required>
            </label>
            <label>Numero carta
                <input type="text" name="numero" maxlength="19" pattern="\d{16,19}" required placeholder="1234 5678 9012 3456">
            </label>
            <div class="flex-row">
                <label>Scadenza
                    <input type="text" name="scadenza" maxlength="5" pattern="\d{2}/\d{2}" required placeholder="MM/AA">
                </label>
                <label>CVV
                    <input type="text" name="cvv" maxlength="4" pattern="\d{3,4}" required placeholder="123">
                </label>
            </div>
            <button type="submit" class="btn">Paga ora</button>
        </form>
        <a href="carrello.php" class="btn-secondary">Torna al carrello</a>
    <?php endif; ?>
</div>
</body>
</html>