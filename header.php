<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo (themify_check('setting-custom_feed_url')) ? themify_get('setting-custom_feed_url') : bloginfo('rss2_url'); ?>">

<?php
/**
 *  Stylesheets and Javascript files are enqueued in theme-functions.php
 */
?>

<!-- media-queries.js -->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<!-- wp_header -->
<?php wp_head(); ?>

</head>
<div id="headermenu">	<?php menuSuperior(); ?> </div>
<body <?php body_class($class); ?>>

<div id="pagewrap">
	
	<div id="header" class="pagewidth">

		<div id="site-logo">
			<?php if(themify_get('setting-site_logo') == 'image' && themify_check('setting-site_logo_image_value')){ ?>
				<?php themify_image("src=".themify_get('setting-site_logo_image_value')."&w=".themify_get('setting-site_logo_width')."&h=".themify_get('setting-site_logo_height')."&alt=".get_bloginfo('name')."&before=<a href='".get_option('home')."'>&after=</a>"); ?>
			<?php } else { ?>
				 <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
			<?php } ?>
		</div>
		<div id="site-description"><?php bloginfo('description'); ?></div>

				
		<div class="social-widget">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Social_Widget') ) ?>

			<?php if(!themify_check('setting-exclude_rss')): ?>
				<div class="rss"><a href="<?php if(themify_get('setting-custom_feed_url') != ""){ echo themify_get('setting-custom_feed_url'); } else { echo bloginfo('rss2_url'); } ?>">RSS</a></div>
			<?php endif ?>
		</div>
		<!--/social widget --> 

		<!-- header wdiegt -->
		<div class="header-widget">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header_Widget') ) ?>
		</div>
		<!--/header widget --> 

		<?php if(!themify_check('setting-exclude_search_form')): ?>
			<?php get_search_form(); ?>
		<?php endif ?>

		<div id="nav-bar">
			<?php if (function_exists('wp_nav_menu')) {
				wp_nav_menu(array('theme_location' => 'main-nav' , 'fallback_cb' => 'default_main_nav' , 'container'  => '' , 'menu_id' => 'main-nav' , 'menu_class' => 'main-nav'));
			} else {
				default_main_nav();
			} ?>
		</div><!--/nav bar -->

	</div>
	<!--/header -->

	<div id="body" class="clearfix">