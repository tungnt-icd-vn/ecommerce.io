<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>

<main class="l-main">
        <div class="c-carousel">
          <div class="c-carousel_inner">
            <div class="c-carousel_item"><a href="#">
                <picture>
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.avif" type="image/avif">
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.webp" type="image/webp"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.jpg" alt="Logo" width="1512" height="600">
                </picture></a></div>
            <div class="c-carousel_item"><a href="#">
                <picture>
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.avif" type="image/avif">
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/carousel.jpg" alt="Logo" loading="lazy" width="1512" height="600">
                </picture></a></div>
          </div>
        </div>
        <div class="l-container">
          <?php require_once( get_stylesheet_directory() . '/module/list_promotion.php' ); ?>
          <div class="m-product">
            <div class="m-product_top">
              <h4><?php _e('BEST SELLER', 'storefront') ?></h4>
              <div class="m-product__nav">
                <button class="m-product__prev">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M28.835 14.8699L27.065 13.0999L17.165 22.9999L27.065 32.8999L28.835 31.1299L20.705 22.9999L28.835 14.8699H28.835Z"></path>
                  </svg>
                </button>
                <button class="m-product__next">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M18.165 31.1301L19.935 32.9001L29.835 23.0001L19.935 13.1001L18.165 14.8701L26.295 23.0001L18.165 31.1301V31.1301Z" fill="#2B2929"></path>
                  </svg>
                </button>
              </div>
            </div>
            <div class="m-product__inner">
              <div class="m-product__gallery">
                 <a href="#">
                  <picture>
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.avif" type="image/avif">
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.webp" type="image/webp">
                    <img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" alt="Logo" loading="lazy" width="666" height="912">
                  </picture>
                </a>
              </div>
              <ul class="m-product__slick">
                <?php for ($i=0; $i < 2; $i++) { ?>
                  <li>
                    <ul>
                    <?php
                      $current_lang = $sitepress->get_current_language();
                      $cate_id = apply_filters( 'wpml_object_id', 142 , 'product_cat', TRUE  );
                      $count = 0;
                      // change category id here
                      $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 8,
                        'orderby' => 'date',
                        'suppress_filters' => 1,
                        'tax_query' => array(
                          array(
                            'taxonomy' => 'product_cat',
                            'terms' => $cate_id,
                            'operator' => 'IN',
                          ),
                      ),
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ) {
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <?php
                             $image = get_the_post_thumbnail_url(get_the_ID(), array(307, 307), array( 'class' => 'lazyload' ));
                            ?>
                            <li>
                              <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                <div class="m-product__img"></div>
                                <picture>
                                  <img class="lazyload" src="<?php !empty($image) ? print $image : print Placeholder; ?>" data-src="<?php !empty($image) ?  print $image : print Placeholder; ?>" alt="<?php the_title() ?>" loading="lazy" width="323" height="323">
                                </picture>
                              </a>
                              <div class="m-product__content">
                                <div class="m-product__content-top">
                                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <h3 class="strong"><?php the_title() ?></h3></a>
                                  <p>
                                    <?php echo wc_get_product( get_the_ID() )->get_price_html(); ?></p>
                                </div>
                                <div class="m-product__content-bottom">
                                  <p>
                                    <span>
                                      <?php $product->get_attribute( 'mau-sac' ) ?  print 'M??u s???c: '. $product->get_attribute( 'mau-sac' ) : ""; ?>
                                    <span>
                                      <br>
                                    <span class="time">
                                      <?php
                                        if( has_term( '8h', 'product_cat', $product->get_id() ) ) {
                                          echo('8h/ng??y');
                                        }
                                        if( has_term( '10h', 'product_cat', $product->get_id() ) ) {
                                          echo('10h/ng??y');
                                        }
                                        if( has_term( '12h', 'product_cat', $product->get_id() ) ) {
                                          echo('12h/ng??y');
                                        }
                                        if( has_term( '14h', 'product_cat', $product->get_id() ) ) {
                                          echo('14h/ng??y');
                                        }
                                        if( has_term( '24h', 'product_cat', $product->get_id() ) ) {
                                          echo('24h/ng??y');
                                        }
                                      ?>
                                     <span>
                                       <?php
                                         if( has_term( 'lens-3-thang', 'product_cat', $product->get_id() ) ) {
                                          echo('| 3 th??ng');
                                        }
                                       ?>
                                       <?php
                                         if( has_term( 'lens-1-ngay', 'product_cat', $product->get_id() ) ) {
                                          echo('| Lens 1 ng??y');
                                        }
                                       ?>
                                      </span>
                                    </span>
                                  </p>
                                  <div class="btn_area">
                                    <a class="btn_area__add" href="#"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" alt="th??m v??o m???c y??u th??ch" loading="lazy" width="16" height="20"></a>
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                  </div>
                              </div>
                            </li>

                        <?php
                        $count++;
                        endwhile;
                      }
                    ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="m-product">
            <div class="m-product_top">
              <h4><?php _e('SCHOOL-TO-WORK CONTACT LENSES', 'storefront') ?></h4>
              <div class="m-product__nav">
                <button class="m-product__prev">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M28.835 14.8699L27.065 13.0999L17.165 22.9999L27.065 32.8999L28.835 31.1299L20.705 22.9999L28.835 14.8699H28.835Z"></path>
                  </svg>
                </button>
                <button class="m-product__next">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M18.165 31.1301L19.935 32.9001L29.835 23.0001L19.935 13.1001L18.165 14.8701L26.295 23.0001L18.165 31.1301V31.1301Z" fill="#2B2929"></path>
                  </svg>
                </button>
              </div>
            </div>
            <div class="m-product__inner">
              <div class="m-product__gallery">
                 <a href="#">
                  <picture>
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.avif" type="image/avif">
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" alt="Logo" loading="lazy" width="666" height="912">
                  </picture>
                </a>
              </div>
              <ul class="m-product__slick">
                <?php for ($i=0; $i < 2; $i++) { ?>
                  <li>
                    <ul>
                    <?php
                      $current_lang = $sitepress->get_current_language();
                      $cate_id = apply_filters( 'wpml_object_id', 63 , 'product_cat', TRUE  );
                      $count = 0;
                      // change category id here
                      $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 8,
                        'orderby' => 'date',
                        'suppress_filters' => 1,
                        'tax_query' => array(
                          array(
                            'taxonomy' => 'product_cat',
                            'terms' => $cate_id,
                            'operator' => 'IN',
                          ),
                      ),
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ) {
                        $firstLoop = true;
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <?php
                             $image = get_the_post_thumbnail_url(get_the_ID(), array(307, 307), array( 'class' => 'lazyload' ));
                            ?>
                            <li>
                              <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                <div class="m-product__img"></div>
                                <picture>
                                  <img class="lazyload" src="<?php !empty($image) ? print $image : print Placeholder; ?>" data-src="<?php !empty($image) ?  print $image : print Placeholder; ?>" alt="<?php the_title() ?>" loading="lazy" width="323" height="323">
                                </picture>
                              </a>
                              <div class="m-product__content">
                                <div class="m-product__content-top">
                                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <h3 class="strong"><?php the_title() ?></h3></a>
                                  <p>
                                    <?php echo wc_get_product( get_the_ID() )->get_price_html(); ?></p>
                                </div>
                                <div class="m-product__content-bottom">
                                  <p>
                                    <span>
                                      <?php $product->get_attribute( 'mau-sac' ) ?  print 'M??u s???c: '. $product->get_attribute( 'mau-sac' ) : ""; ?>
                                    <span>
                                      <br>
                                    <span class="time">
                                      <?php
                                        if( has_term( '8h', 'product_cat', $product->get_id() ) ) {
                                          echo('8h/ng??y');
                                        }
                                        if( has_term( '10h', 'product_cat', $product->get_id() ) ) {
                                          echo('10h/ng??y');
                                        }
                                        if( has_term( '12h', 'product_cat', $product->get_id() ) ) {
                                          echo('12h/ng??y');
                                        }
                                        if( has_term( '14h', 'product_cat', $product->get_id() ) ) {
                                          echo('14h/ng??y');
                                        }
                                        if( has_term( '24h', 'product_cat', $product->get_id() ) ) {
                                          echo('24h/ng??y');
                                        }
                                      ?>
                                     <span>
                                       <?php
                                         if( has_term( 'lens-3-thang', 'product_cat', $product->get_id() ) ) {
                                          echo('| 3 th??ng');
                                        }
                                       ?>
                                       <?php
                                         if( has_term( 'lens-1-ngay', 'product_cat', $product->get_id() ) ) {
                                          echo('| Lens 1 ng??y');
                                        }
                                       ?>
                                      </span>
                                    </span>
                                  </p>
                                  <div class="btn_area">
                                    <a class="btn_area__add" href="#"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" alt="th??m v??o m???c y??u th??ch" loading="lazy" width="16" height="20"></a>
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                  </div>
                              </div>
                            </li>
                        <?php
                        $count++;
                        endwhile;
                      }
                    ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="m-product">
            <div class="m-product_top">
              <h4><?php _e('LIGHT COLOR - HANG OUT, TAKE A PHOTO', 'storefront') ?></h4>
              <div class="m-product__nav">
                <button class="m-product__prev">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M28.835 14.8699L27.065 13.0999L17.165 22.9999L27.065 32.8999L28.835 31.1299L20.705 22.9999L28.835 14.8699H28.835Z"></path>
                  </svg>
                </button>
                <button class="m-product__next">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M18.165 31.1301L19.935 32.9001L29.835 23.0001L19.935 13.1001L18.165 14.8701L26.295 23.0001L18.165 31.1301V31.1301Z" fill="#2B2929"></path>
                  </svg>
                </button>
              </div>
            </div>
            <div class="m-product__inner">
              <div class="m-product__gallery">
                 <a href="#">
                  <picture>
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.avif" type="image/avif">
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.webp" type="image/webp">
                    <img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" alt="<?php the_title() ?>" loading="lazy" width="666" height="912">
                  </picture>
                </a>
              </div>
              <ul class="m-product__slick">
                <?php for ($i=0; $i < 2; $i++) { ?>
                  <li>
                    <ul>
                    <?php
                      $current_lang = $sitepress->get_current_language();
                      $cate_id = apply_filters( 'wpml_object_id', 64 , 'product_cat', TRUE  );
                      $count = 0;
                      // change category id here
                      $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 8,
                        'orderby' => 'date',
                        'suppress_filters' => 1,
                        'tax_query' => array(
                          array(
                            'taxonomy' => 'product_cat',
                            'terms' => $cate_id,
                            'operator' => 'IN',
                          ),
                      ),
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ) {
                        $firstLoop = true;
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>

<?php
                             $image = get_the_post_thumbnail_url(get_the_ID(), array(307, 307), array( 'class' => 'lazyload' ));
                            ?>
                            <li>
                              <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                <div class="m-product__img"></div>
                                <picture>
                                  <img class="lazyload" src="<?php !empty($image) ? print $image : print Placeholder; ?>" data-src="<?php !empty($image) ?  print $image : print Placeholder; ?>" alt="<?php the_title() ?>" loading="lazy" width="323" height="323">
                                </picture>
                              </a>
                              <div class="m-product__content">
                                <div class="m-product__content-top">
                                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <h3 class="strong"><?php the_title() ?></h3></a>
                                  <p>
                                    <?php echo wc_get_product( get_the_ID() )->get_price_html(); ?></p>
                                </div>
                                <div class="m-product__content-bottom">
                                  <p>
                                    <span>
                                      <?php $product->get_attribute( 'mau-sac' ) ?  print 'M??u s???c: '. $product->get_attribute( 'mau-sac' ) : ""; ?>
                                    <span>
                                      <br>
                                    <span class="time">
                                      <?php
                                        if( has_term( '8h', 'product_cat', $product->get_id() ) ) {
                                          echo('8h/ng??y');
                                        }
                                        if( has_term( '10h', 'product_cat', $product->get_id() ) ) {
                                          echo('10h/ng??y');
                                        }
                                        if( has_term( '12h', 'product_cat', $product->get_id() ) ) {
                                          echo('12h/ng??y');
                                        }
                                        if( has_term( '14h', 'product_cat', $product->get_id() ) ) {
                                          echo('14h/ng??y');
                                        }
                                        if( has_term( '24h', 'product_cat', $product->get_id() ) ) {
                                          echo('24h/ng??y');
                                        }
                                      ?>
                                     <span>
                                       <?php
                                         if( has_term( 'lens-3-thang', 'product_cat', $product->get_id() ) ) {
                                          echo('| 3 th??ng');
                                        }
                                       ?>
                                       <?php
                                         if( has_term( 'lens-1-ngay', 'product_cat', $product->get_id() ) ) {
                                          echo('| Lens 1 ng??y');
                                        }
                                       ?>
                                      </span>
                                    </span>
                                  </p>
                                  <div class="btn_area">
                                    <a class="btn_area__add" href="#"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" alt="th??m v??o m???c y??u th??ch" loading="lazy" width="16" height="20"></a>
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                  </div>
                              </div>
                            </li>
                        <?php
                        $count++;
                        endwhile;
                      }
                    ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="m-product">
            <div class="m-product_top">
              <h4><?php _e('FOR MEN', 'storefront') ?></h4>
              <div class="m-product__nav">
                <button class="m-product__prev">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M28.835 14.8699L27.065 13.0999L17.165 22.9999L27.065 32.8999L28.835 31.1299L20.705 22.9999L28.835 14.8699H28.835Z"></path>
                  </svg>
                </button>
                <button class="m-product__next">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M18.165 31.1301L19.935 32.9001L29.835 23.0001L19.935 13.1001L18.165 14.8701L26.295 23.0001L18.165 31.1301V31.1301Z" fill="#2B2929"></path>
                  </svg>
                </button>
              </div>
            </div>
            <div class="m-product__inner">
              <div class="m-product__gallery">
                 <a href="#">
                  <picture>
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.avif" type="image/avif">
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.webp" type="image/webp">
                    <img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" alt="<?php the_title() ?>" loading="lazy" width="666" height="912">
                  </picture>
                </a>
              </div>
              <ul class="m-product__slick">
                <?php for ($i=0; $i < 2; $i++) { ?>
                  <li>
                    <ul>
                    <?php
                      $current_lang = $sitepress->get_current_language();
                      $cate_id = apply_filters( 'wpml_object_id', 61 , 'product_cat', TRUE  );
                      $count = 0;
                      // change category id here
                      $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 8,
                        'orderby' => 'date',
                        'suppress_filters' => 1,
                        'tax_query' => array(
                          array(
                            'taxonomy' => 'product_cat',
                            'terms' => $cate_id,
                            'operator' => 'IN',
                          ),
                      ),
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ) {
                        $firstLoop = true;
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <?php
                             $image = get_the_post_thumbnail_url(get_the_ID(), array(307, 307), array( 'class' => 'lazyload' ));
                            ?>
                            <li>
                              <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                <div class="m-product__img"></div>
                                <picture>
                                  <img class="lazyload" src="<?php !empty($image) ? print $image : print Placeholder; ?>" data-src="<?php !empty($image) ?  print $image : print Placeholder; ?>" alt="<?php the_title() ?>" loading="lazy" width="323" height="323">
                                </picture>
                              </a>
                              <div class="m-product__content">
                                <div class="m-product__content-top">
                                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <h3 class="strong"><?php the_title() ?></h3></a>
                                  <p>
                                    <?php echo wc_get_product( get_the_ID() )->get_price_html(); ?></p>
                                </div>
                                <div class="m-product__content-bottom">
                                  <p>
                                    <span>
                                      <?php $product->get_attribute( 'mau-sac' ) ?  print 'M??u s???c: '. $product->get_attribute( 'mau-sac' ) : ""; ?>
                                    <span>
                                      <br>
                                    <span class="time">
                                      <?php
                                        if( has_term( '8h', 'product_cat', $product->get_id() ) ) {
                                          echo('8h/ng??y');
                                        }
                                        if( has_term( '10h', 'product_cat', $product->get_id() ) ) {
                                          echo('10h/ng??y');
                                        }
                                        if( has_term( '12h', 'product_cat', $product->get_id() ) ) {
                                          echo('12h/ng??y');
                                        }
                                        if( has_term( '14h', 'product_cat', $product->get_id() ) ) {
                                          echo('14h/ng??y');
                                        }
                                        if( has_term( '24h', 'product_cat', $product->get_id() ) ) {
                                          echo('24h/ng??y');
                                        }
                                      ?>
                                     <span>
                                       <?php
                                         if( has_term( 'lens-3-thang', 'product_cat', $product->get_id() ) ) {
                                          echo('| 3 th??ng');
                                        }
                                       ?>
                                       <?php
                                         if( has_term( 'lens-1-ngay', 'product_cat', $product->get_id() ) ) {
                                          echo('| Lens 1 ng??y');
                                        }
                                       ?>
                                      </span>
                                    </span>
                                  </p>
                                  <div class="btn_area">
                                    <a class="btn_area__add" href="#"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" alt="th??m v??o m???c y??u th??ch" loading="lazy" width="16" height="20"></a>
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                  </div>
                              </div>
                            </li>
                        <?php
                        $count++;
                        endwhile;
                      }
                    ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="m-product">
            <div class="m-product_top">
              <h4><?php _e('SPECIALIZED MEDICAL CONTACT LENSES', 'storefront') ?></h4>
              <div class="m-product__nav">
                <button class="m-product__prev">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M28.835 14.8699L27.065 13.0999L17.165 22.9999L27.065 32.8999L28.835 31.1299L20.705 22.9999L28.835 14.8699H28.835Z"></path>
                  </svg>
                </button>
                <button class="m-product__next">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M18.165 31.1301L19.935 32.9001L29.835 23.0001L19.935 13.1001L18.165 14.8701L26.295 23.0001L18.165 31.1301V31.1301Z" fill="#2B2929"></path>
                  </svg>
                </button>
              </div>
            </div>
            <div class="m-product__inner">
              <div class="m-product__gallery">
                 <a href="#">
                  <picture>
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.avif" type="image/avif">
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.webp" type="image/webp">
                    <img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" alt="<?php the_title() ?>" loading="lazy" width="666" height="912">
                  </picture>
                </a>
              </div>
              <ul class="m-product__slick">
                <?php for ($i=0; $i < 2; $i++) { ?>
                  <li>
                    <ul>
                    <?php
                      $current_lang = $sitepress->get_current_language();
                      $cate_id = apply_filters( 'wpml_object_id', 68 , 'product_cat', TRUE  );
                      $count = 0;
                      // change category id here
                      $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 8,
                        'orderby' => 'date',
                        'suppress_filters' => 1,
                        'tax_query' => array(
                          array(
                            'taxonomy' => 'product_cat',
                            'terms' => $cate_id,
                            'operator' => 'IN',
                          ),
                      ),
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ) {
                        $firstLoop = true;
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <?php
                             $image = get_the_post_thumbnail_url(get_the_ID(), array(307, 307), array( 'class' => 'lazyload' ));
                            ?>
                            <li>
                              <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                <div class="m-product__img"></div>
                                <picture>
                                  <img class="lazyload" src="<?php !empty($image) ? print $image : print Placeholder; ?>" data-src="<?php !empty($image) ?  print $image : print Placeholder; ?>" alt="<?php the_title() ?>" loading="lazy" width="323" height="323">
                                </picture>
                              </a>
                              <div class="m-product__content">
                                <div class="m-product__content-top">
                                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <h3 class="strong"><?php the_title() ?></h3></a>
                                  <p>
                                    <?php echo wc_get_product( get_the_ID() )->get_price_html(); ?></p>
                                </div>
                                <div class="m-product__content-bottom">
                                  <p>
                                    <span>
                                      <?php $product->get_attribute( 'mau-sac' ) ?  print 'M??u s???c: '. $product->get_attribute( 'mau-sac' ) : ""; ?>
                                    <span>
                                      <br>
                                    <span class="time">
                                      <?php
                                        if( has_term( '8h', 'product_cat', $product->get_id() ) ) {
                                          echo('8h/ng??y');
                                        }
                                        if( has_term( '10h', 'product_cat', $product->get_id() ) ) {
                                          echo('10h/ng??y');
                                        }
                                        if( has_term( '12h', 'product_cat', $product->get_id() ) ) {
                                          echo('12h/ng??y');
                                        }
                                        if( has_term( '14h', 'product_cat', $product->get_id() ) ) {
                                          echo('14h/ng??y');
                                        }
                                        if( has_term( '24h', 'product_cat', $product->get_id() ) ) {
                                          echo('24h/ng??y');
                                        }
                                      ?>
                                     <span>
                                       <?php
                                         if( has_term( 'lens-3-thang', 'product_cat', $product->get_id() ) ) {
                                          echo('| 3 th??ng');
                                        }
                                       ?>
                                       <?php
                                         if( has_term( 'lens-1-ngay', 'product_cat', $product->get_id() ) ) {
                                          echo('| Lens 1 ng??y');
                                        }
                                       ?>
                                      </span>
                                    </span>
                                  </p>
                                  <div class="btn_area">
                                    <a class="btn_area__add" href="#"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" alt="th??m v??o m???c y??u th??ch" loading="lazy" width="16" height="20"></a>
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                  </div>
                              </div>
                            </li>
                        <?php
                        $count++;
                        endwhile;
                      }
                    ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="m-product">
            <div class="m-product_top">
              <h4><?php _e('CONTACT LENS ACCESSORIES', 'storefront') ?></h4>
              <div class="m-product__nav">
                <button class="m-product__prev">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M28.835 14.8699L27.065 13.0999L17.165 22.9999L27.065 32.8999L28.835 31.1299L20.705 22.9999L28.835 14.8699H28.835Z"></path>
                  </svg>
                </button>
                <button class="m-product__next">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M18.165 31.1301L19.935 32.9001L29.835 23.0001L19.935 13.1001L18.165 14.8701L26.295 23.0001L18.165 31.1301V31.1301Z" fill="#2B2929"></path>
                  </svg>
                </button>
              </div>
            </div>
            <div class="m-product__inner">
              <div class="m-product__gallery">
                 <a href="#">
                  <picture>
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.avif" type="image/avif">
                    <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.webp" type="image/webp">
                    <img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/m-product__gallery.jpg" alt="<?php the_title() ?>" loading="lazy" width="666" height="912">
                  </picture>
                </a>
              </div>
              <ul class="m-product__slick">
                <?php for ($i=0; $i < 2; $i++) { ?>
                  <li>
                    <ul>
                    <?php
                      $current_lang = $sitepress->get_current_language();
                      $cate_id = apply_filters( 'wpml_object_id', 75 , 'product_cat', TRUE  );
                      $count = 0;
                      // change category id here
                      $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 8,
                        'orderby' => 'date',
                        'suppress_filters' => 1,
                        'tax_query' => array(
                          array(
                            'taxonomy' => 'product_cat',
                            'terms' => $cate_id,
                            'operator' => 'IN',
                          ),
                      ),
                      );
                      $loop = new WP_Query( $args );
                      if ( $loop->have_posts() ) {
                        $firstLoop = true;
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <?php
                             $image = get_the_post_thumbnail_url(get_the_ID(), array(307, 307), array( 'class' => 'lazyload' ));
                            ?>
                            <li>
                              <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                <div class="m-product__img"></div>
                                <picture>
                                  <img class="lazyload" src="<?php !empty($image) ? print $image : print Placeholder; ?>" data-src="<?php !empty($image) ?  print $image : print Placeholder; ?>" alt="<?php the_title() ?>" loading="lazy" width="323" height="323">
                                </picture>
                              </a>
                              <div class="m-product__content">
                                <div class="m-product__content-top">
                                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <h3 class="strong"><?php the_title() ?></h3></a>
                                  <p>
                                    <?php echo wc_get_product( get_the_ID() )->get_price_html(); ?></p>
                                </div>
                                <div class="m-product__content-bottom">
                                  <p>
                                    <span>
                                      <?php $product->get_attribute( 'mau-sac' ) ?  print 'M??u s???c: '. $product->get_attribute( 'mau-sac' ) : ""; ?>
                                    <span>
                                      <br>
                                    <span class="time">
                                      <?php
                                        if( has_term( '8h', 'product_cat', $product->get_id() ) ) {
                                          echo('8h/ng??y');
                                        }
                                        if( has_term( '10h', 'product_cat', $product->get_id() ) ) {
                                          echo('10h/ng??y');
                                        }
                                        if( has_term( '12h', 'product_cat', $product->get_id() ) ) {
                                          echo('12h/ng??y');
                                        }
                                        if( has_term( '14h', 'product_cat', $product->get_id() ) ) {
                                          echo('14h/ng??y');
                                        }
                                        if( has_term( '24h', 'product_cat', $product->get_id() ) ) {
                                          echo('24h/ng??y');
                                        }
                                      ?>
                                     <span>
                                       <?php
                                         if( has_term( 'lens-3-thang', 'product_cat', $product->get_id() ) ) {
                                          echo('| 3 th??ng');
                                        }
                                       ?>
                                       <?php
                                         if( has_term( 'lens-1-ngay', 'product_cat', $product->get_id() ) ) {
                                          echo('| Lens 1 ng??y');
                                        }
                                       ?>
                                      </span>
                                    </span>
                                  </p>
                                  <div class="btn_area">
                                    <a class="btn_area__add" href="#"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/note_add.svg" alt="th??m v??o m???c y??u th??ch" loading="lazy" width="16" height="20"></a>
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                  </div>
                              </div>
                            </li>
                        <?php
                        $count++;
                        endwhile;
                      }
                    ?>
                    </ul>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="c-experience">
            <h4>NH???NG CON S??? BI???T N??I V?? TR???I NGHI???M MUA S???M</h4>
            <div class="c-experience__inner">
              <div class="image">
                <picture>
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/experience.avif" type="image/avif">
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/experience.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/experience.png" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/experience.png" alt="NH???NG CON S??? BI???T N??I V?? TR???I NGHI???M MUA S???M" loading="lazy" width="552" height="462">
                </picture>
              </div>
              <ul>
                <li>
                  <h5>H??n 30.000 kh??ch h??ng m???i n??m</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </li>
                <li>
                  <h5>7 n??m kinh nghi???m</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </li>
                <li>
                  <h5>H??n 50 m???u m?? l???a ch???n</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </li>
              </ul>
            </div>
          </div>
          <div class="c-shopservice">
            <div class="c-shopservice__inner">
              <div class="c-shopservice__item">
                <h5 class="ttl">PH????NG CH??M B??N H??NG</h5>
                <picture>
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.avif" type="image/avif">
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" alt="service01" loading="lazy" width="323" height="520">
                </picture>
              </div>
              <div class="c-shopservice__item">
                <h5 class="ttl">S???N PH???M V?? D???CH V???</h5>
                <picture>
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.avif" type="image/avif">
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" alt="service01" loading="lazy" width="323" height="520">
                </picture>
              </div>
              <div class="c-shopservice__item">
                <h5 class="ttl">CH??M S??C KH??CH H??NG</h5>
                <picture>
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.avif" type="image/avif">
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" alt="service01" loading="lazy" width="323" height="520">
                </picture>
              </div>
              <div class="c-shopservice__item">
                <h5 class="ttl">GIAO H??NG, ?????I TR??? V?? B???O H??NH</h5>
                <picture>
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.avif" type="image/avif">
                  <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/service01.jpg" alt="service01" loading="lazy" width="323" height="520">
                </picture>
              </div>
            </div>
          </div>
          <div class="m-product">
            <div class="m-product_top">
              <h4>TIN T???C</h4>
              <div class="m-product__nav">
                <button class="m-product__prev m-new__prev">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M28.835 14.8699L27.065 13.0999L17.165 22.9999L27.065 32.8999L28.835 31.1299L20.705 22.9999L28.835 14.8699H28.835Z"></path>
                  </svg>
                </button>
                <button class="m-product__next m-new__next">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="22" stroke-width="2"></circle>
                    <path d="M18.165 31.1301L19.935 32.9001L29.835 23.0001L19.935 13.1001L18.165 14.8701L26.295 23.0001L18.165 31.1301V31.1301Z" fill="#2B2929"></path>
                  </svg>
                </button>
              </div>
            </div>
            <ul class="m-new__slick w-100">
              <li><a href>
                  <div class="m-new__img">
                    <picture>
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.avif" type="image/avif">
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" alt="item new" loading="lazy" width="437" height="278">
                    </picture>
                  </div>
                  <div class="m-new__content">
                    <h3 class="strong">H?????ng d???n c??c b?????c skincare t??? c?? b???n t???i n??ng cao</h3>
                    <p class="m-date"><i class="gg-calendar-dates"></i>Th??ng S??u 18, 2021</p>
                    <p>?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v?? ?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v??...</p>
                  </div></a></li>
              <li><a href>
                  <div class="m-new__img">
                    <picture>
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.avif" type="image/avif">
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" alt="item new" loading="lazy" width="437" height="278">
                    </picture>
                  </div>
                  <div class="m-new__content">
                    <h3 class="strong">H?????ng d???n c??c b?????c skincare t??? c?? b???n t???i n??ng cao</h3>
                    <p class="m-date"><i class="gg-calendar-dates"></i>Th??ng S??u 18, 2021</p>
                    <p>?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v?? ?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v??...</p>
                  </div></a></li>
              <li><a href>
                  <div class="m-new__img">
                    <picture>
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.avif" type="image/avif">
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" alt="item new" loading="lazy" width="437" height="278">
                    </picture>
                  </div>
                  <div class="m-new__content">
                    <h3 class="strong">H?????ng d???n c??c b?????c skincare t??? c?? b???n t???i n??ng cao</h3>
                    <p class="m-date"><i class="gg-calendar-dates"></i>Th??ng S??u 18, 2021</p>
                    <p>?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v?? ?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v??...</p>
                  </div></a></li>
              <li><a href>
                  <div class="m-new__img">
                    <picture>
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.avif" type="image/avif">
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" alt="item new" loading="lazy" width="437" height="278">
                    </picture>
                  </div>
                  <div class="m-new__content">
                    <h3 class="strong">H?????ng d???n c??c b?????c skincare t??? c?? b???n t???i n??ng cao</h3>
                    <p class="m-date"><i class="gg-calendar-dates"></i>Th??ng S??u 18, 2021</p>
                    <p>?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v?? ?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v??...</p>
                  </div></a></li>
              <li><a href>
                  <div class="m-new__img">
                    <picture>
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.avif" type="image/avif">
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" alt="item new" loading="lazy" width="437" height="278">
                    </picture>
                  </div>
                  <div class="m-new__content">
                    <h3 class="strong">H?????ng d???n c??c b?????c skincare t??? c?? b???n t???i n??ng cao</h3>
                    <p class="m-date"><i class="gg-calendar-dates"></i>Th??ng S??u 18, 2021</p>
                    <p>?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v?? ?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v??...</p>
                  </div></a></li>
              <li><a href>
                  <div class="m-new__img">
                    <picture>
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.avif" type="image/avif">
                      <source srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.webp" type="image/webp"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" data-src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/item-new.jpg" alt="item new" loading="lazy" width="437" height="278">
                    </picture>
                  </div>
                  <div class="m-new__content">
                    <h3 class="strong">H?????ng d???n c??c b?????c skincare t??? c?? b???n t???i n??ng cao</h3>
                    <p class="m-date"><i class="gg-calendar-dates"></i>Th??ng S??u 18, 2021</p>
                    <p>?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v?? ?????i v???i c??c t??n ????? l??m ?????p, ch???c h???n thu???t ng??? skincare ???? d???n tr??? n??n quen thu???c v??...</p>
                  </div></a></li>
            </ul>
          </div>
        </div>
      </main>
<?php
get_footer();
