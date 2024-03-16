<?php
require '../../connect.php';

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if(!isset($_POST['category']) || !isset($_POST['type'])) exit("No direct script access allowed!");
    if(!in_array($_POST['type'], ['socmed','ppob','games'])) exit("No direct script access allowed!");
    if($_POST['type'] == 'ppob' && !isset($_POST['brand'])) exit("No direct script access allowed!");
    
    if($_POST['type'] == 'socmed') {
        $search = $call->query("SELECT * FROM srv_socmed WHERE cid = '".$_POST['category']."' AND server = 'S1' ORDER BY price ASC");
        if($search->num_rows > 0) {
            while($row = $search->fetch_assoc()) {
                $get_status = ($row['status'] == 'available') ? "<font color='green'><i class='far fa-check-circle mr-1'></i>Tersedia</font>" : "<font color='red'><i class='far fa-times-circle mr-1'></i>Gangguan</font>";
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= currency($row['min']) ?></td>
                    <td><?= currency($row['max']) ?></td>
                    <td><span class="badge badge-glow badge-pill badge-primary">Rp <?= currency($row['price']+$row['basic']) ?></span></td>
                    <td><span class="badge badge-glow badge-pill badge-success">Rp <?= currency($row['price']+$row['premium']) ?></span></td>
                    <td><span class="badge badge-glow badge-pill badge-danger">Rp <?= currency($row['price']+$row['h2h']) ?></span></td>
                    <td><?= $row['note'] ?></td>
                    <td align="center"><?= $get_status ?></td>
                </tr>
                <?
            }
        } else {
            print '
                <tr>
                    <td colspan="6" class="text-center">No data available.</td>
                    <td class="text-center text-danger"><i class="far fa-times-circle"></td>
                </tr>
            ';
        }
    }
} else {
    exit("No direct script access allowed!");
}