<?php

/* **********************************

 * 

 *        Leap System eLearning

 *      @author elroy,efindi,budiarto

 *          www.leap-systems.com

 * 

 ************************************/

/******************************

 *  LOAD All Frameworks

 *  using Leap loosely coupled Object Oriented Framework

 *  using PHP Framework Interop Group Standard

 *****************************/


require_once 'SplClassLoader.php';

//enginepath

$enginepath = 'framework';

//namespace or vendorname

$ns = "Leap";

//autoload all Classes in the FrameWork

$loader = new SplClassLoader($ns, $enginepath);

$loader->register();


//get the init class, kalau tidak ada perubahan juga bisa langsung pakai Init yang di framework

//use Leap\InitLeap;

require_once 'Init.php'; // pembedanya adalah yg disini untuk load yg local classes saja

//get global functions 

require_once 'functions.php';



/******************************

 *  AUTO LOAD Apps

 *****************************/



// LOAD Leap eLearning Apps

/*$pathToApps = 'app';

//namespace

$nsToApps = "LeapElearning";

//autoload all Classes in the FrameWork

$loader = new SplClassLoader($nsToApps, $pathToApps);

$loader->register();

*/

$di = new RecursiveDirectoryIterator('app',RecursiveDirectoryIterator::SKIP_DOTS);
//pr($di);
$it = new RecursiveIteratorIterator($di);
//pr($it);

//sort function
$files2Load = array();
foreach($it as $file)
{

    if(pathinfo($file,PATHINFO_EXTENSION) == "php")
	{
    	$files2Load[]= $file->getPathname();
	}
}
sort($files2Load);
//pr($files2Load);

foreach($files2Load as $file)

{

     require_once $file;

}


// include db setting, web setting, and paths

require_once 'include/access.php';



$init = new Init($mainClass,$DbSetting,$WebSetting,$timezone,$js,$css,$nameSpaceForApps);

//starting the session
session_start();
//pr($WebSetting);
//Init Languange

$lang = new Lang($WebSetting['lang']);

$lang->activateLangSession();

$lang->activateGetSetLang();
//pr($lang);
//pr($_SESSION);
$selected_lang = Lang::getLang();
if(!isset($selected_lang) || $selected_lang == "" || is_object($selected_lang))
$selected_lang = "id";

//pr($selected_lang);

//echo "lang/".strtolower($selected_lang).".php";
require_once ("lang/".strtolower($selected_lang).".php");

//get globals

$db = $init->getDB();

$params = $init->getParams();

$template = $init->getTemplate();

//pr($init);

$init->run();