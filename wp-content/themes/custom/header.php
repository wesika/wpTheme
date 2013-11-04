<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php wp_title('', true, 'right'); ?></title>
				
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- icons & favicons -->
		<!-- For everything else -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
				
		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

		
		<!-- bring in theme options styles -->
		<?php 
		$heading_typography = of_get_option('heading_typography');
		if ($heading_typography) {
			$theme_options_styles = '
			h1, h2, h3, h4, h5, h6{ 
				font-family: ' . $heading_typography['face'] . '; 
				font-weight: ' . $heading_typography['style'] . '; 
				color: ' . $heading_typography['color'] . '; 
			}';

			$theme_options_styles .= '
			#logo, #logo:hover{ 
				color: ' . $heading_typography['color'] . '; 
			}';
		}
		
		$main_body_typography = of_get_option('main_body_typography');
		if ($main_body_typography) {
			$theme_options_styles .= '
			body{ 
				font-family: ' . $main_body_typography['face'] . '; 
				font-weight: ' . $main_body_typography['style'] . '; 
				color: ' . $main_body_typography['color'] . '; 
			}';
		}

		$background_container = of_get_option('background_container');
		if ($background_container) {
			$theme_options_styles .= '
			.container{ 
				background-color: ' . $background_container . '; 
			}';
		}

		$header_logo = of_get_option('header_logo');
		if ($header_logo) {
			$theme_options_styles .= '
			.sitelogo{ 
				background-image:url('. $header_logo .');
				background-repeat:no-repeat;
				background-position:90% top;
			}';
		}

		$link_color = of_get_option('link_color');
		if ($link_color) {
			$theme_options_styles .= '
			a{ 
				color: ' . $link_color . '; 
			}';
		}
		
		$link_hover_color = of_get_option('link_hover_color');
		if ($link_hover_color) {
			$theme_options_styles .= '
			a:hover{ 
				color: ' . $link_hover_color . '; 
			}';
		}
		
		$link_active_color = of_get_option('link_active_color');
		if ($link_active_color) {
			$theme_options_styles .= '
			a:active{ 
				color: ' . $link_active_color . '; 
			}';
		}

				$button_color = of_get_option('button_color');
		if ($button_color) {
			$theme_options_styles .= '
			.button{ 
				background-color: ' . $button_color . '; 
			}';
		}
		
		$topbar_bg_color = of_get_option('top_nav_bg_color');
		if ($topbar_bg_color) {
			$theme_options_styles .= '
			.top-nav { 
				background-color: '. $topbar_bg_color . ';
			}';
		}
		
		$topbar_link_color = of_get_option('top_nav_link_color');
		if ($topbar_link_color) {
			$theme_options_styles .= '
			.top-nav > li > a,
			ul.flyout li a:hover, 
			.nav-bar li ul li a:hover { 
				color: '. $topbar_link_color . ' !important;
			}';
		}
		
		$topbar_link_hover_color = of_get_option('top_nav_link_hover_color');
		if ($topbar_link_hover_color) {
			$theme_options_styles .= '
			.top-nav > li > a:hover { 
				color: '. $topbar_link_hover_color . ' !important;
			}';
		}

		$topbar_hover_color = of_get_option('top_nav_hover_color');
		if ($topbar_hover_color) {
			$theme_options_styles .= '
			.top-nav > li:hover,
			ul.flyout li a:hover,
			.nav-bar li ul li a:hover { 
				background-color: '. $topbar_hover_color . ';
			}';
		}

		$topbar_link_active_color = of_get_option('top_nav_link_active_color');
		if ($topbar_link_active_color) {
			$theme_options_styles .= '
			.top-nav > li.active, 
			.top-nav > li.active:hover,
			ul.flyout li.active a,
			.nav-bar li ul li.active a   { 
				background-color: '. $topbar_link_active_color . ';
			}';
		}
		
		$suppress_comments_message = of_get_option('suppress_comments_message');
		if ($suppress_comments_message){
			$theme_options_styles .= '
			#main article {
				border-bottom: none;
			}';
		}
						
		if($theme_options_styles){
			echo '<style>' 
			. $theme_options_styles . '
			</style>';
		}
		
		?>
				
	</head>
	
	<body <?php body_class('off-canvas hide-extras'); ?>>

		<div class="container">
			<div class="twelve columns">
				<header role="banner" id="top-header">
					
					<div class="siteinfo row">
						<div class="eight columns">
							<h1><a class="brand" id="logo" href="<?php echo get_bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
							<h4 class="subhead"><?php echo get_bloginfo ( 'description' ); ?></h4>
						</div>
						<div class="four columns sitelogo">
						</div>
					</div>
			
					<nav id="menu" role="navigation" class="hide-for-small">
					<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
				</nav>
					<p class="show-for-small">
  			  			<a class='sidebar-button button' id="mobile-nav-button" href="#mobile-nav" >Menu</a>
  					</p>

  					<section id="mobile-nav" role="complementary">
				<nav id="sideMenu" role="navigation">
					<?php bones_mobile_nav(); ?>
					</nav>
					</section> 

				</header> <!-- end header -->
			</div>