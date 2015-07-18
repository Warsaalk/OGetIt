#OGetIt

OGetIt is a open source library for handling the new OGame API as of version 6.

It handles everything from connecting with the API, parsing the API to advanced calculations to get detailed results.    

##How to use?

	include('autoload.php');
	$ogetit = new OGetIt($uni, $lang, $apikey);
	$cr = $ogetit->getCombatReport($crkey);
	
###Get detailed resource losses for the attackers
	
	$result = $cr->getCalculator()->getFinalResult();
	$result['attackers']->getValue(true);
	
##Requirements

* PHP v5.4+ 
* PHP cURL (libcurl v7.10.5+)

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

##Contributing

If you want to contribute code please fork this repository and create a pull request to merge your changes.
Your changes will be reviewed and merged afterwards if approved by the repository maintainers.

##License

GNU Lesser General Public License, Version 3

* Source license: [GNU GPL](COPYING)
* Lesser license: [GNU LGPL](COPYING.LESSER)