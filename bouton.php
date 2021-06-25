<!DOCTYPE HTML>
<html lang="fr">

<head>
	<link href="style/style.css" rel="stylesheet" media="all">
	<title>RASP-GPIO</title>
</head>

<body>
	<h1>
		RASP-GPIO
	</h1>
	<h2>
		Bouton
	</h2>
    <div id="menu">

    <div class="boutonMenu">
    <a href="index.php"> index.php </a>
    </div>
    <div class="boutonMenu">
    <a href="confBouton.php"> confBouton.php </a>
    </div>

    </div>
	<div id="conteneurBouton">
		<?php
		$NbGpio = 0;
		if (($handle = fopen("fichiers/ListGpio.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				$NbGpio++;
				for ($c = 0; $c < $num; $c++) {
					$TableauGpio[$NbGpio][$c] = $data[$c];
				}
			}
			fclose($handle);
		}
		for ($i = 2; $i <= $NbGpio; $i++) {
			$GpioPin = $TableauGpio[$i][3];
			$TableauGpio[$i][5] = shell_exec("gpio -1 read $GpioPin");
			if ($TableauGpio[$i][5] == 0) :
		?>
				<div class="boutonGpioOff">
					<p>
					<form method="post" action="scripts/ControlePin.php">
						<input type="hidden" name="Pin" value="<?php echo $TableauGpio[$i][3] ?>" />
						<input type="hidden" name="Etat" value="1" />
						<button type="submit"><?php echo $TableauGpio[$i][1] ?></button>
					</form>
					</p>
				</div>
			<?php else : ?>
				<div class="boutonGpioOn">
					<p>
					<form method="post" action="scripts/ControlePin.php">
						<input type="hidden" name="Pin" value="<?php echo $TableauGpio[$i][3] ?>" />
						<input type="hidden" name="Etat" value="0" />
						<button type="submit"> <?php echo $TableauGpio[$i][1] ?></button>
					</form>
					</p>
				</div>
		<?php endif;
		} ?>
	</div>
</body>

</html>