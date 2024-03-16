<?php
if($data_user['level'] == 'Admin') li('Admin','feather icon-bookmark info','/admin');

li('Dashboard','feather icon-home secondary','/');

if($data_user['level'] != 'Basic') ul([
    'name' => 'Premium',
    'icon' => 'feather icon-feather primary',
    'content' => [
        ['name' => 'Transfer Saldo','page' => '/premium/transfer'],
        ['name' => 'Membuat Kode','page' => '/premium/voucher'],
        // ['name' => 'Downlie Saya','page' => '/premium/downline'],
    ]
]);



ulhead('Menu Utama');

ul([
    'name' => 'Deposit',
    'icon' => 'feather icon-dollar-sign warning',
    'content' => [
        ['name' => 'Baru','page' => '/deposit/new'],
        ['name' => 'Voucher','page' => '/deposit/voucher'],
        ['name' => 'Riwayat','page' => '/deposit/history'],
    ]
]);

if(conf('xtra-fitur',4) == 'true') ul([
    'name' => 'Top Penguna',
    'icon' => 'feather icon-award danger',
    'content' => [
        ['name' => 'Deposit','page' => '/page/monthly-rating/deposit'],
        ['name' => 'Pulsa & PPOB','page' => '/page/monthly-rating/pulsa-ppob'],
        (conf('xtra-fitur',3) == 'true') ? ['name' => 'Social Media','page' => '/page/monthly-rating/social-media'] : '',
        (conf('xtra-fitur',2) == 'true') ? ['name' => 'Game Feature','page' => '/page/monthly-rating/game-feature'] : '',
    ]
]);

if(conf('xtra-fitur',2) <> 'true' && conf('xtra-fitur',3) <> 'true') {
    li('Monitoring','feather icon-monitor','/page/monitoring/pulsa-ppob');
} else {
ul([
    'name' => 'Live Transaksi',
    'icon' => 'feather icon-loader fa-spin info',
    'content' => [
        ['name' => 'Pulsa & PPOB','page' => '/page/monitoring/pulsa-ppob'],
        (conf('xtra-fitur',3) == 'true') ? ['name' => 'Social Media','page' => '/page/monitoring/social-media'] : '',
        (conf('xtra-fitur',2) == 'true') ? ['name' => 'Game & Lainnya','page' => '/page/monitoring/game-feature'] : '',
    ]
]);

ul([
    'name' => 'Program Referral',
    'icon' => 'fas fa-gift success',
    'content' => [
        ['name' => 'Downline','page' => '/page/downline'],
    ]
]);

};



if(conf('xtra-fitur',2) <> 'true' && conf('xtra-fitur',3) <> 'true') {
    li('History','feather icon-shopping-bag','/order/history/pulsa-ppob');
} else {
    ul([
        'name' => 'Riwayat Transaksi',
        'icon' => 'feather icon-shopping-bag warning',
        'content' => [
            #['name' => 'Grafik','page' => '/order/history/grafik'],
            ['name' => 'Pulsa & PPOB','page' => '/order/history/pulsa-ppob'],
            (conf('xtra-fitur',3) == 'true') ? ['name' => 'Social Media','page' => '/order/history/social-media'] : '',
            (conf('xtra-fitur',2) == 'true') ? ['name' => 'Game Feature','page' => '/order/history/game-feature'] : '',
        ]
    ]);

}
li('Mutasi Saldo','far fa-credit-card primary','/account/mutation');
// li('Refill & Cancel','fas fa-recycle blue-icon','/refill/index');

li('Daftar Harga','feather icon-tag info','/page/daftar-harga');

if($data_user['level'] == 'Basic' | $data_user['level'] == 'Premium' | $data_user['level'] == 'Admin' ) li('Rekomendasi Layanan','fas fa-fire danger','/page/rekomendasi-layanan');

ulhead('Pusat Bantuan <span style="position: relative; top: 42px; left: 18px; z-index: 100; background-color: #e90036;" class="badge badge-glow ml-auto mr-2">'.$jumlahPesan.'</span>');

li('Tiket Bantuan','mdi mdi-comment-multiple-outline primary','/tiket/index');

ul([
    'name' => 'Halaman',
    'icon' => 'feather icon-map info',
    'content' => [
        ['name' => 'Pusat Informasi','page' => '/page/information'],
        ['name' => 'Persyaratan Layanan','page' => '/page/terms-of-service'],
        ['name' => 'Pertanyaan Umum','page' => '/page/general-questions'],
        ['name' => 'Hubungi Admin','page' => '/page/contact'],
    ]
]);


ul([
    'name' => 'API Documentation',
    'icon' => 'feather icon-terminal danger',
    'content' => [
        ['name' => 'Profile','page' => '/page/api/profile'],
        ['name' => 'Prepaid','page' => '/page/api/prepaid'],
        (conf('xtra-fitur',1) == 'true') ? ['name' => 'Postpaid','page' => '/page/api/postpaid'] : '',
        (conf('xtra-fitur',3) == 'true') ? ['name' => 'Sosial Media','page' => '/page/api/social-media'] : '',
        (conf('xtra-fitur',2) == 'true') ? ['name' => 'Game Feature','page' => '/page/api/game-feature'] : '',
    ]
]);
?>