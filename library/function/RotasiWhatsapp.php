 <?php

class WhatsATL
{
    
    public $base_url = 'https://wagetewaymurah.npproductionstore.my.id/'; // masukan link
    
    
    private function connect($x, $n = '')
    
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($x));
        curl_setopt($ch, CURLOPT_URL, $this->base_url . $n);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
    
    public function sendMessage($apikey, $sender, $phone, $msg)
    {
        return $this->connect([
            'api_key' => $apikey,
            "sender" => $sender,
            'number' => $phone,
            'message' => $msg
        ], 'send-message');
    }
    public function sendPicture($apikey, $sender, $phone, $caption, $url, $filetype)
    {
        return $this->connect([
           'api_key' => $apikey,
            "sender" => $sender,
            'number' => $phone,
            'message' => $caption,
            'url' => $url,
            'type' => $filetype
        ], 'send-media');
    }
}
$WATL = new WhatsATL();