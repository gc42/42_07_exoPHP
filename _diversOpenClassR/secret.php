<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php
		echo "<pre></br>"; print_r($_POST); echo "</pre>";
		// Vérification du mot de passe et protection contre les codes malveillants
		// if (isset($_POST['password']) AND htmlspecialchars($_POST['password']) == "kangourou")
		if (isset($_POST['password']) AND htmlspecialchars($_POST['password']) === "88888888")
		{
		// Si tout est OK, affichage des codes secrets
		?>

			<h1>Codes secrets pour détruire la civilisation</h1>
			<p>Les codes secrets de destruction de notre civilisation sont les suivants :<br /></p>

			<p>
				<ul>
					<li>Rouler à l'essence;</li>
					<li>Chauffer au charbon;</li>
					<li>Manger de l'industriel</li>
					<li>Entasser nos déchets</li>
					<li>Raser nos forets primaires</li>
					<li>Elir des Trump</li>
					<li>Produire à l'excès</li>
					<li>Et tout un tas d'autres actions que nous menons sans même y réfléchir</li>
					<li>...</li>

				</ul>
			</p>

			<p><strong>ATTENTION</strong> A MANIPULER AVEC DISCRETION<br />
			NE PAS METRE ENTRE TOUTES LES MAINS ;-)</p>

		<?php
		}
		else
		{ ?>
			<p>Vous n'avez pas le bon mot de passe !<br />
			C'est une chance pour la planète ;-)</p>

		<?php
		}
		?>

	</body>
</html>
