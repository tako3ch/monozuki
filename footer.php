<?php
/**
 * @package monozuki
 */
?>

</div><!-- #content -->
<footer id="footer" class="site-footer">
  <div class="go_top">
      <a href="#page"><span></span></a>
  </div>
  <div class="site-info">
  <?php
    $pf_sns_tw = get_the_author_meta('twitter');
    $pf_sns_fb = get_the_author_meta('facebook');
    $pf_sns_ig = get_the_author_meta('instagram');
    $prof_flg = false;
    if ($pf_sns_tw != '' || $pf_sns_fb != '' || $pf_sns_ig != '') {
      $prof_flg = true;
    }
    if ($prof_flg) {
      echo '<ul class="footer-prof-sns">';
      if ($pf_sns_tw) {echo '<li class="footer-prof-sns-item--tw"><a href="https://twitter.com/' . $pf_sns_tw . '" target="_blank"><i class="icon-twitter"></i></a></li>';}
      if ($pf_sns_fb) {echo '<li class="footer-prof-sns-item--fb"><a href="' . $pf_sns_fb . '" target="_blank"><i class="icon-facebook"></i></a></li>';}
      if ($pf_sns_ig) {echo '<li class="footer-prof-sns-item--ig"><a href="https://www.instagram.com/' . $pf_sns_ig . '" target="_blank"><i class="icon-instagram"></i></a></li>';}
      echo '</ul>';
    }?>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
  </div><!-- .site-info -->

</footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); wp_reset_query(); ?>
<script src="//instant.page/3.0.0" type="module" defer integrity="sha384-OeDn4XE77tdHo8pGtE1apMPmAipjoxUQ++eeJa6EtJCfHlvijigWiJpD7VDPWXV1"></script>
<?php if (is_single()) {echo '<script src="' . get_template_directory_uri() . '/common/js/slider.js?v3"></script>';} ?>
<?php if (is_page_template('single-column.php')) {echo '<script src="' . get_template_directory_uri() . '/common/js/column.js"></script>';} ?>
</body>
</html>
