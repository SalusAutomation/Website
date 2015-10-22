<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package salus
 */

get_header(); ?>

<div class="content">

<?php
  /*    Page Id reference for below.
   *    —·—·—·—·—·——·—·—·—·—·—·—·—·—·—
   * 
   *    Intro Page ID: 14
   *    About Page ID: 2
   *    Applications Page ID: 5
   *    Consulting Page ID: 7
   *    Products Page ID: 9
   *    Contact Page ID: 11
   *
   */
?>


<!-- SECTION: Intro -->
<?php  
  $pageBlock = new WP_Query("page_id=14");
  while($pageBlock->have_posts()) : $pageBlock->the_post();

  // TODO: 
  // [] Change styles to match new format
  // [] Setup featured image as background css

  // Get URL for featured image
  $featuredImage = wp_get_attachment_url(get_post_thumbnail_id($pageBlock->ID));
?>

<?php /* NOTE: Allows feature image management via WordPress */ ?>
<style>
  .main-lead { background-color: #00c7c0; }
  @media screen and (min-width: 1024px) { 
    .main-lead { background: url(<?php echo $featuredImage; ?>) center top no-repeat transparent; background-size: auto 100%; }
  }
</style>

<div id="section-intro" class="main-lead section-page">
  <div class="frame">
	  <?php /* REF: <h1><strong>Enhancing Healthcare</strong> <span class="scope-text">through world-class technology</span></h1> */ ?>
    <?php the_content(); ?>
  </div>
</div>

<?php
  endwhile;
  wp_reset_postdata();
?>


<!-- SECTION: About -->
<?php  
  $pageBlock = new WP_Query("page_id=2");
  while($pageBlock->have_posts()) : $pageBlock->the_post();
?>

<div id="section-about" class="section-about section-page">
  <div class="section-about-frame frame">
    <header class="section-header">
      <h2 class="section-about-title section-title"><?php the_title(); ?></h2>
    </header>

    <div class="section-about-content section-page-content">
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php
  endwhile;
  wp_reset_postdata();
?>


<!-- SECTION: Applications -->

<div id="section-applications" class="section-applications section-page">
  <div class="frame">

    <?php
      // Get the main page content for Applications
      $pageBlock = new WP_Query("page_id=5");
      while($pageBlock->have_posts()) : $pageBlock->the_post();
    ?>
      <header class="section-header">
        <h2 class="section-applications-title section-title"><?php the_title(); ?></h2>
      </header>

      <div class="section-applications-content section-page-content">
        <?php the_content(); ?>
      </div>
    <?php
      endwhile;
      wp_reset_postdata();
    ?>

    <?php
      // Fetch the feature list from the Site Block Custom Post
      // Post ID 24 = Site Block: Applications Features
      $siteBlock = get_post('24');
    ?>
      <div class="section-applications-features">
        <?php echo apply_filters('the_content', $siteBlock->post_content); ?>
      </div>
    <?php wp_reset_postdata(); ?>
  </div>
</div>


<?php 
  /*
  $page_block_banner_1 =  get_post('67974');
  if (get_field('big_feature_image', $page_block_banner_2->ID) !== "") :
  echo get_field('big_feature_image', $page_block_banner_1->ID);
  echo apply_filters('the_title', $page_block_banner_1->post_title);
  endif; 
  */
?>



<!-- SECTION: Consulting -->
<?php  
  $pageBlock = new WP_Query("page_id=7");
  while($pageBlock->have_posts()) : $pageBlock->the_post();

  $sectionImage = wp_get_attachment_url(get_post_thumbnail_id($pageBlock->ID));
?>

<div id="section-consulting" class="section-consulting section-page">
  <div class="frame">
    <header class="section-header">
      <h2 class="section-consulting-title section-title"><?php the_title(); ?></h2>
    </header>

    <div class="section-consulting-content section-page-content">
      <?php the_content(); ?>

      <div class="section-image">
        <p class="section-image"><img class="section-image-img" src="<?php echo $sectionImage; ?>" alt="Abstract building" /></p>
      </div>
    </div>
  </div>
</div>

<?php
  endwhile;
  wp_reset_postdata();
?>


<!-- SECTION: Products -->
<div id="section-products" class="section-products section-page">
  <div class="frame">

  <?php 
    // Main content
    $pageBlock = new WP_Query("page_id=9");
    while($pageBlock->have_posts()) : $pageBlock->the_post();
  ?>
    <header class="section-header">
      <h2 class="section-products-title section-title"><?php the_title(); ?></h2>
    </header>

    <div class="section-products-content section-page-content clear">
      <?php the_content(); ?>
    </div> <!-- /.section-products-content -->

  <?php
    endwhile;
    wp_reset_postdata();
  ?>

    <div class="section-products-app-listings frame">
      <?php
        // App listings built from Custom Post Type "app"

        // Clear any overriding filter
        remove_all_filters('posts_orderby');
        
        // Query the "degree" custom post type
        $args = array(
          'post_type' => 'app',
          'posts_per_page' => -1,
          'orderby' => 'menu_order',
          'order'   => 'ASC'
        );
        
        $loop = new WP_Query( $args );
        
        while ($loop->have_posts()) : $loop->the_post();        

          // get_post_meta() Parameters:
          // - post ID
          // - key
          // - TRUE/FALSE for single result e.g. string
          // See: https://codex.wordpress.org/Custom_Fields

          $appStoreLink = get_post_meta($post->ID, "app_link", TRUE);
      ?>
        <section class="app-block grid-fourth-flush grid">
          <p class="mobile-p">
            <?php the_post_thumbnail('full'); ?>
            <!-- <img alt="<?php the_title(); ?>" class="mobile-img" src="/images/mobile-redeapp-1.png" title="View <?php the_title(); ?> on the app store." width="100%"> -->
          </p>

          <h3 class="app-block-title"><a class="app-block-title-link" href="<?php echo $appStoreLink; ?>" title="View <?php the_title(); ?> on the App Store."><?php the_title(); ?></a></h3>
          <div class="app-block-desc"><?php the_content(); ?></div>
          <p>
            <a class="app-block-app-link button" href="<?php echo $appStoreLink; ?>"><span class="scope-text">Download on the </span>App Store</a>
          </p>
        </section>
      <?php
        endwhile;
        wp_reset_postdata();
      ?>
      <span class="clear"></span>
    </div> <!-- /.section-products-app-listings -->

  </div> <!-- /.frame -->
</div> <!-- /.section-products -->




<!-- SECTION: Contact Us -->

<div id="section-contact" class="section-contact section-page">
  <div class="frame">
    <?php
      // Get the main page content for the Contact Us section
      $pageBlock = new WP_Query("page_id=11");
      while($pageBlock->have_posts()) : $pageBlock->the_post();
    ?>
      <header class="section-header">
        <h2 class="section-contact-title section-title"><?php the_title(); ?></h2>
      </header>

      <div class="section-contact-content section-page-content">
        <?php the_content(); ?>
      </div>
    <?php
      endwhile;
      wp_reset_postdata();
    ?>

    <?php
      // Fetch contact details from the Site Block Custom Post
      // Post ID 25 = Site Block: Contact Us Details
      $siteBlock = get_post('25');
    ?>
      <div class="section-contact-us-details">
        <?php echo apply_filters('the_content', $siteBlock->post_content); ?>
      </div>
    <?php wp_reset_postdata(); ?>

  </div>
</div>








</div> <!-- /.content -->

<?php get_footer(); ?>
