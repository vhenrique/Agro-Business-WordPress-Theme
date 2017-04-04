<!doctype html>
<html lang="pt-BR">
<head>
	<!-- Developed by Vitor Henrique da Silva - vhenrique.vhs@gmail.com  - http://vhenrique.com -->
	<!-- At AVIVATEC Soluções em TI - http://avivatec.com.br -->
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
	<meta name="author" content="Successful Farming" />
	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<link rel="icon" href="<?php echo get_template_directory_uri()?>/assets/images/favico.png" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri()?>/assets/images/favico.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="print" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php 
		if(is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
		wp_head();
		global $redux_options, $themePrefix;
		dailyFunctionApi();

		setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
		date_default_timezone_set('America/Sao_Paulo');
	?>
	<meta name="contact" content="<?php if(isset($redux_options[$themePrefix.'adress'])) echo $redux_options[$themePrefix.'adress'];?>" />
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script>
		window.twttr = (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0],
			t = window.twttr || {};
		  	if (d.getElementById(id)) return t;
		  	js = d.createElement(s);
		  	js.id = id;
		  	js.src = "https://platform.twitter.com/widgets.js";
		  	fjs.parentNode.insertBefore(js, fjs);
		 
		  	t._e = [];
		  	t.ready = function(f) {
		    t._e.push(f);
		  };
		  return t;
		}(document, "script", "twitter-wjs"));
	</script>
	<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: pt_BR</script>
	<script src="https://apis.google.com/js/platform.js" async defer>{lang: 'pt-BR'}</script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script>google.load("visualization", "1.1", {packages:["corechart"]});</script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-70073149-1', 'auto');
	  ga('send', 'pageview');
	</script>

	 <script type="text/javascript">
        window.universal_variable = window.universal_variable || {};
        window.universal_variable.dfp = {
            "custom_params" : {
                "subchan" : "",
            }
        };
        window.uolads = window.uolads || [];
        ;(function() {
            var scr = document.createElement("script");
            scr.async = true;
            scr.src =  "//tm.jsuol.com.br/uoltm.js?id=dn44jc";
            var el = document.getElementsByTagName("script")[0];
                el.parentNode.insertBefore(scr, el);
        })();
    </script>

	<?php if(is_single()) count_more_seen(get_the_id());?>
</head>
<body <?php body_class(); ?> id="top">
	 <script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1444642972531437',
	      xfbml      : true,
	      version    : 'v2.4'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/pt_BR/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>


	<div id="global-wrapper" class="full-width-wrapper">
		<header class="main">
			<div class="wrap">
				<a href="<?php echo get_home_url(); ?>" title="<?php echo bloginfo('name')?>" class="site-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" />
				</a>
				<div class="box-header-right">
					<ul class="social-networks">
						<?php 
						if(!empty($redux_options[$themePrefix.'facebook_url'])){
							echo '<li><div class="fb-like" data-href="'.$redux_options[$themePrefix.'facebook_url'].'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>';
						}
						// Twitter
						if(!empty($redux_options[$themePrefix.'twitter_url'])){
							echo '<li><a href="'.$redux_options[$themePrefix.'twitter_url'].'" title="Twitter" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/twitter_ico.png"></a></li>';
						}
						// Google+
						if(!empty($redux_options[$themePrefix.'googlePlus_url'])){
							echo '<li><a href="'.$redux_options[$themePrefix.'googlePlus_url'].'" title="Google plus" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/googlePlus_ico.png"></a></li>';
						}
						// Linkedin
						if(!empty($redux_options[$themePrefix.'linkedin_url'])){
							echo '<li><a href="'.$redux_options[$themePrefix.'linkedin_url'].'" title="Linkedin" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/linkedin_ico.png"></a></li>';
						}
						// Instagram
						if(!empty($redux_options[$themePrefix.'instagram_url'])){
							echo '<li><a href="'.$redux_options[$themePrefix.'instagram_url'].'" title="Instagram" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/instagram_ico.png"></a></li>';
						}
						?>
					</ul>
					<a href="<?php echo get_post_permalink(4); ?>" class="contact" title="Fale Conosco">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/faleConosco_ico.png">
					</a>
				</div>
				<form role="search" method="get" id="searchform" action="<?php bloginfo('home'); ?>">
					<input type="text" name="s" class="search-text"/>
					<input type="submit" value="" class="submit" title="Buscar" />
				</form>
			</div>

			<nav class="menu-header"> 
				<div class="wrap">
					<a href="#" class="menuIcon">Menu</a>
					<?php wp_nav_menu(array('menu'=>'header-menu')); ?>
				</div>
			</nav>
		</header>
		<div class="full-width-wrapper">
			<?php getHeaderBanner(); ?>