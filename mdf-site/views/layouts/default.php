<!DOCTYPE HTML>
<html>
<head>
    <title>Farmers' square</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="http://localhost:8080/css/ie/html5shiv.js"></script><![endif]-->
    <script src="http://localhost:8080/js/jquery.min.js"></script>
    <script src="http://localhost:8080/js/jquery.dropotron.min.js"></script>
    <script src="http://localhost:8080/js/skel.min.js"></script>
    <script src="http://localhost:8080/js/skel-layers.min.js"></script>
    <script src="http://localhost:8080/js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="http://localhost:8080/css/skel.css" />
        <link rel="stylesheet" href="http://localhost:8080/css/style.css" />
        <link rel="stylesheet" href="http://localhost:8080/css/style-desktop.css" />
    </noscript>
    <!--[if lte IE 8]><link rel="stylesheet" href="http://localhost:8080/css/ie/v8.css" /><![endif]-->
    <link rel="stylesheet" href="http://localhost:8080/css/custom.css" />
</head>
<body>

    <!-- Header -->
    <div id="header-wrapper">
        <header id="header" class="container">

            <!-- Logo -->
            <div id="logo">
                <h1><a href="/">Farmers' Square</a></h1>
            </div>

            <!-- Nav -->
            <nav id="nav">
                <ul>
                    <li class="current"><a href="/">Home</a></li>
                    <li>
                        <a href="">User Actions</a>
                        <ul>
                            <li><a href="#">Users list</a></li>
                            <li><a href="#">Add post</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </nav>

        </header>
    </div>

    <!--  Insert Specific Layout   -->
    <?php echo $this->getLayoutData('body'); ?>


    <!-- Footer -->
    <div id="footer-wrapper">
        <footer id="footer" class="container">
            <div class="row">
                <div class="12u">
                    <div id="copyright">
                        <ul class="menu">
                            <li>&copy; Web-dev-basics project by minkas_g_d</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>