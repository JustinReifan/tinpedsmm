<?php
require '../../connect.php';
require _DIR_('library/session/session');
function string_date($tanggal, $kostum = false) {
    
        date_default_timezone_set('Asia/Jakarta');
        
        if ($kostum === false) {
            $inputSeconds = time() - strtotime($tanggal);
        } else {
            $inputSeconds = strtotime($kostum) - strtotime($tanggal);
        }
        
        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;
    
        // Extract days
        $days = floor($inputSeconds / $secondsInADay);
    
        // Extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);
    
        // Extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);
    
        // Extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);
    
        // Format and return
        $timeParts = [];
        $sections = [
            'Hari' => (int)$days,
            'Jam' => (int)$hours,
            'Menit' => (int)$minutes,
            'Detik' => (int)$seconds,
        ];
    
        foreach ($sections as $name => $value){
            if ($value > 0){
                $timeParts[] = $value. ' '.$name.($value == 1 ? '' : '');
            }
        }
    
        return implode(' ', $timeParts);
    }

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if (!isset($_SESSION['user'])) exit('No direct script access allowed!');
    if (!isset($_POST['id'])) exit('No direct script access allowed!');
    if (empty($_POST['id'])) exit(json_encode([
        'msg' => [
            'price' => '0',
            'pricepkg' => '0',
            'min' => '0',
            'max' => '0',
            'note' => '',
            'waktu' =>'',
            'refill' => '',
        ]
    ]));

 $qlayanan = $call->query("SELECT * FROM srv_socmed WHERE id = '".filter($_POST['id'])."'");
        if (mysqli_num_rows($qlayanan) === 1) {
        
            $flayanan = mysqli_fetch_assoc($qlayanan);
            $riwayat = $call->query("SELECT * FROM trx_socmed WHERE name = '".$flayanan['name']."' AND status = 'Success' ORDER BY id DESC LIMIT 10");
        if (mysqli_num_rows($riwayat) !== 0) {
            $friwayat = mysqli_fetch_assoc($riwayat);
				    
            $selisih = string_date($friwayat['date_cr'], $friwayat['date_up']);
				    
            if (empty($selisih)) {
                $selisih = 'data tidak cukup';
            }
        } else {
            $selisih = 'data tidak cukup';
        }
    

    $search = $call->query("SELECT * FROM srv_socmed WHERE id = '" .filter($_POST['id']). "' AND status = 'available'");
	if($search->num_rows == 1):
        $row = $search->fetch_assoc();
        if($data_user['level'] == 'Admin' || $data_user['level'] == 'Premium'){
            $pricing = $row['premium'];
        } else if($data_user['level'] == 'Basic'){
            $pricing = $row['basic'];
        } else{
            $pricing = $row['h2h'];
        }
        
        // $pricing = (in_array($data_user['level'],['Admin','Premium','H2H'])) ? $row['premium'] : $row['basic'];
        print json_encode([
            'msg' => [
                    'price' => 'Rp. ' . currency($row['price'] + $pricing),
                    'pricepkg' => currency($row['price'] + $pricing),
                    'min' => currency($row['min']),
                    'max' => currency($row['max']),
                    'note' => str_replace(array("\r\n", "\\r\\n", "\r", "\n"), '<br>','<i class="fas fa-exclamation-circle"></i>'.' Deskripsi'.'<br>'.$row['note']),
                    'type' => $row['type'],
                    'srvid' => $row['id'],
                    'waktu' => $selisih,
                    'provider' => $row['provider'],
            ]
        ]);
    else:
        print json_encode([
            'msg' => [
                'price' => '0',
                'pricepkg' => '0',
                'min' => '0',
                'max' => '0',
                'note' => '',
                'type' => '',
                'refill' => '',
                'waktu' => 'data tidak cukup',
            ]
        ]);
    endif;
        } else {
            exit('Data tidak ditemukan');
        }
} else {
	exit('No direct script access allowed!');
}