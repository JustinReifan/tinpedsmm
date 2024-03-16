<!DOCTYPE html>
<?php require '../connect.php';
require _DIR_('library/session/auth');
require _DIR_('library/session/session');
$total_pengguna = mysqli_num_rows($call->query("SELECT * FROM users"));
?>
<html lang="en">
<head>
    <script>
    (function(w, d, s, l, i) { w[l] = w[l] || []; w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' }); var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f); })(window, document, 'script', 'dataLayer', 'GTM-5BJSDJ8');
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta content="<?= $_CONFIG['description']; ?>" name="description">
        <meta content="<?= $_CONFIG['keyword']; ?>" name="keyword">
        <meta name="author" content="<?= $_CONFIG['title'] ?>">
        <meta name="robots" content="<?= $_META['robots'] ?>">
        <meta name="revisit-after" content="<?= $_META['revisit'] ?>">
        <meta name="msvalidate.01" content="<?= $_META['bing_site'] ?>">
        <meta name="google-site-verification" content="<?= $_META['google_site'] ?>">
        <meta name="ahrefs-site-verification" content="<?= $_META['ahrefs'] ?>">
        <meta name="Geo.Placename" content="<?= $_META['geo_placename'] ?>">
        <meta name="Geo.Country" content="<?= $_META['geo_country'] ?>">
        <meta name="google" content="notranslate">
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
        <meta property="twitter:creator" content="<?= $_CONFIG['title'] ?>">
        <meta name="apple-mobile-web-app-title" content="<?= $_CONFIG['title']; ?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <title><?= $_CONFIG['title']; ?></title>
        <link rel="apple-touch-icon" href="<?= $_CONFIG['icon']; ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= $_CONFIG['icon']; ?>">
        <link href="<?= assets('fonts/cssed62.css?family=Montserrat:300,400,500,600') ?>" rel="stylesheet">
        <link rel="canonical" href="<?= base_url() ?>">
        <meta name="DeviceType" content="<?= $device ?>">
        <meta name="UserAgent" content="<?= $user_agent ?>">
        <meta name="IpAddress" content="<?= client_ip() ?>">
        <meta name="Rating" content="General">
    <!--
        CSS Files
        ================================================== -->
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/theme-color.css" class="color-scheme">
    <link rel="stylesheet" href="css/main.css">
    
    <!-- Modernizer Script for old Browsers -->
    <script src='js/modernizr-2.6.2.min.js'></script>
	<script src="js/iconify.min.js"></script>
    <script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script async custom-element="amp-script" src="https://cdn.ampproject.org/v0/amp-script-0.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;display=swap" rel="stylesheet">
    
    <!--tiktok pixel-->
    <script>
        !function (w, d, t) {
        w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
        ttq.load('CIFBJPRC77U2H86MLKBG');
        ttq.page();
        }(window, document, 'ttq');
    </script>
</head>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [{
            "@type": "Question",
            "name": "Apa Itu <?= $_CONFIG['title'] ?> ?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "<?= $_CONFIG['title'] ?> merupakan aplikasi pembayaran digital yang menyediakan layanan top up game paling murah yang sudah pasti terpercaya dan berkualitas terbaik yang memiliki proses secepat kilat hingga kalian dapat menikmati semua layanan yang tersedia, tanpa harus menunggu lama untuk top up game paling murah di Indonesia."
            }
        }, {
            "@type": "Question",
            "name": "Apa kegunaan deposit di <?= $_CONFIG['title'] ?>?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Deposit dalam <?= $_CONFIG['title'] ?> memiliki banyak kegunaan karena sebagai Pusat SMM PANEL indonesia, maka sudah pasti dapat memberikan kenyamanan dan kemudahan untuk melakukan top up game termurah yang tersedia dalam <?= $_CONFIG['title'] ?>, hal ini bisa anda nikmati setelah melakukukan deposit di <?= $_CONFIG['title'] ?> Pusat SMM PANEL."
            }
        }, {
            "@type": "Question",
            "name": "Cara jadi reseller di <?= $_CONFIG['title'] ?>?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Cukup mudah tentunya kamu harus menjadi mitra reseller di <?= $_CONFIG['title'] ?> terlebih dahulu, tapi ada syarat dan ketentuan yang harus kamu penuhi untuk bisa menjadi Mitra reseller di <?= $_CONFIG['title'] ?>."
            }
        }, {
            "@type": "Question",
            "name": "Bagaimana cara membuat pesanan?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Untuk membuat pesanan sangatlah mudah, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman pemesanan dengan mengklik menu yang sudah tersedia. Selain itu Anda juga dapat melakukan pemesanan melalui request API."
            }
        }, {
            "@type": "Question",
            "name": "Apa itu Pusat SMM PANEL Indonesia?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Website yang menyediakan berbagai kebutuhan seluruh reseller h2h dengan penawaran menguntungkan setiap harinya. Bahkan, Pusat SMM PANEL indonesia bisa menjadi tempat yang tepat untuk menikmati profit besar."
            }
        }, {
            "@type": "Question",
            "name": "Apa Syarat jadi reseller di <?= $_CONFIG['title'] ?> ?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Akun terverifikasi oleh sistem <?= $_CONFIG['title'] ?>. Anda dapat melakukan verifikasi dalam menu profile, selanjutnya masukan data pribadi kamu. Kemudian, masukkan foto KTP dan foto Selfi KTP."
            }
        }, {
            "@type": "Question",
            "name": "Manfaat Gunakan Layanan di <?= $_CONFIG['title'] ?> ?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Memperluas Jangkauan Customer Anda hingga menjadi Pelanggan Setia Store, Meningkatkan Presentase Konsumen Produk dalam store hingga populer di kalangan target pasaran anda."
            }
        }, {
            "@type": "Question",
            "name": "Apa itu pusat top up game h2h?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Terdapat banyak platform pusat top up game h2h yang menjual voucher game online dan layanan top up game murah yang banyak di minati reseller H2H, tapi untuk menjadi reseller top up game murah dengan harga di bawah pasaran. Anda harus menemukan pusat reseller H2H, contohnya <?= $_CONFIG['title'] ?> yang sudah menjadi Pusat SMM PANEL di Indonesia."
            }
        }]
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "<?= base_url() ?>",
        "logo": "<?= base_url('home/img/logo.png') ?>"
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "EmployerAggregateRating",
        "itemReviewed": {
            "@type": "Organization",
            "name": "<?= $_CONFIG['title'] ?> | Pusat SMM PANEL Indonesia",
            "sameAs": "<?= base_url() ?>"
        },
        "ratingValue": "91",
        "bestRating": "100",
        "worstRating": "1",
        "ratingCount": "10561"
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
                "@type": "Course",
                "url": "<?= base_url('page/produk') ?>",
                "name": "<?= $_CONFIG['title'] ?> Page Produk",
                "description": "Daftar harga terlengkap <?= $_CONFIG['title'] ?>.",
                "provider": {
                    "@type": "Organization",
                    "name": "Produk berkualitas dan termurah.",
                    "sameAs": "<?= base_url('page/produk') ?>"
                }
            }
        }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
                "@type": "Course",
                "url": "<?= base_url('page/terms-of-service') ?>",
                "name": "<?= $_CONFIG['title'] ?> Page Terms of Service",
                "description": "Informasi untuk seluruh pengguna <?= $_CONFIG['title'] ?>",
                "provider": {
                    "@type": "Organization",
                    "name": "Ketentuan layanan <?= $_CONFIG['title'] ?>.",
                    "sameAs": "<?= base_url('page/terms-of-service') ?>"
                }
            }
        }, {
            "@type": "ListItem",
            "position": 3,
            "item": {
                "@type": "Course",
                "url": "<?= base_url('page/general-questions') ?>",
                "name": "<?= $_CONFIG['title'] ?> Page Question",
                "description": "Pertanyaan yang sering ditanyakan pengguna.",
                "provider": {
                    "@type": "Organization",
                    "name": "Berikut pertanyaan umum.",
                    "sameAs": "<?= base_url('page/general-questions') ?>"
                }
            }
        }]
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "<?= base_url() ?>",
        "potentialAction": [{
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "<?= base_url('search?q={search_term_string}') ?>"
            },
            "query-input": "required name=search_term_string"
        }, {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "android-app://com.domain.com/https/domain.com/search/?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
        }]
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "<?= $_CONFIG['title'] ?> | Pusat SMM PANEL Indonesia",
        "alternateName": "<?= $_CONFIG['title'] ?>",
        "url": "<?= base_url('home') ?>",
        "logo": "",
        "sameAs": "<?= base_url('home') ?>"
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "ImageObject",
        "contentUrl": "https://pusat-reseller.com/assets/slide/6391b9b7a5ab7.jpg",
        "license": "<?= base_url('home') ?>",
        "acquireLicensePage": "https://pusat-reseller.com/assets/slide/6391b9b7a5ab7.jpg",
        "creditText": "<?= $_CONFIG['title'] ?>",
        "creator": {
            "@type": "Person",
            "name": "<?= $_CONFIG['title'] ?> | Pusat SMM PANEL Indonesia"
        },
        "copyrightNotice": "<?= $_CONFIG['title'] ?>"
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?= base_url('artikel') ?>"
        },
        "headline": "<?= $_CONFIG['title'] ?> | Pusat SMM PANEL Indonesia",
        "description": "<?= $_CONFIG['title'] ?> merupakan aplikasi pembayaran digital yang menyediakan layanan top up game paling murah yang sudah pasti terpercaya dan berkualitas terbaik yang memiliki proses secepat kilat hingga kalian dapat menikmati semua layanan yang tersedia.",
        "image": ["https://pusat-reseller.com/assets/slide/6391b9b7a5ab7.jpg"],
        "author": {
            "@type": "Organization",
            "name": "<?= $_CONFIG['title'] ?>",
            "url": "<?= base_url('artikel') ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?= $_CONFIG['title'] ?> | Pusat SMM PANEL Indonesia",
            "logo": {
                "@type": "ImageObject",
                "url": "https://pusat-reseller.com/assets/slide/63908bd0b3ae3.jpg"
            }
        },
        "datePublished": "2022-01-13T05:42:29+00:00",
        "dateModified": "2022-01-13T05:42:29+00:00"
    }
</script>

<style>
:root { --color-desc: white; } .desc { color: var(--color-desc); font-size: 20px; } .title-desc{ color: var(--color-desc); font-size: 29px; text-transform: uppercase; font-weight: 600; } @media only screen and (max-width: 600px) { .title-desc{ color: var(--color-desc); font-size: 22px; text-transform: uppercase; font-weight: 600; } .desc { color: var(--color-desc); font-size: 15px; } } @media only screen and (min-width: 480px) and (max-width: 767px) { .section-title h2 { font-size: 30px; } } 
   .left { text-align: left;} .right { text-align: right;} .center { text-align: center;} .justify { text-align: justify;} .mdi-36px { font-size: 39px; margin-right:10px; } .divider { display: table; font-size: 20px; text-align: center; width: 50%; /* divider width */ margin: 5px auto; /* spacing above/below */ } .divider span { display: table-cell; position: relative; } .divider span:first-child, .divider span:last-child { width: 50%; top: 13px; /* adjust vertical align */ -moz-background-size: 100% 2px; /* line width */ background-size: 100% 2px; /* line width */ background-position: 0 0, 0 100%; background-repeat: no-repeat; } .divider span:first-child { /* color changes in here */ background-image: -webkit-gradient(linear, 0 0, 0 100%, from(transparent), to(#fff)); background-image: -webkit-linear-gradient(180deg, transparent, #fff); background-image: -moz-linear-gradient(180deg, transparent, #fff); background-image: -o-linear-gradient(180deg, transparent, #fff); background-image: linear-gradient(90deg, transparent, #fff); } .divider span:nth-child(2) { color: #fff; padding: 0px 5px; width: auto; white-space: nowrap; } .divider span:last-child { /* color changes in here */ background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(transparent)); background-image: -webkit-linear-gradient(180deg, #fff, transparent); background-image: -moz-linear-gradient(180deg, #fff, transparent); background-image: -o-linear-gradient(180deg, #fff, transparent); background-image: linear-gradient(90deg, #fff, transparent); } .beranda { display: table; font-size: 20px; text-align: center; width: 50%; /* divider width */ margin: 5px auto; /* spacing above/below */ } .beranda span { display: table-cell; position: relative; } .beranda span:first-child, .beranda span:last-child { width: 50%; top: 13px; /* adjust vertical align */ -moz-background-size: 100% 2px; /* line width */ background-size: 100% 2px; /* line width */ background-position: 0 0, 0 100%; background-repeat: no-repeat; } .beranda span:first-child { /* color changes in here */ background-image: -webkit-gradient(linear, 0 0, 0 100%, from(transparent), to(#8089ff)); background-image: -webkit-linear-gradient(180deg, transparent, #8089ff); background-image: -moz-linear-gradient(180deg, transparent, #8089ff); background-image: -o-linear-gradient(180deg, transparent, #8089ff); background-image: linear-gradient(90deg, transparent, #8089ff); } .beranda span:nth-child(2) { color: #8089ff; padding: 0px 5px; width: auto; white-space: nowrap; } .beranda span:last-child { /* color changes in here */ background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#8089ff), to(transparent)); background-image: -webkit-linear-gradient(180deg, #8089ff, transparent); background-image: -moz-linear-gradient(180deg, #8089ff, transparent); background-image: -o-linear-gradient(180deg, #8089ff, transparent); background-image: linear-gradient(90deg, #8089ff, transparent); }
.clip-fo {
    background-color: #f5f5f5 !important;
    display: flex;
    padding: 0;
    margin-top: -39px;
    width: 100%;
    height: 40px;
    clip-path: polygon(0 23%, 6% 72%, 12% 47%, 18% 70%, 24% 51%, 32% 80%, 38% 47%, 44% 80%, 50% 49%, 56% 70%, 60% 86%, 66% 42%, 72% 65%, 78% 38%, 84% 64%, 90% 17%, 96% 20%, 100% 1%, 100% calc(100% + 1px), 0 calc(100% + 1px));
    -webkit-clip-path: polygon(0 23%, 6% 72%, 12% 47%, 18% 70%, 24% 51%, 32% 80%, 38% 47%, 44% 80%, 50% 49%, 56% 70%, 60% 86%, 66% 42%, 72% 65%, 78% 38%, 84% 64%, 90% 17%, 96% 20%, 100% 1%, 100% calc(100% + 1px), 0 calc(100% + 1px));
}
</style>
<body oncontextmenu="return false">
    <!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BJSDJ8" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
    <div class="color-switcher">
      <div class="toggle"><i class="bi bi-sliders2-vertical"></i></div>
      <div class="color">
        <a class="current" style="background: linear-gradient(-45deg, #4e54c8, #8089ff);" href="#" data-color="color"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #5f2c82, #ca4966);" href="#" data-color="color01"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #ff4e50, #f9d423);" href="#" data-color="color02"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #333399, #ff00cc);" href="#" data-color="color03"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #233b88, #c10f41);" href="#" data-color="color04"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #021b79, #0575e6);" href="#" data-color="color05"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #b31217, #e52d27);" href="#" data-color="color06"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #c21500, #ffc500);" href="#" data-color="color07"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #6a11cb, #2575fc);" href="#" data-color="color08"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #9f44d3, #e2b0ff);" href="#" data-color="color09"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #49C628, #70F570);" href="#" data-color="color10"></a>
      </div>
      <div class="color">
        <a style="background: linear-gradient(-45deg, #BB4E75, #FF9D6C);" href="#" data-color="color11"></a>
      </div>
    </div><!--Color Switcher End-->
    <header id="home" class="home bg-image brush">
        <div id="bg-shader" data-ambient-color="#8089ff" data-diffuse-color="#4e54c8"></div>
            <!-- Start Navigation Bar -->
            <nav class="navbar navbar-default nav-sec navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#" title="<?= $_CONFIG['title'] ?>"><img src="img/appnova-logo.png" alt="<?= $_CONFIG['title'] ?>"></a>
                    </div>
                    <!-- / navbar-header -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="#home"><span>Home</span></a></li>
                            <li><a href="#features"><span>Features</span></a></li>
                            <li><a href="#testimonials"><span>Testimonials</span></a></li>
                            <li><a href="#pricing-table"><span>Pricing</span></a></li>
                            <li><a href="#contact"><span>Contact</span></a></li>
                        </ul>
                    </div>
                    <!-- end nav-collapse -->
                </div>
                <!-- end container -->
            </nav>
            <!-- End Navigation Bar -->
            <div class="container">
                <div class="row">
                    <!-- Start Text Header -->
                    <div class="col-md-7 col-sm-12">
                        <div class="header-inner">
                            <div class="header-content">
                                <h1 class="home-title wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s"><span><?= $_CONFIG['title'] ?></span></h1>
                                <br>
                                <h2 class="title-desc wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">Pusat SMM PANEL Indonesia</h2>
                                <span class="desc wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s"><?= $_CONFIG['description']; ?></span>
                                <div class="bttn-head wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                                    <a rel="canonical" href="<?= base_url('auth/login'); ?>" class="bttn-appnova-gradient">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>LOGIN MEMBER</span>
                                    </a>
                                    <a rel="canonical" href="<?= base_url('auth/register') ?>" class="bttn-appnova-gradient">
                                        <i class="bi bi-person-plus-fill"></i>
                                        <span>DAFTAR MEMBER</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Text Header -->
                    <!-- Start Photo Here -->
                    <div class="col-md-5 col-sm-12 hidden-sm hidden-xs">
                        <div class="photo-header">
                            <img src="<?= base_url('home/img/payment-hero-image.webp') ?>" rel="nofollow" alt="<?= $_CONFIG['title'] ?>" class="img-responsive wow fadeInRight" style="animation: up-down 2s ease-in-out infinite alternate-reverse both">
                        </div>
                    </div>
                    <!-- End Photo Here -->
                </div>
            </div>
            <!-- End Container -->
    </header>
    <!-- End Header -->
<style>
html { -webkit-font-smoothing: antialiased!important; -moz-osx-font-smoothing: grayscale!important; -ms-font-smoothing: antialiased!important; } .md-stepper-horizontal { display:table; width:100%; margin:0 auto; } .md-stepper-horizontal .md-step { display:table-cell; position:relative; padding:15px; } .md-stepper-horizontal .md-step:hover, .md-stepper-horizontal .md-step:active { } .md-stepper-horizontal .md-step:active { border-radius: 15% / 75%; } .md-stepper-horizontal .md-step:first-child .md-step-bar-left, .md-stepper-horizontal .md-step:last-child .md-step-bar-right { display:none; } .md-stepper-horizontal .md-step .md-step-circle { width:40px; height:40px; margin:0 auto; background-color:#999999; border-radius: 10%; text-align: center; line-height:40px; font-size: 17px; font-weight: 600; color:#FFFFFF; } .md-stepper-horizontal.green .md-step.active .md-step-circle { background-color:#00AE4D; } .md-stepper-horizontal.orange .md-step.active .md-step-circle { background-color:#F96302; } .md-stepper-horizontal .md-step.active .md-step-circle { background-color: #8089ff; } .md-stepper-horizontal .md-step.done .md-step-circle:before { font-family:'FontAwesome'; font-weight:100; content: "\f040"; } .md-stepper-horizontal .md-step.done .md-step-circle *, .md-stepper-horizontal .md-step.editable .md-step-circle * { display:none; } .md-stepper-horizontal .md-step.editable .md-step-circle { -moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); } .md-stepper-horizontal .md-step.editable .md-step-circle:before { font-family:'FontAwesome'; font-weight:100; content: "\f19c"; } .md-stepper-horizontal .md-step.transaksi .md-step-circle * { display:none; } .md-stepper-horizontal .md-step.transaksi .md-step-circle { -moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); } .md-stepper-horizontal .md-step.transaksi .md-step-circle:before { font-family:'FontAwesome'; font-weight:100; content: "\f07a"; } .md-stepper-horizontal .md-step.suksess .md-step-circle * { display:none; } .md-stepper-horizontal .md-step.suksess .md-step-circle { -moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); } .md-stepper-horizontal .md-step.suksess .md-step-circle:before { font-family:'FontAwesome'; font-weight:100; content: "\f03a"; } .md-stepper-horizontal .md-step .md-step-title { margin-top:16px; font-size:14px; font-weight:500; } .md-stepper-horizontal .md-step .md-step-title, .md-stepper-horizontal .md-step .md-step-optional { text-align: center; color:#777; } .md-stepper-horizontal .md-step.active .md-step-title { font-weight: 500; color:rgba(0,0,0,.87); } .md-stepper-horizontal .md-step.active.done .md-step-title, .md-stepper-horizontal .md-step.active.editable .md-step-title { font-weight:500; } .md-stepper-horizontal .md-step .md-step-optional { font-size:10px; } .md-stepper-horizontal .md-step.active .md-step-optional { color:rgba(0,0,0,.54); } .md-stepper-horizontal .md-step .md-step-bar-left, .md-stepper-horizontal .md-step .md-step-bar-right { position:absolute; top:36px; height:1px; border-top:1px solid #DDDDDD; } .md-stepper-horizontal .md-step .md-step-bar-right { right:0; left:50%; margin-left:20px; } .md-stepper-horizontal .md-step .md-step-bar-left { left:0; right:50%; margin-right:20px; }
hr.dashed {
    border-top: 1px dashed #999;
}
.animated {
  animation: up-down 2s ease-in-out infinite alternate-reverse both;
}
</style>
    <section id="features" class="features pdd100">
    <div class="container">
        <!-- Start Section Title -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h4 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Beranda</h4>
                    <h2 class="fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">3 Langkah Mudah</h2>
                </div>
            </div>
            <div class="md-stepper-horizontal primary">
                <div class="md-step active done">
                    <div class="md-step-circle">
                        <span>1</span>
                    </div>
                    <div class="md-step-title">Daftar</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step active editable">
                    <div class="md-step-circle">
                        <span>2</span>
                    </div>
                    <div class="md-step-title">Deposit</div>
                    <div class="md-step-optional">Optional</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step active transaksi">
                    <div class="md-step-circle">
                        <span>3</span>
                    </div>
                    <div class="md-step-title">Transaksi</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step suksess">
                    <div class="md-step-circle">
                        <span>4</span>
                    </div>
                    <div class="md-step-title">Selesai</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
            </div>
        </div>
        <!-- End Section Title -->
        <!-- Start Features Content -->
        <div class="row">
            <!-- Start Single Feature -->
            <div class="col-md-4">
                <div class="single-feature wow fadeInLeft" data-wow-delay=".2s" data-wow-duration="1s">
                    <div class="pb-2">
                        <img src="img/document.webp" alt="<?= $_CONFIG['title'] ?>" width="20%" class="img-fluid">
                    </div>
                    <div class="feature-text">
                        <h4>Daftar Akun</h4>
                        <p>Pendaftaran gratis tidak di kenakan biaya, silahkan akses ke menu Daftar.</p>
                    </div>
                </div>
            </div>
            <!-- End Single Feature -->
            <!-- Start Single Feature -->
            <div class="col-md-4">
                <div class="single-feature wow fadeInLeft" data-wow-delay=".4s" data-wow-duration="1s">
                    <div class="pb-2">
                        <img src="img/purse.webp"  alt="<?= $_CONFIG['title'] ?>" width="20%" class="img-fluid">
                    </div>
                    <div class="feature-text">
                        <h4>Deposit Saldo</h4>
                        <p>Metode deposit lengkap, tersedia deposit melalui Bank, E-Money, Pulsa Transfer</p>
                    </div>
                </div>
            </div>
            <!-- End Single Feature -->
            <!-- Start Single Feature -->
            <div class="col-md-4">
                <div class="single-feature mgbtt0 wow fadeInLeft" data-wow-delay=".6s" data-wow-duration="1s">
                    <div class="pb-2">
                        <img src="img/online-payment.webp"  alt="<?= $_CONFIG['title'] ?>" width="20%" class="img-fluid">
                    </div>
                    <div class="feature-text">
                        <h4>Mulai Transaksi</h4>
                        <p>Setelah akun Anda memiliki saldo, Anda dapat melakukan Transaksi.</p>
                    </div>
                </div>
            </div>
            <!-- End Single Feature -->
        </div>
        <!-- End row -->
        <!-- End Features Content -->
    </div>
    <!-- End Container -->
</section>
<!-- End Features -->
    <!--
        Start Timeline Work Section
        ==================================== -->
    <section id="timelineWork" class="timelineWork pdd100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline">
                        <!-- Start Single Item -->
                        <div class="timeline">
                            <span class="timeline-icon"></span>
                            <span class="year"><img src="img/svg-icon-5.webp" height="auto" width="350px" alt="<?= $_CONFIG['title'] ?>" class="img-responsive wow fadeInLeft" data-wow-duration="1s"></span>
                            <div class="timeline-content wow fadeInRight" data-wow-duration="1s">
                                <h3 class="title">Pendaftaran Gratis Dan Mudah</h3>
                                <p class="description">
                                    Pendaftaran gratis tidak di kenakan biaya, setelah mendaftar akun anda langsung aktif dan dapat melakukan deposit.
                                </p>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Start Single Item -->
                        <div class="timeline">
                            <span class="timeline-icon"></span>
                            <span class="year"><img src="img/svg-icon-4.webp" height="auto" width="350px" alt="<?= $_CONFIG['title'] ?>" class="img-responsive wow fadeInRight" data-wow-duration="1s"></span>
                            <div class="timeline-content wow fadeInLeft" data-wow-duration="1s">
                                <h3 class="title">Transaksi Otomatis 24 Jam</h3>
                                <p class="description">
                                    Anda tetap bisa melakukan transaksi di waktu kapan saja selama 24 Jam.
                                </p>
                            </div>
                        </div>
                    </div><!-- end main-timeline -->
                </div><!-- end col-md-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- End timelineWork -->
    <section id="statistics" class="statistics">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <!-- Start Single Statistic -->
                    <div class="col-md-4 wow fadeInLeft" data-wow-delay=".2s" data-wow-duration="1s">
                        <div class="single-statis">
                            <div class="icon-statis">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h3 class="statistic-number"><?php echo $total_pengguna; ?></h3>
                            <h4>Membership</h4>
                            <span>Active</span>
                        </div>
                    </div>
                    <!-- End Single Statistic -->
                    <!-- Start Single Statistic -->
                    <div class="col-md-4 wow fadeInLeft" data-wow-delay=".4s" data-wow-duration="1s">
                        <div class="single-statis">
                            <h3 class="statistic-">1,700K</h3>
                            <div class="icon-statis">
                                <i class="bi bi-cart-check-fill"></i>
                            </div>
                            <h4>Layanan</h4>
                            <span>Transaksi</span>
                        </div>
                    </div>
                    <!-- End Single Statistic -->
                    <!-- Start Single Statistic -->
                    <div class="col-md-4 wow fadeInLeft" data-wow-delay=".6s" data-wow-duration="1s">
                        <div class="single-statis mgbtt0">
                            <h3 class="statistic-">1,4K</h3>
                            <div class="icon-statis">
                                <i class="bi bi-credit-card-fill" width="20" height="20"></i>
                            </div>
                            <h4>Member Deposit</h4>
                            <span>Deposit</span>
                        </div>
                    </div>
                    <!-- End Single Statistic -->
                </div><!-- End row -->
            </div><!-- End Container -->
        </div><!-- End Overlay -->
    </section><!-- End Statistics  -->
    <!--
        End Timeline Work Section
        ==================================== -->
    <!--
        Start Testimonials Section
        ==================================== -->
    <section id="testimonials" class="testimonials pdd100">
        <div class="container">
            <!-- Start Section Title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h4 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Apa kata mereka?</h4>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">Testimonials</h2>
                    </div>
                </div>
            </div>
            <!-- End Section Title -->
            <div class="row">
                <div class="col-md-12 wow fadeInUp" data-aos="zoom-out" data-aos-delay="300">
                    <div class="testimonials-content">
                        <!-- Start testimonials-slider -->
                        <div class="testimonials-slider owl-carousel owl-theme">
                            <!-- Start Single Item -->
                            <div class="item">
                                <div class="single-person">
                                    <div class="personIMG">
                                        <img src="img/testimony/pp-x-f.webp"  alt="<?= $_CONFIG['title'] ?>">
                                        <i class="bi bi-quote"></i>
                                    </div>
                                    <div class="personName">
                                        <h4>Arsila</h4>
                                        <span>PREMIUM</span>
                                    </div>
                                    <div class="personRate">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="personquote">
                                        <p>Memiliki layanan dan fasilitas yang mudah di akses, serta di pahami. Selain itu, tingkat keamanan transaksi data privasi sangat terjaga</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Start Single Item -->
                            <div class="item">
                                <div class="single-person">
                                    <div class="personIMG">
                                        <img src="img/testimony/pp-x-m.webp"  alt="<?= $_CONFIG['title'] ?>">
                                        <i class="bi bi-quote"></i>
                                    </div>
                                    <div class="personName">
                                        <h4>Muhamad Fendy</h4>
                                        <span>BASIC</span>
                                    </div>
                                    <div class="personRate">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="personquote">
                                        <p>Harga sangat merekomendasikan. Saya sangat suka produk dari <?= $_CONFIG['title'] ?> - pusat h2h reseller top up game murah.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Start Single Item -->
                            <div class="item">
                                <div class="single-person">
                                    <div class="personIMG">
                                        <img src="img/testimony/D-XeJznUcAAOoi4.webp"  alt="<?= $_CONFIG['title'] ?>" class="img-fluid">
                                        <i class="bi bi-quote"></i>
                                    </div>
                                    <div class="personName">
                                        <h4>Reree</h4>
                                        <span>BASIC</span>
                                    </div>
                                    <div class="personRate">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="personquote">
                                        <p>Memiliki Harga bikin untung banyak, bahkan saya sebagai reseller web ini bisa mendapatkan profit 2digit perbulan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Start Single Item -->
                            <div class="item">
                                <div class="single-person">
                                    <div class="personIMG">
                                        <img src="img/testimony/IMG_20200428_174503.webp"  alt="<?= $_CONFIG['title'] ?>" class="img-fluid">
                                        <i class="bi bi-quote"></i>
                                    </div>
                                    <div class="personName">
                                        <h4>Nabila Putri</h4>
                                        <span>BASIC</span>
                                    </div>
                                    <div class="personRate">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="personquote">
                                        <p>Rekomendasi banget dan sangat menguntungkan bagi saya, seorang reseller top up game online dan kebutuhan sosial media yang tersedia dalam layanan <?= $_CONFIG['title'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Start Single Item -->
                            <div class="item">
                                <div class="single-person">
                                    <div class="personIMG">
                                        <img src="img/testimony/buyer.jpg"  alt="<?= $_CONFIG['title'] ?>" class="img-fluid">
                                        <i class="bi bi-quote"></i>
                                    </div>
                                    <div class="personName">
                                        <h4>Selvia putri</h4>
                                        <span>PREMIUM</span>
                                    </div>
                                    <div class="personRate">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="personquote">
                                        <p>Rekomendasi  layanan puas admin ramah poko nya rekomendasi banget yok gabung di jamin gabakal nyesel <?= $_CONFIG['title'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                        </div><!-- End testimonials-slider -->
                    </div><!-- end testimonials-content -->
                </div><!-- end col-md-12 -->
                
            </div><!-- end row -->
            <br/>
        </div><!-- end container -->
    </section><!-- end testimonials -->
    <!--
        End Testimonials Section
        ==================================== -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v15.0&appId=269125887854466&autoLogAppEvents=1" nonce="gjXKXJO5"></script>
    <!--
        Start Video Section
        ==================================== -->
    <section id="video-app" class="video-app">
        <div class="overlay pdd100">
            <div class="container">

            </div>
        </div><!-- end overlay -->
    </section><!-- end video-app -->
    <!--
        End Video Section
        ==================================== -->
    <!--
        Start Pricing Table Section
        ==================================== -->
    <section id="pricing-table" class="pricing-table pdd100">
        <div class="container">
            <!-- Start Section Title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h4 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Pilih Paket</h4>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">Daftar Harga</h2>
                    </div>
                </div>
            </div>
            <!-- End Section Title -->
            <!-- Start Pricing Content -->
            <div class="pricing-content">
                <div class="row">
                    <!-- Start Single Item -->
                    <div class="col-md-4 col-sm-6 wow fadeInLeft" data-wow-delay=".2s" data-wow-duration="1s">
                        <div class="single-plan">
                            <div class="head-plan">
                                <h4>BASIC</h4>
                            </div>
                            <div class="body-plan">
                                <div class="price-plan">
                                    <h3><sup>Rp.</sup>0</h3>
                                    <span>Limited</span>
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="feat-plan">
                                    <ul>
                                        <li>UPCOMING</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-plan">
                                <a href="<?= base_url('auth/register') ?>" class="bttn-appnova-gradient">
                                    <span>Daftar now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Start Single Item -->
                    <div class="col-md-4 col-sm-6 wow fadeInLeft" data-wow-delay=".4s" data-wow-duration="1s">
                        <div class="single-plan">
                            <div class="head-plan">
                                <h4>PREMIUM</h4>
                            </div>
                            <div class="body-plan">
                                <div class="price-plan">
                                    <h3><sup>Rp.</sup>200</h3>
                                    <span>Unlimited</span>
                                    <i class="bi bi-layers-fill"></i>
                                </div>
                                <div class="feat-plan">
                                    <ul>
                                        <li>UPGRADE</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-plan">
                                <a href="https://api.whatsapp.com/send?phone=6283164695340" class="bttn-appnova-gradient">
                                    <span>Buy Now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Start Single Item -->
                    <div class="col-md-4 col-sm-6 wow fadeInLeft" data-wow-delay=".6s" data-wow-duration="1s">
                        <div class="single-plan mgbtt0">
                            <div class="head-plan">
                                <h4>SPECIAL / H2H</h4>
                            </div>
                            <div class="body-plan">
                                <div class="price-plan">
                                    <h3><sup>Rp.</sup>300</h3>
                                    <span>Unlimited</span>
                                    <i class="fa fa-rocket"></i>
                                </div>
                                <div class="feat-plan">
                                    <ul>
                                        <li>UPGRADE</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-plan">
                                <a href="https://api.whatsapp.com/send?phone=6283164695340" class="bttn-appnova-gradient">
                                    <span>Buy Now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div><!-- end row -->
            </div>
            <!-- End Pricing Content -->
        </div><!-- end container -->
    </section><!-- end pricing-table -->
    <!--
        End Pricing Table Section
        ==================================== -->
    <!--
        Start Faqs Section
        ==================================== -->
    <section id="faqs" class="faqs pdd100">
        <div class="container">
            <!-- Start Section Title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h4 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Pertanyaan</h4>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">Faqs</h2>
                    </div>
                </div>
            </div>
            <!-- End Section Title -->
            <div class="row">
                <!-- Start Faqs Photo -->
                <div class="col-md-6 wow fadeInLeft" data-wow-duration="1s">
                    <div class="faqs-img">
                        <img src="img/faq-img.webp"  alt="<?= $_CONFIG['title'] ?>" class="img-responsive" style="animation: up-down 2s ease-in-out infinite alternate-reverse both">
                    </div>
                </div>
                <!-- End Faqs Photo -->
                <!-- Start Faqs Text -->
                <div class="col-md-6 wow fadeInRight" data-wow-duration="1s">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- Start Single Item -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Apa itu <?= $_CONFIG['title'] ?>?
                                                </a>
                                            </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <p><?= $_CONFIG['title'] ?> Merupakan Website Top Up Game Murah yang menjadi Agen Top Up murah bagi para reseller H2H di Indonesia.</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Start Single Item -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Apa kegunaan deposit di <?= $_CONFIG['title'] ?>?
                                                </a>
                                            </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <p>Deposit merupakan saldo utama untuk melakukan seluruh transaksi di dalam website <b><?= $_CONFIG['title'] ?></b>. </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Start Single Item -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Bagaimana cara untuk mendaftar?
                                                </a>
                                            </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p>Untuk melakukan register new member, silahkan klik tombol yang kami sediakan di atas atau klik <a href="<?= base_url('auth/daftar') ?>">Daftar disini</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Start Single Item -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        Bagaimana cara membuat pesanan?
                                                </a>
                                            </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <p>Untuk membuat pesanan sangatlah mudah, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman pemesanan dengan mengklik menu yang sudah tersedia. Selain itu Anda juga dapat melakukan pemesanan melalui request API. </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- End Single Item -->
                    </div><!-- end panel-group -->
                </div><!-- end col-md-6 -->
                <!-- End Faqs Text -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end faqs -->
    <!--
        End Faqs Section
        ==================================== -->
    <!--
        Start Subscribe Section
        ==================================== -->
         <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">admin cs dan developer</h2>
                        <h4 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">TINPED</h4>
                        
                    </div>
                </div>
            </div>
         <div class="item">
                                <div class="single-person">
                                    <div class="personIMG">
                                        <img src="img/developer/developer.png"  alt="<?= $_CONFIG['title'] ?>" class="img-fluid">
                                        <i class="bi bi-quote"></i>
                                    </div>
                                    <div class="personName">
                                        <h4>Justin R</h4>
                                        <span>developer</span>
                                    </div>
                                    <div class="personRate">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="personquote">
                                         </div>
                            <div class="footer-plan">
                                <a href="https://api.whatsapp.com/send?phone=6281932888380" class="bttn-appnova-gradient">
                                    <span>WhatsApp</span>
                                </a>
                            </div>
                            
                                    </div>
                                </div>
                            </div>
                            
    <section id="subscribe-place" class="subscribe-place pdd100">
        <div class="container">
            <div class="subscribe-box wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                <div class="box-htest">
                    <!-- Start Subscribe Text -->
                    <div class="subscribe-text" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                        <h4 class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">Subscribe Newsletter</h4>
                        <p class="wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">Enter your email address for our weekly new update</p>
                    </div>
                    <!-- End Subscribe Text -->
                    <!-- Start Subscribe Form -->
                    <div style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;" class="wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1s">
                        <form class="subscribe-form custom-input name-email clearfix" action="#" method="post">
                            <input type="email" name="email" placeholder="Enter your Email Address..." required="">
                            <button class="btn" type="submit" name="submit">
                                <i class="ion-paper-airplane"></i>
                            </button>
                        </form>
                    </div>
                    <!-- End Subscribe Form -->
                </div><!-- end box-htest -->
            </div><!-- end subscribe-box -->
        </div><!-- end container -->
    </section><!-- End subscribe-place -->
    <!--
        End Subscribe Section
        ==================================== -->
<style>
.gradient-brand-color { background-image: -webkit-linear-gradient(0deg, #4e54c8 0%, #8089ff 100%); background-image: -ms-linear-gradient(0deg, #376be6 0%, #6470ef 100%); color: #fff; } .contact-info__wrapper { overflow: hidden; border-radius: .625rem .625rem 0 0; font-family: Poppins, Arial; } @media (min-width: 1024px) { .contact-info__wrapper { border-radius: 0 .625rem .625rem 0; padding: 5rem !important } } .contact-info__list span.position-absolute { left: 0 } .z-index-101 { z-index: 101; } .list-style--none { list-style: none; } .contact__wrapper { background-color: #fff; border-radius: 0 0 .625rem .625rem } @media (min-width: 1024px) { .contact__wrapper { border-radius: .625rem 0 .625rem .625rem } } @media (min-width: 1024px) { .contact-form__wrapper { padding: 5rem !important } } .shadow-lg, .shadow-lg--on-hover:hover { box-shadow: 0 1rem 3rem rgba(132,138,163,0.1) !important; }
</style>
    <!--
        Start Contact Section
        ==================================== -->
    <section id="contact" class="contact">
        <div class="overlay pdd100">
            <div class="container">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters">
            <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
                <h3 class="color--white mb-5">Hubungi Kami</h3>
    
                <ul class="contact-info__list list-style--none position-relative z-index-101">
                    <li class="mb-4 pl-4">
                        <span class="position-absolute"><i class="fas fa-envelope"></i></span> tinpedsmm@gmail.com
                    </li>
                    <li class="mb-4 pl-4">
                        <span class="position-absolute"><i class="fas fa-phone"></i></span> (6281932888380)
                    </li>
                    <li class="mb-4 pl-4">
                        <span class="position-absolute"><i class="fas fa-map-marker-alt"></i></span> <?= $_CONFIG['title'] ?>.
                        <br> rangkasbitung ,
                        <br> lebak banten
    
                        <div class="mt-3">
                            <a href="https://www.google.com/maps/place/SDN+3+Sukamekarsari/@-6.3709776,106.2445387,18z/data=!4m6!3m5!1s0x2e4216c8499d217b:0x67ba3eb0400332c3!8m2!3d-6.3710762!4d106.2458315!16s%2Fg%2F1hm68nw__" target="_blank" class="text-link link--right-icon text-white">Google Maps <i class="link__icon fa fa-directions"></i></a>
                        </div>
                    </li>
                </ul>
    
                <figure class="figure position-absolute m-0 opacity-06 z-index-100" style="bottom:0; right: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="444px" height="626px">
                        <defs>
                            <linearGradient id="PSgrad_1" x1="0%" x2="81.915%" y1="57.358%" y2="0%">
                                <stop offset="0%" stop-color="rgb(255,255,255)" stop-opacity="1"></stop>
                                <stop offset="100%" stop-color="rgb(0,54,207)" stop-opacity="0"></stop>
                            </linearGradient>
    
                        </defs>
                        <path fill-rule="evenodd" opacity="0.302" fill="rgb(72, 155, 248)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                        <path fill="url(#PSgrad_1)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                    </svg>
                </figure>
            </div>
                    </div>
                </form>
            </div>
            <!-- End Contact Form Wrapper -->
    
        </div>
    </div>
</div>
        </div><!-- end overlay -->
    </section><!-- end contact -->
<style>
:root { --link-size: 40px; --trans-property: all 0.3s ease; } .social-icons { width: 100%; height : 85px; display: flex; align-items: center; justify-content: center; } .social-icon { display: flex; position: relative; overflow: hidden; width: var(--link-size); height: var(--link-size); margin: 5px; background-color: white; border-radius: 50%; box-shadow: 0px 1px 3px rgba(0,0,0,0.12); text-decoration: none; transition: var(--trans-property); } .social-icon i { margin: auto; font-size: 24px; color: #67798e; z-index: 1; transition: var(--trans-property); } .social-icon:after { content: ""; width: var(--link-size); height: var(--link-size); position: absolute; transform: translate(0, var(--link-size)); border-radius: 50%; transition: var(--trans-property); } .social-icon.twitter:after { background-color: #1da1f2; } .social-icon.youtube:after { background-color: #f00; } .social-icon.whatsapp:after { background-color: #2ba640; } .social-icon.tiktok:after { background-color: #24292e; } .social-icon.dribbble:after { background-color: #ea4c89; } .social-icon.instagram:after { background-color: #5851db; } .social-icon.facebook:after { background-color: #1769ff; } /*** Animations ***/ .social-icon:hover { transform: translateY(-4px); box-shadow: 0px 4px 12px rgba(0,0,0,0.16); } .social-icon:hover i { color: #fff; } .social-icon:hover:after { transform: translate(0) scale(1.2); }
</style>
    <footer id="footer" class="footer">
        <div class="container">
            <!-- Start Footer Logo -->
            <div class="footer-logo wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                <a href="#">
                    <img src="img/appnova-logo.webp" alt="appnova">
                </a>
            </div>
                        <div class="beranda"><span></span><span><?= $_CONFIG['title'] ?> Groups</span><span></span></div>
                        <p style="color:#fff"><?= $_CONFIG['description']; ?></p>
            <div class="copyright-design text-center wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">
  
                <p>Copyright © 2019 - 2023 <a href="#"></a>. All Rights Reserved.</p>
                                
<hr>
            </div>
            <!-- End Copyright -->
        </div><!-- end container -->
    </footer><!-- end footer -->
    <div class="clip-fo"></div>

    <div id="scroll-top">
        <i class="bi bi-chevron-up"></i>
    </div>

    <div id="loading-mask">
        <div class="loader">
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner"></div>
        </div>
    </div>

        
    <!--<script>-->
    <!--document.onkeydown = function(e) {-->
    <!--if(event.keyCode == 123) {-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){-->
    <!--return false;-->
    <!--}-->
    <!--}-->
    <!--</script>-->

    <!-- Plugins -->
    <script src="js/plugins.js"></script>
    <script src="js/shader-run.js"></script>
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
</body>
</html>
   <!DOCTYPE html>
<html>
<head>
<a href="https://api.whatsapp.com/send?phone=6281932888380">
<img src="https://hantamo.com/free/whatsapp.svg" class="wabutton" alt="Whatsapp-Button" />
</a>
<style>
.wabutton{
width:60px;
height:60px;
position:fixed;
bottom:80px;
right:20px;
z-index:100;
}
</style>