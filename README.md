# OGetIt

OGetIt is a open source library for handling the new OGame API as of version 6.

It handles everything from connecting with the API, parsing the API to advanced calculations to get detailed results.    

## Supported features
### Reports
* Combat
* Harvest
* Espionage
* Missile

## How to use?

	include('autoload.php'); //Or via Composer
	$ogetit = new OGetIt($uni, $lang, $apikey);
	
	//Get Combat report
	$cr = $ogetit->getCombatReport($crkey);
	
	//Get Harvest report
	$rr = $ogetit->getHarvestReport($rrkey);
	
	//Get Spy report
	$sr = $ogetit->getSpyReport($srkey);
	
	//Get Missile report
	$mr = $ogetit->getMissileReport($mrkey);
	
### Examples
#### Get attacker losses from combat report
	
	$cr = $ogetit->getCombatReport($crkey);
	$result = $cr->getCalculator()->getFinalResult();
	$result->getAttackers()->getLosses();
	
#### Get harvested metal from harvest report
	
	$rr = $ogetit->getHarvestReport($rrkey);
	$rr->getMetal();
	
#### Get Astrophysics level from espionage report

	$sr = $ogetit->getSpyReport($srkey);
	$sr->getDefender()->getResearch()[Astrophysics::TYPE];
	
#### Get defender losses from missile report

	$mr = $ogetit->getMissileReport($mrkey);
	$mr->getDefender()->getLosses();
	
## Requirements

* PHP v5.4+ (64-bit)
* PHP cURL (libcurl v7.10.5+)

## Exceptions

### cURL codes

http://curl.haxx.se/libcurl/c/libcurl-errors.html

### OGame API codes

	OK = 1000;
	INVALID_VERSION = 4000;
	INVALID_API_KEY = 4001;
	INVALID_API_KEY_EXPIRED = 4002;
	INVALID_API_PERMISSION = 4003;
	INVALID_PATH = 4004;
	INTERNAL_ERROR = 5000;
	INVALID_CR_ID = 6000;

## Contributing

If you want to contribute code please fork this repository and create a pull request to merge your changes.
Your changes will be reviewed and merged afterwards if approved by the repository maintainers.

## License

GNU Lesser General Public License, version 2.1

* License: [GNU LGPL](COPYING)
