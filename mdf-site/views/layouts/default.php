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

    <script src="http://localhost:8080/js/jquery.noty.js"></script>
    <script src="http://localhost:8080/js/utilities.js"></script>
    <script src="http://localhost:8080/js/custom.js"></script>
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
                    <li class="<?=($this->nav == 'home')? 'current': ''?>"><a href="/">Home</a></li>
                    <li class="<?=($this->nav == 'all-posts')? 'current': ''?>"><a href="http://localhost:8080/posts/view">All Posts</a></li>
                    <?php if($this->is_logged) { ?>
                        <li class="<?=($this->nav == 'add-post')? 'current': ''?>">
                            <a href="">User Actions</a>
                            <ul>
<!--                                <li><a href="#">Users list</a></li>-->
                                <li class="<?=($this->nav == 'add-post')? 'current': ''?>"><a href="http://localhost:8080/user/add-post">Add post</a></li>
                            </ul>
                        </li>
                        <li><a id="logout" href="#">Logout</a></li>
                    <?php } else { ?>
                        <li class="<?=($this->nav == 'login')? 'current': ''?>"><a href="http://localhost:8080/user/login">Login</a></li>
                        <li class="<?=($this->nav == 'register')? 'current': ''?>"><a href="http://localhost:8080/user/register">Register</a></li>
                    <?php } ?>
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