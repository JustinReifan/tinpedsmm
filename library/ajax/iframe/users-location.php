<?php
require '../../../connect.php';
require _DIR_('library/session/session');

if(isset($data_user) && isset($_GET['__v'])) {
    $stype = $_GET['__v'];
    if(!isset($_SESSION['user'])) exit('Tidak ada akses skrip langsung yang diizinkan!');
    if(!in_array($stype,['1','2','3'])) exit('Tidak ada akses skrip langsung yang diizinkan!');
    $var_locations = '';
    $var_setViews = '[-6.928844, 107.027946], 5';
    
    if($stype == 1) {
        $search_location = $call->query("SELECT * FROM users_location");
        if($search_location->num_rows > 0) {
            while($data_location = $search_location->fetch_assoc()) {
                $var_locations .= '["'.$data_location['user'].'<br>'.$data_location['ud'].'<br>'.$data_location['dev'].'<br>'.$data_location['ip'].' ('.$data_location['loc'].')", '.$data_location['lat'].', '.$data_location['lon'].'],';
            }
        } else {
            exit('Akses Lokasi tidak ditemukan,harap beri akses lokasi untuk keamanan akun anda!.');
        }
    } else if($stype == 2 && isset($_GET['u']) && $data_user['level'] == 'Admin') {
        $search_location = $call->query("SELECT * FROM users_location WHERE user = '".filter($_GET['u'])."'");
        if($search_location->num_rows > 0) {
            while($data_location = $search_location->fetch_assoc()) {
                $var_locations .= '["'.$data_location['ud'].'<br>'.$data_location['dev'].'<br>'.$data_location['ip'].' ('.$data_location['loc'].')", '.$data_location['lat'].', '.$data_location['lon'].'],';
            }
        } else {
            exit('Pengguna tidak ditemukan!');
        }
    } else if($stype == 3 && isset($_GET['u']) && isset($_GET['c'])) {
        $search_location = $call->query("SELECT * FROM users_cookie WHERE cookie = '".filter($_GET['c'])."' AND username = '$sess_username'");
        if($_GET['u'] <> $sess_username) {
            exit('Apa yang kamu inginkan?!');
        } else if($search_location->num_rows > 0) {
            $data_location = $search_location->fetch_assoc();
            $data_coor = explode(', ', $data_location['coor']);
            if(!isset($data_coor[1])) {
                exit('Akses Lokasi tidak ditemukan,harap beri akses lokasi untuk keamanan akun anda!.');
            } else {
                $var_locations .= '["'.$data_location['ud'].'<br>'.$data_location['dev'].'<br>'.$data_location['ip'].' ('.$data_location['loc'].')", '.$data_location['coor'].'],';
                $var_setViews = '['.$data_location['coor'].'], 16';
            }
        } else {
            exit('Akses Masuk tidak ditemukan!');
        }
    } else {
        exit('Tidak ada akses skrip langsung yang diizinkan!');
    }
?>
<html>
    <head>
        <style>body, html { height: 100%; } #map { width: 100%; height: 100%;}</style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="map" class="height-400"></div>
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        <script type="text/javascript">
            var locations = [<?= $var_locations ?>];
            var map = L.map('map').setView(<?= $var_setViews ?>);
            mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: '&copy; ' + mapLink + ' Contributors',maxZoom: 18,}).addTo(map);
            for (var i = 0; i < locations.length; i++) {
                marker = new L.marker([locations[i][1], locations[i][2]]).bindPopup(locations[i][0]).addTo(map);
            }
        </script>
    </body>
</html>
<?
} else {
	exit('Tidak ada akses skrip langsung yang diizinkan!');
}