#OGetIt

##How to use?

	include('ogetit/ogetit_autoload.php');
	$ogetit = new OGetIt($uni, $lang, $apikey);
	$cr = $ogetit->getCombatReport($crkey);
	
##Requirements

* PHP Version 5.3+ 

##Exceptions

###cURL codes

http://curl.haxx.se/libcurl/c/libcurl-errors.html

###OGame API codes

	OK = 1000;
	INVALID_VERSION = 4000;
	INVALID_API_KEY = 4001;
	INVALID_API_KEY_EXPIRED = 4002;
	INVALID_API_PERMISSION = 4003;
	INVALID_PATH = 4004;
	INTERNAL_ERROR = 5000;
	INVALID_CR_ID = 6000;