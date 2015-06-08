<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Qssam Portal</title>
	
	<!-- core CSS -->
    <link href="portal1/css/bootstrap.min.css" rel="stylesheet">
    <link href="portal1/css/font-awesome.min.css" rel="stylesheet">
    <link href="portal1/css/animate.min.css" rel="stylesheet">
    <link href="portal1/css/prettyPhoto.css" rel="stylesheet">
    <link href="portal1/css/main.css" rel="stylesheet">
    <link href="portal1/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body class="homepage">

    <header id="header">
        

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{URL::to('portal')}}">Home</a></li>
                        <li><a href="{{URL::to('misactividades')}}">Mis Actividades</a></li>
                        <li><a href="{{URL::to('manualusuario')}}">Manual</a></li>
                        <li><a href="{{URL::to('bibliotecaportal')}}">Biblioteca</a></li>
                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-item.html">Blog Single</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="shortcodes.html">Shortcodes</a></li>
                            </ul>
                        </li>-->
                        <li><a href="{{URL::to('/')}}">Administracion</a></li> 
                        <li><a href="contact-us.html">Usuario</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->


    

    
    
@yield("contenido")
    

    


    

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2015 - QSSAM
                </div>
               
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="portal1/js/jquery.js"></script>
    <script src="portal1/js/bootstrap.min.js"></script>
    <script src="portal1/js/jquery.prettyPhoto.js"></script>
    <script src="portal1/js/jquery.isotope.min.js"></script>
    <script src="portal1/js/main.js"></script>
    <script src="portal1/js/wow.min.js"></script>
</body>
</html>