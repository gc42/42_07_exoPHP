<?php
$timestamp_expire = strtotime('+1 day');	// Cookie expire in x days


// Init cookie `c_pseudo`
if (empty($_COOKIE['c_pseudo']))
{
	setcookie('c_pseudo',  'nobody', $timestamp_expire, null, null, false, true);
	$_COOKIE['c_pseudo'] = 'nobody';
}


//#################################
// Value of COOKIE c_pseudo
if ($_POST['pseudo'] !== '' AND $_COOKIE['c_pseudo'] === 'nobody')
{
	setcookie('c_pseudo',  htmlspecialchars($_POST['pseudo']), $timestamp_expire, null, null, false, true);
	$_COOKIE['c_pseudo'] = htmlspecialchars($_POST['pseudo']);
}



// ############################################################################
// TEST: Display global variables. => YOU MUST DESABLE header('Location...)')
// echo "<pre> POST: ";   print_r($_POST);   echo "</pre>";
// echo "<pre> COOKIE: "; print_r($_COOKIE); echo "</pre>";



// ################################################################
// DB: Insert new post in `minichat` table
if (    !empty($_POST['pseudo']) AND !empty($_POST['message']) AND
	     isset($_POST['pseudo']) AND isset($_POST['message'])    )
{
	// 0 : Remember POST parameters
 	$pseudo  = $_POST['pseudo'];
	$message = $_POST['message'];

	// 1 : Connexion DB
	require_once('minichat_db.php');

	// 2 : Request to INSERT the new data in the table
	$request = $bdd->prepare('INSERT INTO minichat (pseudo, message) VALUES(:new_pseudo, :new_message)');
	$request->execute(array(
		'new_pseudo'  => $pseudo,
		'new_message' => $message,
	));

	// ALTERNATIVE : an other kind of writing, using "bindValue"
	// $request->bindValue('pseudo', $_POST['pseudo']);
	// $request->bindValue('message', $_POST['message']);
	// $request->execute();

	$request->closeCursor();
}

// Redirection visitor to minichat page'
header('Location: index.php');

// USE ONLY IN test PHASE, IF HEADER('Location:...) must be desable.
// echo '<br />';
// echo '<a href="minichat.php">Retour</a>';