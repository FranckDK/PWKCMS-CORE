<?php
function DateMoisTxt($mois_brut)
{
if($mois_brut=='01'){return 'Janvier';}
elseif($mois_brut=='02'){return 'Février';}
elseif($mois_brut=='03'){return 'Mars';}
elseif($mois_brut=='04'){return 'Avril';}
elseif($mois_brut=='05'){return 'Mai';}
elseif($mois_brut=='06'){return 'Juin';}
elseif($mois_brut=='07'){return 'Juillet';}
elseif($mois_brut=='08'){return 'Août';}
elseif($mois_brut=='09'){return 'Septembre';}
elseif($mois_brut=='10'){return 'Octobre';}
elseif($mois_brut=='11'){return 'Novembre';}
elseif($mois_brut=='12'){return 'Décembre';}
}

function DateMoisCourtTxt($mois_brut)
{
if($mois_brut=='01'){return 'Janv';}
elseif($mois_brut=='02'){return 'Févr';}
elseif($mois_brut=='03'){return 'Mars';}
elseif($mois_brut=='04'){return 'Avr';}
elseif($mois_brut=='05'){return 'Mai';}
elseif($mois_brut=='06'){return 'Juin';}
elseif($mois_brut=='07'){return 'Juil';}
elseif($mois_brut=='08'){return 'Août';}
elseif($mois_brut=='09'){return 'Sept';}
elseif($mois_brut=='10'){return 'Oct';}
elseif($mois_brut=='11'){return 'Nov';}
elseif($mois_brut=='12'){return 'Déc';}
}


function DateJourTxt($jour_brut)
{
if($jour_brut=='Mon'){return 'Lundi';}
elseif($jour_brut=='Tue'){return 'Mardi';}
elseif($jour_brut=='Wed'){return 'Mercredi';}
elseif($jour_brut=='Thu'){return 'Jeudi';}
elseif($jour_brut=='Fri'){return 'Vendredi';}
elseif($jour_brut=='Sat'){return 'Samedi';}
elseif($jour_brut=='Sun'){return 'Dimanche';}
}

function DateComplete($date_sql)
{
$tab_date = Date_ConvertSqlTab($date_sql);
$mktime_brut = mktime($tab_date['heure'],$tab_date['minute'],$tab_date['seconde'],$tab_date['mois'],$tab_date['jour'],$tab_date['annee']);
return DateJourTxt(date('D', $mktime_brut)).' '.$tab_date['jour'].' '.DateMoisTxt(date('m', $mktime_brut)).' '.$tab_date['annee'];
}
// EXEMPLE 
//echo DateComplete('2008-04-18 10:52:48');

function dateusenfr($dateus)
{
if (!$dateus)return "";
list($annee, $mois, $jour) = explode("-", $dateus);	$datefr = $jour."-".$mois."-".$annee;
return $datefr;
}

// pour mettre une date format fr en us
function datefrenus($datefr)
{
if (!$datefr) return "";
list($jour, $mois, $annee) = explode("-", $datefr);	$dateus = $annee."-".$mois."-".$jour;
return $dateus;
}

function datefrenus2($datefr)
{
if (!$datefr) return "";
@list($jour, $mois, $annee) = explode("/", $datefr);	$dateus = $annee."-".$mois."-".$jour;
return $dateus;
}

// retourne mois complet et annee  (ex:juin 2012)

function moinee($moinee1)
{
if (!$moinee1) return "";
list($annee,$mois) = explode("-", $moinee1);
$mois1=DateMoisTxt($mois);
$moinee1 = (''.$mois1.'&nbsp;'.$annee.'');
return $moinee1;
}

//extrait le mois de moinee
function quelmois($quelmois1)
{
if (!$quelmois1) return "";
list($annee,$mois) = explode("-", $quelmois1);$quelmois1=$mois;
return $quelmois1;
}

//extrait le annee de moinee

function quelannee($quelmois1)
{
if (!$quelmois1) return "";
list($annee,$mois) = explode("-", $quelmois1);
$quelmois1=$annee;
return $quelmois1;
}

function formattime($text, $hideseconds = 1)
{
$retval = '';
$items = explode(':', $text);
if (count($items) == 2)$items[] = '00';
if (count($items) == 3)
{
list($hour, $min, $sec) = $items;
if (is_numeric($hour) && is_numeric($min) && is_numeric($sec))
{
$hour_int = intval($hour);
$min_int = intval($min);
$sec_int = intval($sec);

if (($hour_int >= 0 && $hour_int <=23) && ($min_int >= 0 && $min_int <=59) && ($sec_int >= 0 && $sec_int <=59))
{
if ($hideseconds == 1) $retval = sprintf('%02dH%02d:%02d', $hour_int, $min_int, $sec_int);
else$retval = sprintf('% 02dH%02d', $hour_int, $min_int);
}
}
}
return $retval;
}
?>