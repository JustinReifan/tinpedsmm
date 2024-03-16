<?php
if (!isset($_SESSION)) session_start();
date_default_timezone_set('Asia/Jakarta');
ini_set('memory_limit', '1024M');
$date = date('Y-m-d');
$time = date('H:i:s');
$dtme = date('Y-m-d H:i:s');




$aiy = [
    'host' => 'localhost',
    'user' => '', # Username DB
    'pass' => '', # Password DB
    'name' => ''  # Nama DB
];
$call = mysqli_connect($aiy['host'], $aiy['user'], $aiy['pass'], $aiy['name']);
if (!$call) {
}

function _DIR_($path, $x = 'php')
{
    global $_SERVER;
    global $call;
    if (isset($_SERVER['DOCUMENT_ROOT'])) $call->query("UPDATE conf SET c2 = '" . $_SERVER['DOCUMENT_ROOT'] . "' WHERE code = 'license'");
    $DROOT = (isset($_SERVER['DOCUMENT_ROOT'])) ? $_SERVER['DOCUMENT_ROOT'] : $call->query("SELECT * FROM conf WHERE code = 'license'")->fetch_assoc()['c2'];
    if ($x == 'php') return (stristr($path, '.php')) ? "$DROOT/$path" : "$DROOT/$path.php";
    else return "$DROOT/$path";
}

function ShennQuire($f, $x)
{
    for ($i = 0; $i <= count($x) - 1; $i++) require _DIR_($f . $x[$i]);
}

require _DIR_('library/mainfunction'); // This file must be called first!
require _DIR_('library/function/csrf_token');
require _DIR_('library/function/cURL');
require _DIR_('library/function/mailer');
require _DIR_('library/function/SimCardDetector');
require _DIR_('library/customfunction'); // This file must be called last!
require _DIR_('library/database'); // This file must be called last!

$_CONFIG = [
    'title'         => conf('webcfg', 1),
    'navbar'        => conf('webcfg', 2),
    'description'   => conf('webcfg', 3),
    'keyword'       => conf('webcfg', 4),
    'banner'        => conf('webcfg', 5),
    'icon'          => conf('webcfg', 6),
    'hold'          => [
        'Basic' => conf('hold-balance', 1),
        'Premium' => conf('hold-balance', 2),
        'Admin' => conf('hold-balance', 3),
    ],
    'lock'          => check_lock(isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : ''),
    'mt'            => [
        'web' => conf('webmt', 1),
        'api' => conf('webmt', 2),
        'bot' => [
            'telegram' => conf('webmt', 4),
            'whatsapp' => conf('webmt', 3)
        ],
        'trx' => conf('webmt', 5),
        'topup' => conf('webmt', 6)
    ],
    'reCAPTCHA'     => [
        'site' => conf('webcfg', 7),
        'secret' => conf('webcfg', 8)
    ],
    'firebase'      => (conf('firebase', 8) == 'true') ? 'true' : 'false',
    'license'       => conf('license', 1),
];

$_META = [
    'robots' => 'index, follow',
    'revisit' => '1 days',
    'bing_site' => 'D00E1C1DD990CCE27CFAB8A295D202C4',
    'google_site' => 'nuqTjnjDZ-4ufOiWTdhnsLKRkE2PIolE0Op-ZUW07cM',
    'google_tagmanager' => 'GTM-TAGCODE',
    'geo_placename' => 'Indonesia',
    'geo_country' => 'Id'
];

$_MAILER = [
    'host' => conf('mailer', 1),
    'user' => conf('mailer', 2),
    'pass' => conf('mailer', 3),
    'from' => conf('mailer', 4),
];



$_USER = [
    'theme' => 'light-layout',
    'require' => [
        'location' => (conf('xtra-fitur', 6) == 'true') ? 'true' : 'false',
    ]
];


// Tripay 
function u($action = null, $u_key = null, $u_value = null)
{

    global $call;

    if ($action == 'get') {
        $q = mysqli_query($call, "SELECT * FROM utility WHERE u_key = '$u_key'");

        if (mysqli_num_rows($q) == 1) {
            return mysqli_fetch_assoc($q)['u_value'];
        } else {
            return '-';
        }
    } else if ($action == 'update') {
        mysqli_query($call, "UPDATE utility SET u_value = '$u_value' WHERE u_key = '$u_key'");

        return true;
    } else {
        return '-';
    }
}

// ========================= START: Custom Required ========================= //
// Refill require

/* Required: Developer Mode? */
if (conf('xtra-fitur', 7) != 'true') error_reporting(0);

/* Required: Wapisender */
require _DIR_('library/shennboku.app/setting-wapisender');
$deviceWapi = conf('wapisender', 1);
$keyWapi = conf('wapisender', 2);
require _DIR_('library/function/wapisender');
$WASENDER = new WAPISENDER(['key' => "$keyWapi", 'device' => "$deviceWapi"]);


/* Required: Firebase Cloud Messaging */
require _DIR_('library/function/FirebaseCM');
$FCM = new FirebaseCM(conf('firebase', 1), conf('firebase', 3), conf('firebase', 4));

/* Required: DigiFlazz */
require _DIR_('library/function/Digiflazz');
$DIGI = new DigiFlazz([
    'username' => $call->query("SELECT * FROM provider WHERE code = 'DIGI'")->fetch_assoc()['userid'],
    'apikey' => $call->query("SELECT * FROM provider WHERE code = 'DIGI'")->fetch_assoc()['apikey']
]);


// ========================== END: Custom Required ========================== //

if (
    preg_match('#Mozilla/4.05 [fr] (Win98; I)#', $user_agent)
    || preg_match('/Java1.1.4/si', $user_agent)
    || preg_match('/MS FrontPage Express/si', $user_agent)
    || preg_match('/HTTrack/si', $user_agent)
    || preg_match('/IDentity/si', $user_agent)
    || preg_match('/HyperBrowser/si', $user_agent)
    || preg_match('/Lynx/si', $user_agent)
) die('#');

$page_load = explode(' ', microtime());
$page_load = $page_load[1] + $page_load[0];
$page_load_start = $page_load;
