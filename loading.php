<?php
	if(!isset($_GET["id"])){
		header("Location: ./index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Loading - Bataille Navale</title>
	<link rel="stylesheet" type="text/css" href="./styles/waiting.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="icon" href="./Assets/logo.ico">
	<script src="./js/main.js"></script>
</head>
<body>

	<?php include("./Scripts/NavBar.php") ?>
	<!-- action="./Scripts/newPartie.php" --->
	<div class="create_part">
		<div class="formPlacement">
			<p class="title">En terrain de combat</p>
			<div class="Board">
<?php
	include("./Scripts/connexion.php");

	$rslt = $conn->query("select user1_name,user2_name,user1_B2,user1_B3,user1_B4,user1_B5,user2_B2,user2_B3,user2_B4,user2_B5 from matches where MD5(CONCAT('M',id))='".$_GET["id"]."'");
	$row = $rslt->fetch_assoc();
	if($row['user2_B2']==null){
		if($_GET['p']==md5('Je2')){
			header("Location: ./index.php?ETAPe2=".$_GET["id"]);
			exit();
		}else{
			?>
				<img class="laoding" src="./Assets/loading.gif" alt="loading">
				<button class="LoadingAnnule"><a href="./Scripts/newPartie.php?annuleMatch=<?php echo $_GET['id']; ?>">Annuler le match</a></button>
				<script>
					var xhttp = new XMLHttpRequest();
					setInterval(() => {
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								if(this.responseText=="true"){
									location.reload();
								}
							}
						};
						xhttp.open("GET", "./Scripts/newPartie.php?CheckPartieid=<?php echo $_GET["id"]; ?>", false);
						xhttp.send();
					}, 1000);
				</script>
			<?php
		}
	}else{
?>
				<div class="J1">
					<div class="infos">
						<p class="Username">Joueur N°1 : <?php echo $row['user1_name']; ?></p>
						<p class="score">Score : <i id="scroreUser1">0</i> Points </p>
					</div>
					<table id="TablePlace1" <?php 
					if($_GET['p']==md5('Je2')){
						echo 'class="TdHovered"';
					}
				?>>
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
				</div>
				<div class="J2">
					<div class="infos">
						<p class="Username">Joueur N°2 : <?php echo $row['user2_name']; ?></p>
						<p class="score">Score : <i id="scroreUser2">0</i> Points </p>
					</div>
					<table id="TablePlace2" <?php 
					if($_GET['p']==md5('Je1')){
						echo 'class="TdHovered"';
					}
				?>>
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
				</div>
			</div>
			<div class="btnControls">
				<button ><a href="./Scripts/newPartie.php?annuleMatch=<?php echo $_GET['id']; ?>">Annuler le match</a></button>
				<button><a href="./index.php">Rejouer</a></button>
			</div>
			<script>
				setTimeout(() => {
					positionerLesBateux(<?php 
					if($_GET['p']==md5('Je2')){
						echo "2,[".$row['user2_B2'].",".$row['user2_B3'].",".$row['user2_B4'].",".$row['user2_B5']."]";
					}else{
						echo "1,[".$row['user1_B2'].",".$row['user1_B3'].",".$row['user1_B4'].",".$row['user1_B5']."]";
					}
				?>);
				}, 100);
				Cibles(<?php 
					if($_GET['p']==md5('Je2')){
						echo "2,0,[".$row['user2_B2'].",".$row['user2_B3'].",".$row['user2_B4'].",".$row['user2_B5']."],[".$row['user1_B2'].",".$row['user1_B3'].",".$row['user1_B4'].",".$row['user1_B5']."],'".$_GET['id']."'";
					}else{
						echo "1,80,[".$row['user1_B2'].",".$row['user1_B3'].",".$row['user1_B4'].",".$row['user1_B5']."],[".$row['user2_B2'].",".$row['user2_B3'].",".$row['user2_B4'].",".$row['user2_B5']."],'".$_GET['id']."'";
					}
				?>);
			</script>
			<div class=MYBAT>
					<img id="MYB2" src="./Assets/2.png" alt="2">
					<img id="MYB3" src="./Assets/3.png" alt="3">
					<img id="MYB4" src="./Assets/4.png" alt="4">
					<img id="MYB5" src="./Assets/5.png" alt="5">
			</div>
			<div id="WaitingForm" class="Waiting">
					<img id="WaitingFormImg" src="./Assets/loading.gif" alt="">
			</div>
			<audio controls id="AudioId">
				<source src="./Assets/music.mp3" type="audio/mp3">
			</audio>
			<script>
				document.getElementById("AudioId").play();
			</script>
<?php
	}
?>
		</div>
	</div>
</body>
</html>