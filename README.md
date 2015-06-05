#OGetIt

##How to use?

	include('ogetit/ogetit_autoload.php');
	$ogetit = new OGetIt($uni, $lang, $apikey);
	$cr = $ogetit->getCombatReport($crkey);