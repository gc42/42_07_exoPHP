<?php
// Pour charger la classe a la vollee
function chargerClasse($classe)
{
  require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.


$perso1 = new Personnage1(Personnage1::FORCE_MOYENNE, 0);   // Force 60/ Degats 0
$perso2 = new Personnage1(Personnage1::FORCE_GRANDE, 10);



echo '<pre>';
echo 'force  p1/p2: ', $perso1->force(), '/',      $perso2->force(),      '<br />';  
echo 'expe   p1/p2: ', $perso1->experience(), '/', $perso2->experience(), '<br />';  
echo 'degats p1/p2: ', $perso1->degats(), '/',     $perso2->degats(),     '<br /><br />';  
echo '</pre>';


$perso1->frapper($perso2);
Personnage1::parler();
$perso1->gagnerExperience();

$perso2->frapper($perso1);
Personnage1::parler();
$perso2->gagnerExperience();

echo '<pre>';
echo 'force  p1/p2: ', $perso1->force(), '/',      $perso2->force(),      '<br />';  
echo 'expe   p1/p2: ', $perso1->experience(), '/', $perso2->experience(), '<br />';  
echo 'degats p1/p2: ', $perso1->degats(), '/',     $perso2->degats(),     '<br />';  
echo '</pre>';

$test1 = new Compteur;
$test2 = new Compteur;
$test3 = new Compteur;

echo Compteur::getCompteur();
