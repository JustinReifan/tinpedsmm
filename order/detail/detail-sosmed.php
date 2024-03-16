<?php
require '../../connect.php';
require _DIR_('library/session/session');

$get_tid = (isset($_GET['id'])) ? filter($_GET['id']) : '';
$get_req = (isset($_GET['req'])) ? $_GET['req'] : 'Member';
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!$_SESSION['user']) exit('No direct script access allowed!');
    if(!$get_tid) exit('No direct script access allowed!');
    
    $search = $call->query("SELECT * FROM srv_socmed WHERE id = '$get_tid'");
    if($search->num_rows == 1) {
        $row = $search->fetch_assoc();
        ?>
        <div class="table-responsive">
            <table class="table table-bordered" style="border:1px solid #dee2e6;">
                <tbody>
                    <? if($data_user['level'] == 'Admin' && $get_req == 'Admin') { ?>
                    <tr><th>ID</th><td><?= $row['id'] ?></td></tr>
                    <tr><th>Keterangan</th><td><?= $row['note'] ?></td></tr>
                    <tr><th>Min Order</th><td><?= $row['min'] ?></td></tr>
                    <tr><th>Max order</th><td><?= $row['max'] ?></td></tr>
                    <tr><th>Waktu Proses</th><td><?= timeProcess($row['date_cr'],$row['date_up']) ?></td></tr>
                    <? ################################################################### ?>
                    <? } else { ?>
                    <? ################################################################### ?>
                    <tr><th>ID</th><td><?= $row['id'] ?></td></tr>
                    <tr><th>Keterangan</th><td><?= $row['note'] ?></td></tr>
                    <tr><th>Min Order</th><td><?= $row['min'] ?></td></tr>
                    <tr><th>Max order</th><td><?= $row['max'] ?></td></tr>
                    <tr><th>Waktu Proses</th><td><?= timeProcess($row['date_cr'],$row['date_up']) ?></td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    <?php } else { exit('#'.$get_tid.' not found'); }
} else {
    exit('No direct script access allowed!');
}