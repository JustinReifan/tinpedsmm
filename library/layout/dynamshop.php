<?php
 if($data_user['level'] == '') { 
     li('Login','feather icon-log-in info','/auth/login');
li('Register','feather icon-user-plus danger','/auth/register');
 }else{

}
li('Daftar Harga & Layanan','feather icon-tag info','/page/product');


ulhead('Pusat Bantuan');
ul([
    'name' => 'Halaman',
    'icon' => 'feather icon-map primary',
    'content' => [
        ['name' => 'Ketentuan Layanan','page' => '/page/terms-of-service'],
        ['name' => 'Pertanyaan Umum','page' => '/page/general-questions'],
        ['name' => 'Hubungi Admin','page' => '/page/contact'],
    ]
]);

if(conf('xtra-fitur',2) <> 'true' && conf('xtra-fitur',3) <> 'true') {
    li('Monitoring','feather icon-monitor info','/page/monitoring/pulsa-ppob');
} 

ul([
    'name' => 'API Documentation',
    'icon' => 'feather icon-terminal danger',
    'content' => [
        ['name' => 'Profile','page' => '/page/api/profile'],
        ['name' => 'Prepaid','page' => '/page/api/prepaid'],
        (conf('xtra-fitur',1) == 'true') ? ['name' => 'Postpaid','page' => '/page/api/postpaid'] : '',
        (conf('xtra-fitur',3) == 'true') ? ['name' => 'Social Media','page' => '/page/api/social-media'] : '',
        (conf('xtra-fitur',2) == 'true') ? ['name' => 'Game Feature','page' => '/page/api/game-feature'] : '',
    ]
]);
?>