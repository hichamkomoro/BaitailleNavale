<!DOCTYPE html>
<html>
<head>
	<title>Welcome - Bataille Navale</title>
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="icon" href="./Assets/logo.ico">
</head>
<body>

	<a href="http://localhost/jeu/index.php" class="navBar">
			<img class="logo" alt="..." src="./Assets/logo.ico"/>
			<p class="title">Bataille Navale</p>
	</a>
	<!-- action="./Scripts/newPartie.php" --->
	<div class="create_part">
		<?php
			if(isset($_POST["ETAPe1"])){
				?>	
					<div class="Exbateaux">
						<img id="XB2" src="./Assets/2.png" alt="2">
						<img id="XB3" src="./Assets/3.png" alt="3">
						<img id="XB4" src="./Assets/4.png" alt="4">
						<img id="XB5" src="./Assets/5.png" alt="5">
					</div>
					<form class="formPlacement" action="./Scripts/newPartie.php"  method="post">
						<p class="title">L'emplacement des bateaux</p>
						<input type="text" hidden required autocomplete="false" value="<?php echo $_POST["J1"]?>" name="J1">
						<input type="text" hidden required autocomplete="false" value="<?php echo $_POST["J2"]?>" name="J2">
						<input type="text" hidden required name="B2" id="IB2" value="">
						<input type="text" hidden required name="B3" id="IB3" value="">
						<input type="text" hidden required name="B4" id="IB4" value="">
						<input type="text" hidden required name="B5" id="IB5" value="">
						<div class="bateaux">
							<img id="B2" src="./Assets/2.png" alt="2">
							<img id="B3" src="./Assets/3.png" alt="3">
							<img id="B4" src="./Assets/4.png" alt="4">
							<img id="B5" src="./Assets/5.png" alt="5">
						</div>
						<div class="Board">
							<table id="TablePlace">
								<?php
									for($i=0;$i<10;$i++){
										echo "<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>";
									}
								?>
							</table>
							<div class="controls">
								<p id="BtnStart" class="control-btn bi bi-play-fill"></p>
								<p id="BtnRestart" class="control-btn bi bi-arrow-counterclockwise"></p>
								<p id="BtnClose" class="control-btn bi bi-x-circle-fill"></p>
							</div>
						</div>
					</form>
				<?php
			}else if(isset($_GET['ETAPe2'])){
				?>
					<div class="Exbateaux">
						<img id="XB2" src="./Assets/2.png" alt="2">
						<img id="XB3" src="./Assets/3.png" alt="3">
						<img id="XB4" src="./Assets/4.png" alt="4">
						<img id="XB5" src="./Assets/5.png" alt="5">
					</div>
					<form class="formPlacement" action="./Scripts/newPartie.php"  method="post">
						<p class="title">L'emplacement des bateaux</p>
						<input type="text" hidden required name="etape2Id"  value="<?php echo $_GET['ETAPe2'];?>">
						<input type="text" hidden required name="B2" id="IB2" value="">
						<input type="text" hidden required name="B3" id="IB3" value="">
						<input type="text" hidden required name="B4" id="IB4" value="">
						<input type="text" hidden required name="B5" id="IB5" value="">
						<div class="bateaux">
							<img id="B2" src="./Assets/2.png" alt="2">
							<img id="B3" src="./Assets/3.png" alt="3">
							<img id="B4" src="./Assets/4.png" alt="4">
							<img id="B5" src="./Assets/5.png" alt="5">
						</div>
						<div class="Board">
							<table id="TablePlace">
								<?php
									for($i=0;$i<10;$i++){
										echo "<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>";
									}
								?>
							</table>
							<div class="controls">
								<p id="BtnStart" class="control-btn bi bi-play-fill"></p>
								<p id="BtnRestart" class="control-btn bi bi-arrow-counterclockwise"></p>
								<p id="BtnClose" class="control-btn bi bi-x-circle-fill"></p>
							</div>
						</div>
					</form>
				<?php
			}else if(isset($_GET["id"])){
				?>
					<form class="partageLien">
						<br>
						<p class="title">Inviter votre ami</p>
						<div class="J1">
							<label>Lien à partager :</label>
							<input type="text" class="Ilien" required autocomplete="false" value="https://baitaille-navale.herokuapp.com/loading.php?p=<?php echo md5('Je2');?>&id=<?php echo $_GET['id']; ?>" name="J1">
						</div>
						<br>
						<a href="./loading.php?p=<?php echo md5('Je1');?>&id=<?php echo $_GET['id']; ?>" class="start">Start</a>
					</form>
				<?php
			}else{
				?>
					<form method="post">
						<p class="title">Nouvelle Partie</p>
						<div class="J1">
							<label>Joueur N°1 :</label>
							<input type="text" required autocomplete="false" value="Joueur1" name="J1">
						</div>
						<div class="J2">
							<label>Joueur N°2 :</label>
							<input type="text" required autocomplete="false"  value="Joueur2" name="J2">
						</div>
						<input class="start" type="submit" name="ETAPe1" value="Next">
					</form>
				<?php
			}
		?>
	</div>
<script src="./js/main.js"></script>
</body>
</html>
