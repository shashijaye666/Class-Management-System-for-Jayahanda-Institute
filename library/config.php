<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

 session_start();
 ob_start();
 date_default_timezone_set("Asia/Colombo");

 //variables used for jwt
define('key','elogicextea');
define('iss','http://example.com'); //issuer
define('aud','http://example.com'); //audience
define('iat',1356999524); //issue datetime
define('nbf',1357000000); //not before time


define('DS','/');
//define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].'/EducationalCenter');
define('INC_PATH', SITE_ROOT.DS.'includes'.DS);
define('LIB_PATH', SITE_ROOT.DS.'library'.DS);
define('ClASS_PATH', SITE_ROOT.DS.'class'.DS);
//define('ADMIN_PATH', SITE_ROOT.DS.'admin'.DS);
define('SITE_PATH', SITE_ROOT.DS.'public'.DS);
define('ADMIN_PATH', SITE_ROOT.DS.'admin'.DS);
define('RPT_PATH', SITE_ROOT.DS.'reports'.DS);
define('TEMPLATE', SITE_ROOT.DS.'template'.DS);

define('UPLOAD', SITE_ROOT.DS.'theme'.DS.'site'.DS.'images'.DS.'posts'.DS);

include(LIB_PATH.'dbconfig.php');
include(LIB_PATH.'class.template.php');
include(LIB_PATH.'class.database.php');

include(LIB_PATH.'phpmailer/Exception.php');
include(LIB_PATH.'phpmailer/PHPMailer.php');
include(LIB_PATH.'phpmailer/SMTP.php');

include(LIB_PATH.'php-jwt-master/src/BeforeValidException.php');
include(LIB_PATH.'php-jwt-master/src/ExpiredException.php');
include(LIB_PATH.'php-jwt-master/src/SignatureInvalidException.php');
include(LIB_PATH.'php-jwt-master/src/JWT.php');
include(LIB_PATH.'class.LoggerServices.php');

//Class
// include(ClASS_PATH.'class.tenant.php');
// include(ClASS_PATH.'class.level.php');
// include(ClASS_PATH.'class.tower.php');
// include(ClASS_PATH.'class.seasonpassrates.php');
// include(ClASS_PATH.'class.season.php');
// include(ClASS_PATH.'class.seasonvehicles.php');
// include(ClASS_PATH.'class.transactionreport.php');
// include(ClASS_PATH.'class.seasondetailreport.php');
// include(ClASS_PATH.'class.paymentsummaryreport.php');
// include(ClASS_PATH.'class.paymodesummeryreport.php');
// include(ClASS_PATH.'class.freeout.php');
// include(ClASS_PATH.'class.freeoutreport.php');
// include(ClASS_PATH.'class.manualoutreport.php');
// include(ClASS_PATH.'class.frmblacklist.php');
// include(ClASS_PATH.'class.complementaryevents.php');
// include(ClASS_PATH.'class.property.php');
// include(ClASS_PATH.'class.complementaryrate.php');
// include(ClASS_PATH.'class.rate.php');
// include(ClASS_PATH.'class.complimentry.php');
// include(ClASS_PATH.'class.holiday.php');
// include(ClASS_PATH.'class.Vehicle.php');
// include(ClASS_PATH.'class.PaymentMst.php');
// include(ClASS_PATH.'class.PaymentResult.php');
// include(ClASS_PATH.'class.vehicleEntry1.php');
// include(ClASS_PATH.'class.parkingslot.php');
// include(ClASS_PATH.'class.seasontier.php');
// include(ClASS_PATH.'class.wallettransaction.php');
// include(ClASS_PATH.'class.walletpaymentreport.php');
// include(ClASS_PATH.'class.walletbalancereport.php');
// include(ClASS_PATH.'class.pod.php');

include(ClASS_PATH.'class.time.php');
include(ClASS_PATH.'class.user.php');
include(ClASS_PATH.'class.default.php');
include(ClASS_PATH.'class.CGuser.php');
include(ClASS_PATH.'class.userlevel.php');
include(ClASS_PATH.'class.student.php');
include(ClASS_PATH.'class.teachers.php');
include(ClASS_PATH.'class.classesshedule.php');


$db = new database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$db) die("Database error");

?>
