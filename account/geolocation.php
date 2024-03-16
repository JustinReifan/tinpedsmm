<?php
require '../connect.php';
require _DIR_('library/session/session');

$get_cookie = isset($_GET['__c']) ? filter($_GET['__c']) : '';
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!isset($_SESSION['user'])) exit("Tidak ada akses skrip langsung yang diizinkan!");
    if(!$get_cookie) exit('Tidak ada akses skrip langsung yang diizinkan!');
    $search = $call->query("SELECT * FROM users_cookie WHERE cookie = '$get_cookie' AND username = '$sess_username'");
    if($search->num_rows == false) exit('Akses Masuk tidak ditemukan.');
    $row = $search->fetch_assoc();
    $data_coor = explode(', ', $row['coor']);
    if(!isset($data_coor[1])) exit('Akses Lokasi tidak ditemukan,harap beri akses lokasi untuk keamanan akun anda!.');
?>
<iframe src="<?= ajaxlib('iframe/users-location?__v=3&u='.$row['username'].'&c='.$get_cookie) ?>" style="border:none;" loading="lazy" width="100%" height="400"></iframe>
<?php
} else {
    exit("Tidak ada akses skrip langsung yang diizinkan!");
}
?>