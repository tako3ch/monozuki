<?php
/**
 * single
 *
 *
 * @package monozuki
 */

get_header();

$prevpost = get_adjacent_post(false, '', false);
$nextpost = get_adjacent_post(false, '', true);
?>

  <?php while (have_posts()) : the_post(); $post_id = get_the_ID(); ?>
  <div class="contents-area single-area">
    <main id="main" class="site-main">
      <div class="entry-thumbs">
        <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); if(is_plugin_active( 'smart-custom-fields/smart-custom-fields.php' )){ $gallery = SCF::get('slider'); } else { $gallery[0]['gallery_item'] = ''; }
        if ($gallery[0]['gallery_item'] != '') {
          echo '<ul class="g__slide">';
          foreach ($gallery as $gallery_id) {
            $gallery_thumb_id = $gallery_id['gallery_item'];
            $gallery_thumb = wp_get_attachment_image_src( $gallery_thumb_id , 'full' );
            if(!empty($gallery_thumb)) $gallery_thumb = $gallery_thumb[0];
            echo '<li><img src="'.$gallery_thumb.'" alt=""></li>';
          }
          echo '</ul>';
        }else{
          $post_thumb_id = get_post_thumbnail_id($post_id);
          $post_thumb = wp_get_attachment_image_src( $post_thumb_id , 'full' );
          if(!empty($post_thumb)){ $hero_img = $post_thumb[0]; }
        ?>
        <img class="entry-thumb__img" src="<?php echo $hero_img;?>" alt="">
        <?php } ?>
      </div>
      <div class="entry-page">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </div><!-- ./entry-header -->
          <div class="slider-nav-container">
            <div class="slider-nav"></div>
          </div>
          <?php // Ad
          $addisp_head = '';
          $addisp_head_sp = '';
          $addisp_head = get_option('hakushi_addisp_head');
          $addisp_head_sp = get_option('hakushi_addisp_head_sp');
          if ($addisp_head != '' && DEVICE == 'PC') {
            echo '<div class="ad_block">' . $addisp_head . '</div>';
          } elseif ($addisp_head_sp != '' && DEVICE == 'SP') {
            echo '<div class="ad_block">' . $addisp_head_sp . '</div>';
          } ?>
          <!-- ./ad -->
          <div class="entry-content">
            <?php the_content(); ?>
          </div><!-- ./entry-content -->
          <ul class="entry-header-list">
            <li><time class="published" datetime="<?php the_time("Y/m/d"); ?>" itemprop="datePublished"><?php the_time("Y.m.d"); ?></time></li>
            <li><?php if (is_single()): $category = get_the_category(); $cat_name = $category[0]->cat_name; echo $cat_name; endif; ?></li>
          </ul>
          <div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
              <ul class="breadcrumb-list">
                  <li class="breadcrumb-item"><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo home_url('/'); ?>"><span itemprop="name">Home</span></a><meta itemprop="position" content="1"/></span></li>
                  <li class="breadcrumb-item"><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_category_link($category[0]->term_id); ?>"><span itemprop="name"><?php echo $cat_name; ?></span></a><meta itemprop="position" content="2"/></span></li>
                  <li class="breadcrumb-item"><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a><meta itemprop="position" content="3"/></span>
                  </li>
              </ul>
          </div><!-- /.breadcrumb -->

          <!-- mnzk_addisp_related -->
          <?php // Ad
          $addisp_related = ''; $addisp_related = get_option('hakushi_addisp_related');
          if ($addisp_related != '') { echo '<div class="ad_block">' . $addisp_related . '</div>'; }?>

          <div class="entry-tags">
            <?php if (get_the_tag_list()) { echo get_the_tag_list('<ul class="taglist"><li>', '</li><li>', '</li></ul>'); } ?>
          </div>
          <?php
          $addisp_snstop = '';
          $addisp_snstop_sp = '';
          $addisp_snstop = get_option('hakushi_addisp_snstop');
          $addisp_snstop_sp = get_option('hakushi_addisp_snstop_sp');
          if ($addisp_snstop != '' && DEVICE == 'PC') { echo '<div class="ad_block">' . $addisp_snstop . '</div>'; } elseif ($addisp_snstop_sp != '' && DEVICE == 'SP') { echo '<div class="ad_block">' . $addisp_snstop_sp . '</div>';} ?>
          <?php get_template_part('tpl/sharebtn', 'sharebtn'); ?>

          <div class="pager-list">
              <div class="pager-item--prev">
                <?php if (!empty($prevpost)): $id = $prevpost->ID; ?>
                    <a class="pager-item__link" href="<?php the_permalink($id); ?>">
                        <p><?php echo $prevpost->post_title; ?></p>
                    </a>
                <?php endif; ?>
              </div><!-- prev -->
              <div class="pager-item--next">
                <?php if (!empty($nextpost)): $id = $nextpost->ID; ?>
                    <a class="pager-item__link" href="<?php the_permalink($id); ?>">
                        <p><?php echo $nextpost->post_title; ?></p>
                    </a>
                <?php endif; ?>
              </div><!-- next -->
          </div>
          <!-- comment -->

        </article><!-- #post-## -->
        <?php endwhile; ?>
      </div>
    </main><!-- #main -->
  </div><!-- #primary -->

<?php
if (is_single()) :
  $publogo_img = '';
  $pubogp_img = '';
  if (!is_null(get_option('hks_logo_url'))) { $publogo_img = get_option('hks_logo_url'); }
  if (is_singular() && has_post_thumbnail()) { $ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); $pubogp_img = $ps_thumb[0]; } elseif (get_option('hks_logo_url')) { $pubogp_img = get_option('hks_logo_url'); } else { $pubogp_img = get_template_directory_uri() . '/common/img/ogp.png'; }
  ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "BlogPosting",
      "mainEntityOfPage":{
        "@type":"WebPage",
        "@id":"<?php the_permalink(); ?>"
      },
      "headline":"<?php the_title(); ?>",
      "image": {
        "@type": "ImageObject",
        "url": "<?php echo $pubogp_img; ?>",
        "height": "450",
        "width": "800"
      },
      "datePublished": "<?php echo get_date_from_gmt(get_post_time('c', true), 'c'); ?>",
      "dateModified": "<?php echo get_date_from_gmt(get_post_modified_time('c', true), 'c'); ?>",
      "author": {
        "@type": "Person",
        "name": "<?php the_author(); ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "<?php bloginfo('name'); ?>",
        "url": "<?php echo esc_url(home_url('/')); ?>",
        "logo": {
        "@type": "ImageObject",
        "url": "<?php echo $publogo_img ?>",
        "width": 300,
        "height": 100
        }
      },
      "description": "<?php echo get_the_excerpt(); ?>"
    }
    </script>
<?php endif; ?>
<?php
get_footer();
