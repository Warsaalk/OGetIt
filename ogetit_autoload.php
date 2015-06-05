<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . PATH_SEPARATOR);

if (function_exists('__autoload')) {
	spl_autoload_register('__autoload');
} else {
	spl_autoload_extensions('.php');
}
spl_autoload_register('spl_autoload');