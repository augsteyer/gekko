<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
<?php wp_head(); ?>

<!--Content show hide fuctionality-->

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(function() {
$( "#availablity_date" ).datepicker({ dateFormat: 'yy-mm-dd'});
$( "#availablity_date2" ).datepicker();
$( "#availablity_date3" ).datepicker();

});
</script>
<script type="application/javascript">
$( document ).ready(function() {
$(".hide_more").hide();
});

function show_more(a){
	
	$(".hide"+a).show('slow');
	$("#hide_more"+a).show('slow');
	$("#show_more"+a).hide('slow');
	$(".show"+a).hide('slow');
	
}

function hide_more(a){
	
	$(".hide"+a).hide('slow');
	$("#hide_more"+a).hide('slow');
	$("#show_more"+a).show('slow');
	$(".show"+a).show('slow');
	
}

</script>
<style>
.entry-thumbnail img, entry-thumbnail {
	float: left;
}
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<header id="masthead" class="site-header" role="banner"> <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
  <h1 class="site-title">
    <?php bloginfo( 'name' ); ?>
  </h1>
  <h2 class="site-description">
    <?php bloginfo( 'description' ); ?>
  </h2>
  </a>
  <div id="navbar" class="navbar">
    <nav id="site-navigation" class="navigation main-navigation" role="navigation">
      <h3 class="menu-toggle">
        <?php _e( 'Menu', 'twentythirteen' ); ?>
      </h3>
      <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>">
      <?php _e( 'Skip to content', 'twentythirteen' ); ?>
      </a>
      <?php
if ( is_user_logged_in() ) {
    ?>
      <div class="menu-menu-1-container">
        <ul class="nav-menu" id="menu-menu-1">
          <li class="" id="menu-item-27"><a href="<?php bloginfo('url'); ?>">Home</a></li>
          <li class="" id="menu-item-54"><a href="<?php echo wp_logout_url(); ?>">Log Out</a></li>
          <li class="" id="menu-item-55"><a href="<?php bloginfo('url'); ?>/dashboard/">Dashboard</a>
          <ul class="sub-menu">
          <li class="" id="menu-item-55"><a href="<?php bloginfo('url'); ?>/add-dishes">Add dishes</a></li>
        
       </ul>
        </ul>
      </div>
      <?php
} else {
 wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
}
?>
      <div class="translate_div">
        <?php if(function_exists("transposh_widget")) { transposh_widget(array(), array('title' => 'Translation', 'widget_file' => 'flags/tpw_flags.php')); }?>
      </div>
    </nav>
    <!-- #site-navigation --> 
  </div>
  <!-- #navbar --> 
</header>
<!-- #masthead -->

<div id="main" class="site-main">
