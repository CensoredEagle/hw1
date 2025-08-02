<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
if (!isset($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = array();
}
$connect = mysqli_connect("localhost", "root", "", "hw1");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"],
			);
			array_push($_SESSION['shopping_cart'], $item_array);
		}
		else
		{
			echo '<script>alert("Oggetto già aggiunto")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"],
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Oggetto rimosso")</script>';
				echo '<script>window.location="carrello.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Carrello</title>
		<link rel="stylesheet" href="carrello.css">
	</head>
	<body class="text-center">
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<div class="position-relative overflow-hidden text-center bg-dark shadow">
				<h1 class="text-white display-4 font-weight-normal" style="align=center;">Carrello</h1>
			</div>
			<br><br><br>
			<div style="clear:both"></div>
			<br />
			<h3>Dettagli Ordine</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="30%">Nome Oggetto</th>
						<th width="10%">Quantità</th>
						<th width="20%">Prezzo</th>
						<th width="15%">Totale</th>
						<th width="5%">Azione</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="carrello.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Rimuovi</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" style="align=right;">Totale</td>
						<td style="align=right;">$ <?php echo number_format($total, 2); ?></td>
						<td><a href="pagamento.php"><span class="text-success">Procedi all'Acquisto</span></a></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br>
	<br><a href="index.php"><h2>Torna indietro</h2></a>
	</body>
</html>