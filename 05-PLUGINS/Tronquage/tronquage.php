<?php
//fonction limitation de mots
function debutchaine($chaine, $nbmots, $idn)
{ // 1er argument : chaîne - 2e argument : nombre de mots
$chaine = preg_replace('!<br.*>!iU', "", $chaine); // remplacement des BR par des espaces
$chaine = strip_tags($chaine);
$chaine = preg_replace('/\s\s+/', ' ', $chaine); // retrait des espaces inutiles
$tab = explode(" ",$chaine);
if (count($tab) <= $nbmots)
{
$affiche = $chaine;
}
else
{
$affiche = "$tab[0]";
for ($i=1; $i<$nbmots; $i++)
{
$affiche .= " $tab[$i]";
}
}

if (count($tab) > $nbmots )
{
$affiche .= '<br/><br/><a href="module.php?id=News&do=Lire&idn='.$idn.'"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-eye"></i> Lire la suite</button></a>';
} 
return $affiche;
}

//$mots_complets = 'salut sa va bien je suis un super pote a toi on rigole tou le temp c tro dorle comme on ce marre c bien le stage ouai sa va encore c pa mal mais bon c pa tt le temp marran oui mai comme dans la vrai vie tu sais on fai pa tout le temps ce quon veu sa serait telllement rigolo sinon ahahahahahahahahahaha bebebebebebebebeeb cececececececececececec'; //data événement
//$nb_mots = 150;
//$mot_courts = debutchaine($mots_complets, $nb_mots);
//echo $mot_courts; 
?>