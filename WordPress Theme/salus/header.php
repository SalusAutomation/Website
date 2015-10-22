<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package salus
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Typekit script -->
	<script src="https://use.typekit.net/bfu0vru.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

	<!-- Main CSS -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/base.css" rel="stylesheet" media="all">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site">
	<header class="site-header clear">
    <div class="frame clear">	
			<div class="grid-branding grid">
				<p class="branding"><a class="logo-link" href="/"><strong class="logo"><span class="hide">Salus Medical Automation</span></strong></a></p>
			</div>

			<div class="main-nav-container grid-half grid">
				<nav class="main-nav nav clear">
				  <?php
		        if (has_nav_menu('primary')) :
		          wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );
		        endif;
	        ?>
				</nav>
			</div>

			<div class="quick-connect-container grid grid-set-right grid-last clear">
				<div class="quick-connect clear">
					<p class="quick-connect-contact grid-half grid">
						<strong class="quick-connect-contact-label">Contact Salus</strong>
						<span class="scope-text">hello@salusgroup.com</span>
						<span class="scope-text">(888) 555-1234</span>
					</p>
					<ul class="quick-connect-social-list grid-half grid grid-last clear">
						<li class="social-list-item"><a class="social-icon-twitter social-icon" href="#"><span class="hide">Twitter</span></a></li>
						<li class="social-list-item"><a class="social-icon-linkedin social-icon" href="#"><span class="hide">LinkedIn</span></a></li>
					</ul>
				</div>
			</div>

		</div>
	</header>

	<main id="main" class="site-main" role="main">
	<div class="main">
