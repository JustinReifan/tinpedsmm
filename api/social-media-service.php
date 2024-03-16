<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
$post_ft = isset($_POST['filter_type']) ? filter($_POST['filter_type']) : '';
$post_fv = isset($_POST['filter_value']) ? $_POST['filter_value'] : '';

$value = "SELECT * FROM srv_socmed";
if($post_ft == 'category' && !empty($post_fv)) $value .= " WHERE cid = '$post_fv'";
$value .= " ORDER BY name ASC, price ASC";
$search = $call->query($value);

if($search->num_rows == 0) {
    ShennDie(['result' => false,'data' => null,'message' => 'Layanan tidak ditemukan.']);
} else {
    while($row = $search->fetch_assoc()) {
        // $profit = (in_array($data_user['level'],['Admin','Premium','H2H'])) ? $row['h2h'] ?: $row['premium'] : $row['basic'];
        if($data_user['level'] == 'Admin' || $data_user['level'] == 'Premium'){
            $profit = $row['premium'];
        } else if($data_user['level'] == 'H2H'){
            $profit = $row['h2h'];
        } else{
            $profit = $row['basic'];
        }
        $out[] = [
            'category' => $row['cid'],
            'id' => $row['id'],
            'max' => (int)$row['max'],
            'min' => (int)$row['min'],
            'name' => $row['name'],
            'note' => $row['note'],
            'price' => (int)$row['price']+$profit,
            'status' => $row['status'],
        ];
    }
    ShennDie(['result' => true,'data' => $out,'message' => 'Daftar layanan berhasil didapatkan.']);
}