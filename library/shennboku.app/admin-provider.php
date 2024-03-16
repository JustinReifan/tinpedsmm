<?php
if (!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
function ShennCheck($code, $uid, $ukey, $secret)
{
    global $curl;
    global $call;
    if ($call->query("SELECT * FROM provider WHERE code = '$code'")->num_rows == 1) {
        $data = $call->query("SELECT * FROM provider WHERE code = '$code'")->fetch_assoc();
        if ($code == 'ROTASIPEDIA') {
            $json = $curl->connectPost($data['link'] . 'profile', ['key' => $ukey, 'sign' => md5($uid . $ukey)]);
            if (isset($json['result'])) {
                if ($json['result'] == true) {
                    $res = ['type' => true, 'data' => $json['data']];
                    $call->query("UPDATE provider SET balance = '" . $json['data']['balance'] . "' WHERE code = '$code'");
                }
                if ($json['result'] == false) $res = ['type' => false, 'msg' => $json['message']];
            } else {
                $res = ['type' => false, 'msg' => 'Connection Failed!'];
            }
        } else if($code == 'VIP') {
            $json = $curl->connectPost($data['link'].'profile',['key' => $ukey, 'sign' => md5($uid.$ukey)]);

            if(isset($json['result'])) {
                if($json['result'] == true) {
                    $res = ['type' => true,'data' => $json['data']];
                    $call->query("UPDATE provider SET balance = '".$json['data']['balance']."' WHERE code = '$code'");
                }
                if($json['result'] == false) $res = ['type' => false,'msg' => $json['data']];
            } else {
                $res = ['type' => false,'msg' => 'Connection Failed!'];
            }
        }else if($code == 'MEDANPEDIA') {
            $json = $curl->connectPost($data['link'].'/profile',['api_id' => $uid,'api_key' => $ukey]);
            if(isset($json['status'])) {
                if($json['status'] == true) {
                    $res = ['type' => true,'data' => $json['data']];
                    $call->query("UPDATE provider SET balance = '".$json['data']['balance']."' WHERE code = '$code'");
                }
                if($json['status'] == false) $res = ['type' => false,'msg' => $json['data']['msg']];
            } else {
                $res = ['type' => false,'msg' => 'Connection Failed!'];
            }
        }else if($code == 'LOLLIPOP') {
            $json = $curl->connectPost($data['link'].'/profile',['api_id' => $uid,'api_key' => $ukey]);
            if(isset($json['status'])) {
                if($json['status'] == true) {
                    $res = ['type' => true,'data' => $json['data']];
                    $call->query("UPDATE provider SET balance = '".$json['data']['balance']."' WHERE code = '$code'");
                }
                if($json['status'] == false) $res = ['type' => false,'msg' => $json['data']['msg']];
            } else {
                $res = ['type' => false,'msg' => 'Connection Failed!'];
            }
        }else if($code == 'DIGI') {
            $json = $curl->connectHeaderPost($data['link'].'/cek-saldo',['Content-Type: application/json'],json_encode([
                'cmd' => 'deposit',
                'username' => $uid,
                'sign' => md5($uid.$ukey.'depo')
            ]));
            if(isset($json['data']['deposit'])) {
                $res = ['type' => true,'data' => $json['data']];
                $call->query("UPDATE provider SET balance = '".$json['data']['deposit']."' WHERE code = '$code'");
            } else {
                $res = ['type' => false,'msg' => (isset($json['data']['message']) ? $json['data']['message'] : 'Connection Failed!')];
            }
        } else {
            $res = ['type' => false,'msg' => 'Connection not found!'];
        }
    } else {
        $res = ['type' => false,'msg' => 'Provider not registered!'];
    }
    return $res;
}


if (isset($_POST['SETUPDATE'])) {
    $web_token = base64_decode($_POST['web_token']);
    $api_id = (isset($_POST['userid'])) ? filter($_POST['userid']) : '-';
    $apikey = (!empty($_POST['apikey'])) ? filter($_POST['apikey']) : '';
    $secretkey = (!empty($_POST['secretkey'])) ? filter($_POST['secretkey']) : '';

    if ($result_csrf == false) {
        ShennXit(['type' => false, 'message' => 'System Error, please try again later.']);
    } else if ($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false, 'message' => $_CONFIG['lock']['reason']]);
    } else if (!in_array($data_user['level'], ['Admin'])) {
        ShennXit(['type' => false, 'message' => 'You do not have access to use this feature.']);
    } else {
        $try = (!$apikey) ? ['type' => true] : ShennCheck($web_token, $api_id, $apikey, $secretkey);
        if ($try['type'] == true) {
            if ($call->query("UPDATE provider SET userid = '$api_id', apikey = '$apikey', secretkey = '$secretkey' WHERE code = '$web_token'") == true) {
                ShennXit(['type' => true, 'message' => 'Connection success, data updated.']);
            } else {
                ShennXit(['type' => false, 'message' => 'Our server is in trouble, please try again later.']);
            }
        } else {
            ShennXit(['type' => false, 'message' => $try['msg']]);
        }
    }
}