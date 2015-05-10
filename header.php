<?php
/**
 * The template for displaying the header.
 *
 * @package WIMP
 * @since 0.1.0
 */
 ?>
<!doctype html <?php language_attributes(); ?>>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<header class="site-header" role="banner" >
		<section id="wimp-toolbar">
			<span id="slogan">Ask a person, not a search engine</span>
			<nav id="account-credentials" role="navigation">
				<ul>
					<li><a href="#login">Login</a></li>
					<li><a href="#signup">Signup</a></li>
					<li><a href="#search" class="search">Search</a></li>
				</ul>
			</nav>
		</section>
		<section id="logo-banner">
			<div itemscope itemtype="http://schema.org/Organization">
				<a itemprop="url" href="<?php echo esc_url( home_url() ); ?>">
					<img itemprop="logo"
					     src="<?php echo esc_url( WIMP_TEMPLATE_URL . '/images/logo-full.png' ); ?>"
					     alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>" />
				</a>
			</div>
		</section>
		<section id="main-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

		</section>
	</header>