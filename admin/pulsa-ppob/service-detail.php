<?php
require '../../connect.php';
require _DIR_('library/session/session');

$get_id = (isset($_GET['id'])) ? $_GET['id'] : '';
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!isset($_SESSION['user'])) exit("No direct script access allowed!");
    if($data_user['level'] !== 'Admin') exit("No direct script access allowed!");
    $search = $call->query("SELECT * FROM srv_ppob WHERE id = '$get_id'");
    if($search->num_rows == 0) exit("No data found from the Code!");
    $row = $search->fetch_assoc();
    
    $data_provider = $call->query("SELECT * FROM provider WHERE code = '".$row['provider']."'");
    if($data_provider->num_rows == 1) $data_provider = $data_provider->fetch_assoc();
    $nama_provider = (is_array($data_provider)) ? $data_provider['name'] : $row['provider'];
    
    $out_status = '<i class="feather icon-x-circle text-danger"></i> Out of Stock!';
    if($row['status'] == 'available') $out_status = '<i class="feather icon-check-circle text-success"></i> Available!';

    $data_category = $call->query("SELECT * FROM category WHERE code = '".$row['brand']."' AND `type` = '".$row['type']."' AND `order` IN ('prepaid','postpaid')");
    if($data_category->num_rows == 1) $data_category = $data_category->fetch_assoc();
    $nama_category = (is_array($data_category)) ? $data_category['name'] : $row['brand'];
    $nama_type = strtr($row['type'],[
        'pulsa-reguler'       => 'Pulsa Reguler',           'voucher-game'  => 'Voucher Game',
        'pulsa-internasional' => 'Pulsa Internasional',     'streaming-tv'  => 'Streaming & TV',
        'paket-internet'      => 'Paket Internet',          'saldo-emoney'  => 'Saldo E-Money',
        'paket-telepon'       => 'Paket Telepon dan SMS',   'paket-lainnya' => 'Kategori Lainnya',
        'token-pln'           => 'Token Listrik (PLN)',     'pascabayar'    => 'Pascabayar',
    ]);
?>
<div class="table-responsive">
    <table class="table table-bordered" style="border:1px solid #dee2e6;">
        <tbody>
            <tr><th>Brand</th><td><?= $nama_category ?></td></tr>
            <tr><th>Type</th><td><?= $nama_type ?></td></tr>
            <tr><th>Name</th><td><?= $row['name'] ?></td></tr>
            <tr><th>Note</th><td><?= nl2br($row['note']) ?></td></tr>
            <tr><th>Price</th><td>
                <li>Rp <?= currency($row['price']) ?> [Source]</li>
                <li>Rp <?= currency($row['price']+$row['basic']) ?> [Basic]</li>
                <li>Rp <?= currency($row['price']+$row['premium']) ?> [Premium]</li>
            </td></tr>
            <tr><th>Status</th><td><?= $out_status ?></td></tr>
            <tr><th>Provider</th><td><?= $nama_provider.' [ '.$row['code'].' ]' ?></td></tr>
            <tr><th>Last Update</th><td><?= format_date('en',$row['date_up']) ?></td></tr>
        </tbody>
    </table>
</div>
<?php
} else {
    exit("No direct script access allowed!");
}
?>