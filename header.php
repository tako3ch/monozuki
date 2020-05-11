<?php
/**
 *
 *
 * @package monozuki
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<?php if(has_site_icon()){ echo '<link rel="shortcut icon" href="'.get_site_icon_url().'" />'; }else{ echo '<link rel="shortcut icon" href="'.get_template_directory_uri().'/common/img/favicon.png" />'; }?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/common/css/init.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/common/css/basic.css?v30" />
	<?php
	if(get_option('mnzk_chgcolor_txt')){
		switch (get_option('mnzk_chgcolor_txt')) {
			case 'yami':
				echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/common/css/change/yami.css" />';
				break;
			default:
				break;
		}
	}
	$logosize = 'logosize__df';
	if(get_option('mnzk_logosize')){
		switch (get_option('mnzk_logosize')) {
			case 'small':
				$logosize = 'logosize__sm';
				break;
			case 'big':
				$logosize = 'logosize__big';
				break;
			default:
				$logosize = 'logosize__df';
				break;
		}
	}
	?>
	<?php wp_head(); ?>
	<?php if(get_option('mnzk_tag_txt')): echo get_option('mnzk_tag_txt'); endif;?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site js-load">
	<div class="overlay"></div>
	<header id="masthead" class="site-header">
		<div class="header-in">
			<div class="site-branding <?php echo $logosize;?>">
				<?php if (has_custom_logo()) {the_custom_logo();}else{if ( is_front_page() && is_home() ) :?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; } ?>
			</div><!-- .site-branding -->
			<?php if ( has_nav_menu( 'global-menu' ) || has_nav_menu( 'global-sub-menu' ) ) { ?>
			<div class="header-btm">
				<nav class="main-navigation">

					<?php if(get_option('mnzk_searchbox') == 'show'){ echo get_search_form();}?>
					<?php if ( has_nav_menu( 'global-menu' ) ) { wp_nav_menu( array( 'theme_location' => 'global-menu', 'menu_class' => '', 'container' => '', 'items_wrap' => '<ul class="hnav">%3$s</ul>' ) );}?>
					<?php if ( has_nav_menu( 'global-sub-menu' ) ) { wp_nav_menu( array( 'theme_location' => 'global-sub-menu','menu_class' => '','container' => '', 'items_wrap' => '<ul class="hnav-sub">%3$s</ul>'));}?>
					<!-- searchbox -->
					<?php if(get_option('mnzk_searchbox') == 'show'){ echo '<div class="search__btn"><i class="icon-search"></i></div>';}?>
				</nav><!-- #site-navigation -->
			</div><!-- /.header-btm -->
			<?php } ?>
			<div class="ham__menu btn-close">
				<span class="ham__menu-item"></span>
				<span class="ham__menu-item"></span>
				<span class="ham__menu-item"></span>
			</div>
		</div><!-- /.header-in -->
	</header><!-- #masthead -->


	<div id="content" class="site-content">
