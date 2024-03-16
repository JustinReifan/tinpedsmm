<?php
li('Back','feather icon-home warning','/');
li('Home','feather icon-umbrella warning','/admin/');
ul([
    'name' => 'Users',
    'icon' => 'feather icon-user',
    'content' => [
        ['name' => 'Manage Users','page' => '/admin/users/manage'],
        ['name' => 'Locked Users','page' => '/admin/users/locked'],
        ['name' => 'Activity Logs','page' => '/admin/users/activity'],
        ['name' => 'Balance Mutation','page' => '/admin/users/mutation'],
        ['name' => 'Transfer History','page' => '/admin/users/transfer'],
    ]
]);
ulhead('');

li('Provider','feather icon-cpu','/admin/provider/');
ul([
    'name' => 'Pulsa PPOB',
    'icon' => 'feather icon-cloud',
    'content' => [
        ['name' => 'Transaction','page' => '/admin/pulsa-ppob/transaction'],
        ['name' => 'Category','page' => '/admin/pulsa-ppob/category'],
        ['name' => 'Service','page' => '/admin/pulsa-ppob/service'],
        ['name' => 'Report','page' => '/admin/pulsa-ppob/report'],
        ['name' => 'Point','page' => '/admin/pulsa-ppob/point'],
    ]
]);
ul([
    'name' => 'Game Feature',
    'icon' => 'feather icon-cloud',
    'content' => [
        ['name' => 'Transaction','page' => '/admin/game-feature/transaction'],
        ['name' => 'Category','page' => '/admin/game-feature/category'],
        ['name' => 'Service','page' => '/admin/game-feature/service'],
        ['name' => 'Report','page' => '/admin/game-feature/report'],
        ['name' => 'Point','page' => '/admin/game-feature/point'],
    ]
]);
ul([
    'name' => 'Social Media',
    'icon' => 'feather icon-cloud',
    'content' => [
        ['name' => 'Transaction','page' => '/admin/social-media/transaction'],
        ['name' => 'Category','page' => '/admin/social-media/category'],
        ['name' => 'Service','page' => '/admin/social-media/service'],
        ['name' => 'Report','page' => '/admin/social-media/report'],
        ['name' => 'Point','page' => '/admin/social-media/point'],
    ]
]);
ul([
    'name' => 'Laporan keuangan',
    'icon' => 'feather icon-file-text',
    'content' => [
        ['name' => 'Penjualan','page' => '/admin/report/sales'],
        ['name' => 'keuntungan','page' => '/admin/report/profit'],
        ['name' => 'Deposit','page' => '/admin/report/deposit'],
        ['name' => 'Ringkasan','page' => '/admin/report/summary'],
    ]
]);
ulhead(' <span style="position: relative; top: 42px; left: 130px; z-index: 100; background-color: #e90036;" class="badge badge-glow ml-auto mr-2">'.$jumlahPesan.'</span>');
li('Tiket Bantuan','mdi mdi-comment-multiple-outline','/admin/tiket/index');
ulhead('');

ul([
    'name' => 'Deposit',
    'icon' => 'feather icon-credit-card',
    'content' => [
        ['name' => 'Manage','page' => '/admin/deposit/manage'],
        ['name' => 'Voucher','page' => '/admin/deposit/voucher'],
        ['name' => 'Method','page' => '/admin/deposit/method'],
        ['name' => 'Tripay','page' => '/admin/config/tripay'],
    ]
]);
ul([
    'name' => 'Configuration',
    'icon' => 'feather icon-settings',
    'content' => [
        ['name' => 'Website','page' => '/admin/config/website'],
        ['name' => 'Firebase','page' => '/admin/config/firebase'],
        ['name' => 'SMTP Mailer','page' => '/admin/config/smtp'],
        ['name' => 'Social Media','page' => '/admin/config/social'],
        ['name' => 'Input Rekomendasi','page' => '/admin/input-rekomendasi'],
        ['name' => 'Tahan Saldo','page' => '/admin/config/hold'],
        ['name' => 'Mengatur Keuntungan','page' => '/admin/config/propit'],
        ['name' => 'Web Pages','page' => '/admin/config/pages'],
        ['name' => 'Wapisender','page' => '/admin/config/wapisender-setting'],
        ['name' => 'atur Yang lain','page' => '/admin/config/others'],
        

    ]
]);
ul([
    'name' => 'Server',
    'icon' => 'feather icon-box',
    'content' => [
       #['name' => 'Status & Refund Act.','page' => '/admin/server/auto-status-and-refund'],
        ['name' => 'Error Log','page' => '/admin/server/error-log'],
    ]
]);
ul([
    'name' => 'Others',
    'icon' => 'feather icon-list',
    'content' => [
        ['name' => 'News & Info','page' => '/admin/others/news/'],
        ['name' => 'Slide Image','page' => '/admin/others/banner/'],
        ['name' => 'General Quest','page' => '/admin/others/faq/'],
    ]
]);
//li('Transaction Notifier','feather icon-archive','/admin/addon/transaction-notifier');
?>