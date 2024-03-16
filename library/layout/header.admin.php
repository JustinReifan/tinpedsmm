<!DOCTYPE html>
<? $InAdminPage = true; if(!isset($sess_username)) die; ?>
<html class="loading" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta content="<?= $_CONFIG['description']; ?>" name="description">
        <meta content="<?= $_CONFIG['keyword']; ?>" name="keyword">
        <meta name="author" content="">
        
        <meta name="robots" content="<?= $_META['robots'] ?>">
        <meta name="revisit-after" content="<?= $_META['revisit'] ?>">
        <meta name="msvalidate.01" content="<?= $_META['bing_site'] ?>">
        <meta name="google-site-verification" content="<?= $_META['google_site'] ?>">
        
        <meta name="Geo.Placename" content="<?= $_META['geo_placename'] ?>">
        <meta name="Geo.Country" content="<?= $_META['geo_country'] ?>">
        
        <meta property="og:title" content="<?= $_CONFIG['title'] ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?= base_url() ?>">
        <meta property="og:image" content="<?= $_CONFIG['banner'] ?>">
        <meta property="og:image:type" content="image/png">
        <meta property="og:description" content="<?= $_CONFIG['description'] ?>">
        <meta property="og:site_name" content="<?= $_CONFIG['title'] ?>">
        <meta property="og:locale" content="id_ID">
        <meta property="fb:pages" content="291448691554058">
        <meta property="fb:admins" content="100022982940138">
        <meta property="twitter:card" content="Summary">
        <meta property="twitter:url" content="<?= base_url() ?>">
        <meta property="twitter:title" content="<?= $_CONFIG['title'] ?>">
        <meta property="twitter:image" content="<?= $_CONFIG['banner'] ?>">
        <meta property="twitter:creator" content="">
        
        <meta name="apple-mobile-web-app-title" content="<?= $_CONFIG['title']; ?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">

        <title><?= $_CONFIG['title']; ?></title>
        <link rel="apple-touch-icon" href="<?= $_CONFIG['icon']; ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= $_CONFIG['icon']; ?>">
        <link href="<?= assets('fonts/cssed62.css?family=Montserrat:300,400,500,600') ?>" rel="stylesheet">
        
        <!-- Custom Meta -->
        <meta name="DeviceType" content="<?= $device ?>">
        <meta name="UserAgent" content="<?= $user_agent ?>">
        <meta name="IpAddress" content="<?= client_ip() ?>">
        <meta name="Rating" content="General">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.7.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/vendors.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/materializeicon/material-icons.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/charts/apexcharts.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/extensions/tether-theme-arrows.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/extensions/tether.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/extensions/shepherd-theme-default.css') ?>">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="<?= assets('css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/bootstrap-extended.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/colors.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/components.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/themes/dark-layout.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/themes/semi-dark-layout.min.css') ?>">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="<?= assets('css/core/menu/menu-types/vertical-menu.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/core/colors/palette-gradient.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/pages/dashboard-analytics.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/pages/card-analytics.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/pages/authentication.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/pages/app-ecommerce-shop.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('css/pages/faq.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/documentation.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/ui/prism.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= assets('vendors/css/ui/prism-treeview.css') ?>">
        <!-- END: Page CSS-->

        <!-- mode dark -->
         <link rel="stylesheet" href="<?= assets('css/dark-mode.css') ?>">
        <!-- end mode dark -->

        <!-- third party css -->
        <link href="<?= assets('libs/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= assets('libs/datatables/responsive.bootstrap4.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= assets('libs/datatables/buttons.bootstrap4.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= assets('libs/datatables/select.bootstrap4.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= assets('libs/magnific-popup/magnific-popup.css') ?>" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" type="text/css">
        <!-- third party css end -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- BEGIN: Custom CSS & JS -->
        <link rel="stylesheet" type="text/css" href="<?= assets('css/style.css') ?>">
        <style type="text/css">
<? require _DIR_('library/custom.min'); ?>
        </style>
<? require _DIR_('library/custom.js'); ?>
        <!-- END: Custom CSS & JS -->

    </head>
    <body class="vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="content-right-sidebar">
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
            <div class="navbar-wrapper">
                <div class="navbar-container content">
                    <div class="navbar-collapse" id="navbar-mobile">
                        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                            <ul class="nav navbar-nav">
                                <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                            </ul>
                        </div>
                        <ul class="nav navbar-nav float-right">
                             <li class="nav-item mr-1" style="margin-top:6px;">
                                 <input type="checkbox" id="darkSwitch"/>
                        		<label class="form-dark-mode" for="darkSwitch">
                        			<svg version="1.1" class="sun" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        	 viewBox="0 0 496 496" style="enable-background:new 0 0 496 496;" xml:space="preserve">
                        
                        			<rect x="152.994" y="58.921" transform="matrix(0.3827 0.9239 -0.9239 0.3827 168.6176 -118.5145)" width="40.001" height="16"/>
                        			<rect x="46.9" y="164.979" transform="matrix(0.9239 0.3827 -0.3827 0.9239 71.29 -12.4346)" width="40.001" height="16"/>
                        			<rect x="46.947" y="315.048" transform="matrix(0.9239 -0.3827 0.3827 0.9239 -118.531 50.2116)" width="40.001" height="16"/>
                        			
                        				<rect x="164.966" y="409.112" transform="matrix(-0.9238 -0.3828 0.3828 -0.9238 168.4872 891.7491)" width="16" height="39.999"/>
                        			
                        				<rect x="303.031" y="421.036" transform="matrix(-0.3827 -0.9239 0.9239 -0.3827 50.2758 891.6655)" width="40.001" height="16"/>
                        			
                        				<rect x="409.088" y="315.018" transform="matrix(-0.9239 -0.3827 0.3827 -0.9239 701.898 785.6559)" width="40.001" height="16"/>
                        			
                        				<rect x="409.054" y="165.011" transform="matrix(-0.9239 0.3827 -0.3827 -0.9239 891.6585 168.6574)" width="40.001" height="16"/>
                        			<rect x="315.001" y="46.895" transform="matrix(0.9238 0.3828 -0.3828 0.9238 50.212 -118.5529)" width="16" height="39.999"/>
                        			<path d="M248,88c-88.224,0-160,71.776-160,160s71.776,160,160,160s160-71.776,160-160S336.224,88,248,88z M248,392
                        				c-79.4,0-144-64.6-144-144s64.6-144,144-144s144,64.6,144,144S327.4,392,248,392z"/>
                        			<rect x="240" width="16" height="72"/>
                        			<rect x="62.097" y="90.096" transform="matrix(0.7071 0.7071 -0.7071 0.7071 98.0963 -40.6334)" width="71.999" height="16"/>
                        			<rect y="240" width="72" height="16"/>
                        			
                        				<rect x="90.091" y="361.915" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -113.9157 748.643)" width="16" height="71.999"/>
                        			<rect x="240" y="424" width="16" height="72"/>
                        			
                        				<rect x="361.881" y="389.915" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 397.8562 960.6281)" width="71.999" height="16"/>
                        			<rect x="424" y="240" width="72" height="16"/>
                        			<rect x="389.911" y="62.091" transform="matrix(0.7071 0.7071 -0.7071 0.7071 185.9067 -252.6357)" width="16" height="71.999"/>
                        </svg>
                             <svg version="1.1" class="moon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 49.739 49.739" style="enable-background:new 0 0 49.739 49.739;" xml:space="preserve">
                             <path d="M25.068,48.889c-9.173,0-18.017-5.06-22.396-13.804C-3.373,23.008,1.164,8.467,13.003,1.979l2.061-1.129l-0.615,2.268
                               c-1.479,5.459-0.899,11.25,1.633,16.306c2.75,5.493,7.476,9.587,13.305,11.526c5.831,1.939,12.065,1.492,17.559-1.258v0
                               c0.25-0.125,0.492-0.258,0.734-0.391l2.061-1.13l-0.585,2.252c-1.863,6.873-6.577,12.639-12.933,15.822
                               C32.639,48.039,28.825,48.888,25.068,48.889z M12.002,4.936c-9.413,6.428-12.756,18.837-7.54,29.253
                               c5.678,11.34,19.522,15.945,30.864,10.268c5.154-2.582,9.136-7.012,11.181-12.357c-5.632,2.427-11.882,2.702-17.752,0.748
                               c-6.337-2.108-11.473-6.557-14.463-12.528C11.899,15.541,11.11,10.16,12.002,4.936z"/></svg>
                        		</label>
                                 
                                 
                                 	
                            </li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                            <li class="dropdown dropdown-notification nav-item">
                                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                    <i class="ficon feather icon-bell"></i>
                                    <!--<span class="badge badge-pill badge-primary badge-up">5</span>-->
                                </a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                    <li class="dropdown-menu-header">
                                        <div class="dropdown-header m-0 p-2">
                                            <h3 class="white">Notifications</h3><span class="notification-title">App Notifications</span>
                                        </div>
                                    </li>
                                    <li class="scrollable-container media-list">
                                        <?php
                                        $LogSearch = $call->query("SELECT * FROM logs WHERE user = '$sess_username' ORDER BY id DESC LIMIT 5");
                                        while($RowLog = $LogSearch->fetch_assoc()) {
                                            $RowLogIcon = 'feather icon-hash';
                                            if($RowLog['type'] == 'register') $RowLogIcon = 'feather icon-user-check';
                                            if($RowLog['type'] == 'login') $RowLogIcon = 'feather icon-log-in';
                                            if($RowLog['type'] == 'topup') $RowLogIcon = 'feather icon-credit-card';
                                            if($RowLog['type'] == 'order') $RowLogIcon = 'feather icon-shopping-cart';
                                            if($RowLog['type'] == 'logout') $RowLogIcon = 'feather icon-log-out';
                                        ?>
                                        <a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="<?= $RowLogIcon.' font-medium-5 '.$RowLog['color'] ?>"></i></div>
                                                <div class="media-body">
                                                    <h6 class="<?= $RowLog['color'] ?> media-heading"><?= $RowLog['text'] ?></h6>
                                                    <small class="notification-text"><?= $RowLog['ip'].' - '.$RowLog['loc'] ?></small>
                                                </div>
                                                <small>
                                                    <time class="media-meta" datetime="<?= str_replace(' ','T',$RowLog['date']).'+07:00' ?>">
                                                        <?= timeAgo($RowLog['date']) ?>
                                                    </time>
                                                </small>
                                            </div>
                                        </a>
                                        <? } ?>
                                    </li>
                                    <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="<?= base_url('account/activity') ?>">Read all notifications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <div class="user-nav d-sm-flex d-none">
                                        <span class="user-name text-bold-600"><?//= $data_user['username'] ?></span>
                                        <span class="user-status"><?//= 'Active' ?></span>
                                    </div>
                                    <span><img class="round" src="<?= $avatar ?>" alt="avatar" height="40" width="40"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?= base_url('account/profile') ?>"><i class="feather icon-user"></i> Edit Profile</a>
                                    <a class="dropdown-item" href="<?= base_url('account/notification') ?>"><i class="feather icon-bell"></i> Notifications</a>
                                    <a class="dropdown-item" href="<?= base_url('account/signin-access') ?>"><i class="feather icon-layers"></i> Sign Access</a>
                                    <a class="dropdown-item" href="<?= base_url('account/mutation') ?>"><i class="feather icon-mail"></i> Mutations</a>
                                    <a class="dropdown-item" href="<?= base_url('account/activity') ?>"><i class="feather icon-check-square"></i> Log</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="feather icon-power"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url() ?>">
                            <div class=""></div>
                            <h2 class="brand-text mb-0"><?= $_CONFIG['navbar']; ?></h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
                </ul>
            </div>
            
                    <?php $getPesan = $call->query("SELECT * FROM tiket WHERE status = 'Pending'"); ?>
                    <?php  if (mysqli_num_rows($getPesan) == 0) {
                    $jumlahPesan = '';
                    } else{
                     $jumlahPesan = mysqli_num_rows($getPesan);
                    }?>
                                        
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <?php require 'sidebar.admin.php'; ?>
                </ul>
            </div>
        </div>
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <section id="dashboard-analytics">
<? require _DIR_('library/session/result'); ?>
