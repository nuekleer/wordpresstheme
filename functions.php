<?php
/**
 * Demanes functions and definitions
 */

?>
<?php

add_theme_support( 'post-thumbnails' ); 
// Clean up the <head>
function removeHeadLinks() {
   	remove_action('wp_head', 'rsd_link');
   	remove_action('wp_head', 'wlwmanifest_link');
   	remove_action('wp_head', 'wp_generator');
   	remove_action('wp_head', 'start_post_rel_link');
   	remove_action('wp_head', 'index_rel_link');
   	remove_action('wp_head', 'adjacent_posts_rel_link');
}
	
add_action('init', 'removeHeadLinks');

function unregister_default_wp_widgets() {
   	unregister_widget('WP_Widget_Pages');
   	unregister_widget('WP_Widget_Calendar');
   	unregister_widget('WP_Widget_Archives');
   	unregister_widget('WP_Widget_Links');
   	unregister_widget('WP_Widget_Meta');
   	//unregister_widget('WP_Widget_Search');
   	//unregister_widget('WP_Widget_Text');
   	unregister_widget('WP_Widget_Categories');
   	//unregister_widget('WP_Widget_Recent_Posts');
   	unregister_widget('WP_Widget_Recent_Comments');
   	unregister_widget('WP_Widget_RSS');
   	//unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

if (!function_exists('disableAdminBar')) {  
      
        function disableAdminBar(){  
      
        //remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 ); // for the admin page  
        remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); // for the front end  
      
        //function remove_admin_bar_style_backend() {  // css override for the admin page  
        //  echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';  
        //}  
      
        //add_filter('admin_head','remove_admin_bar_style_backend');  
      
        function remove_admin_bar_style_frontend() { // css override for the frontend  
          echo '<style type="text/css" media="screen"> 
          html { margin-top: 0px !important; } 
          * html body { margin-top: 0px !important; } 
          </style>';  
        }  
      
        add_filter('wp_head','remove_admin_bar_style_frontend', 99);  
      
      }  
      
    }  
      
    //add_filter('admin_head','remove_admin_bar_style_backend'); // Original version  
    add_action('init','disableAdminBar');





function theme_name_scripts() {
  if( !is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"), false, '1.11.0');
    wp_enqueue_script('jquery');
  }

	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'style-main', get_stylesheet_uri() );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js' );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

function theme_setup_menus(){
	register_nav_menu( 'primary', 'Header Menu' );
	register_nav_menu( 'secondary', 'Footer Menu' );
}

add_action( 'after_setup_theme', 'theme_setup_menus' );

register_sidebar(array(
  'name' => 'Home Page Sidebar',
  'id' => 'homepage-sidebar',
));

register_sidebar(array(
  'name' => 'Blog Sidebar',
  'id' => 'blog-sidebar',
));

//menus styling
require_once('wp_bootstrap_navwalker.php');

function add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
  $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');

//slider

add_action('init', 'demanes_slider_post_type');

function demanes_slider_post_type() {
  register_post_type( 'slider',
    array(
      'labels' => array(
        'name' => 'Sliders',
        'singular_name' => 'Slider',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Slider',
        'edit' => 'Edit',
        'edit_item' => 'Edit Slider',
        'new_item' => 'New Slider',
        'view' => 'View',
        'view_item' => 'View Slider',
        'search_items' => 'Search Sliders',
        'not_found' => 'No Sliders found',
        'not_found_in_trash' => 'No Sliders found in Trash',
        'parent' => 'Parent Slider'
      ),
      'public' => true,
      'menu_position' => 20,
      'supports' => array( 'title', 'thumbnail'),
      'taxonomies' => array( '' ),
      'menu_icon' => 'dashicons-format-gallery',
      'has_archive' => true
    )
  );  

}

add_action('init', 'demanes_product_post_type');

function demanes_product_post_type() {
  register_post_type( 'product',
    array(
      'labels' => array(
        'name' => 'Products',
        'singular_name' => 'Product',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Product',
        'edit' => 'Edit',
        'edit_item' => 'Edit Product',
        'new_item' => 'New Product',
        'view' => 'View',
        'view_item' => 'View Product',
        'search_items' => 'Search Products',
        'not_found' => 'No Products found',
        'not_found_in_trash' => 'No Products found in Trash',
        'parent' => 'Parent Product'
      ),
      'public' => true,
      'menu_position' => 20,
      'supports' => array( 'title', 'editor', 'thumbnail'),
      'taxonomies' => array( 'category' ),
      'menu_icon' => 'dashicons-cart',
      'has_archive' => true
    )
  );  

}

add_action('init', 'demanes_store_hours_post_type');

function demanes_store_hours_post_type() {
  register_post_type( 'store-hours',
    array(
      'labels' => array(
        'name' => 'Store Hours',
        'singular_name' => 'Store Hour',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Store Hour',
        'edit' => 'Edit',
        'edit_item' => 'Edit Store Hour',
        'new_item' => 'New Store Hour',
        'view' => 'View',
        'view_item' => 'View Store Hour',
        'search_items' => 'Search Store Hours',
        'not_found' => 'No Store Hours found',
        'not_found_in_trash' => 'No Store Hours found in Trash',
        'parent' => 'Parent Store Hour'
      ),
      'public' => true,
      'menu_position' => 20,
      'supports' => array( 'title'),
      'taxonomies' => array( '' ),
      'menu_icon' => get_bloginfo('template_directory'). '/images/alarmclockicon.png',
      'has_archive' => true,
      'register_meta_box_cb' => 'add_store_hours_metaboxes'
    )
  );
}

add_action( 'add_meta_boxes', 'add_store_hours_metaboxes' );

function add_store_hours_metaboxes() {
    add_meta_box('store_hour_time', 'Store Hour', 'store_hour_time', 'store-hours', 'normal', 'default');
}

function store_hour_time(){
  global $wpdb;
  global $post;
  $values = get_post_custom( $post->ID );
  $store_hour = isset( $values['demanes_meta_box_store_hour'] ) ? esc_attr( $values['demanes_meta_box_store_hour'][0] ) : '';
  wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
  ?>
  <p>
    <label for="demanes_meta_box_store_hour">Store Hour</label>
    <input type="text" name="demanes_meta_box_store_hour" id="demanes_meta_box_store_hour" value="<?php echo $store_hour; ?>" />
  </p>
  <?php 
}

add_action( 'save_post', 'demanes_meta_box_save_store_hours' );
function demanes_meta_box_save_store_hours( $post_id )
{
  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  
  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
  
  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_posts' ) ) return;
  
  // now we can actually save the data
  $allowed = array( 
    'a' => array( // on allow a tags
      'href' => array() // and those anchords can only have href attribute
    )
  );
  
  // Probably a good idea to make sure your data is set
  if( isset( $_POST['demanes_meta_box_store_hour'] ) )
    update_post_meta( $post_id, 'demanes_meta_box_store_hour', wp_kses( esc_attr($_POST['demanes_meta_box_store_hour']), $allowed ) );
  
  
}

add_action('init', 'demanes_store_tour_post_type');

function demanes_store_tour_post_type() {
  register_post_type( 'store-tour',
    array(
      'labels' => array(
        'name' => 'Store Tour',
        'singular_name' => 'Store Tour',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Store Tour Image',
        'edit' => 'Edit',
        'edit_item' => 'Edit Store Tour',
        'new_item' => 'New Store Tour',
        'view' => 'View',
        'view_item' => 'View Store Tour',
        'search_items' => 'Search Store Tour Images',
        'not_found' => 'No Store Tour Images found',
        'not_found_in_trash' => 'No Store Tour Images found in Trash',
        'parent' => 'Parent Store Tour'
      ),
      'public' => true,
      'menu_position' => 20,
      'supports' => array( 'title', 'thumbnail'),
      'taxonomies' => array( '' ),
      'menu_icon' => 'dashicons-visibility',
      'has_archive' => true,
      'register_meta_box_cb' => 'add_store_tour_metaboxes'
    )
  );
}

add_action( 'add_meta_boxes', 'add_store_tour_metaboxes' );

function add_store_tour_metaboxes() {
    add_meta_box('demanes_store_tour_metabox', 'Caption', 'store_tour_caption', 'store-tour', 'normal', 'default');
}

function store_tour_caption(){
  global $wpdb;
  global $post;
  $values = get_post_custom( $post->ID );
  $store_tour_caption = isset( $values['demanes_meta_box_store_tour_caption'] ) ? esc_attr( $values['demanes_meta_box_store_tour_caption'][0] ) : '';
  wp_nonce_field( 'my_meta_box_store_tour_nonce', 'meta_box_store_tour_nonce' );
  ?>
  <p>
    <label for="demanes_meta_box_store_tour_caption">Caption</label>
    <input type="text" name="demanes_meta_box_store_tour_caption" id="demanes_meta_box_store_tour_caption" value="<?php echo $store_tour_caption; ?>" />
  </p>
  <?php
}

add_action( 'save_post', 'demanes_meta_box_save_store_tour_caption' );
function demanes_meta_box_save_store_tour_caption( $post_id )
{
  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  
  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_store_tour_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_store_tour_nonce'], 'my_meta_box_store_tour_nonce' ) ) return;
  
  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_posts' ) ) return;
  
  // now we can actually save the data
  $allowed = array(
    'a' => array( // on allow a tags
      'href' => array() // and those anchords can only have href attribute
    )
  );
  
  // Probably a good idea to make sure your data is set
  if( isset( $_POST['demanes_meta_box_store_tour_caption'] ) )
    update_post_meta( $post_id, 'demanes_meta_box_store_tour_caption', wp_kses( esc_attr($_POST['demanes_meta_box_store_tour_caption']), $allowed ) );
  
  
}


add_action('init', 'demanes_brands_post_type');

function demanes_brands_post_type() {
  register_post_type( 'brands',
    array(
      'labels' => array(
        'name' => 'Brands',
        'singular_name' => 'Brand',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Brand',
        'edit' => 'Edit',
        'edit_item' => 'Edit Brand',
        'new_item' => 'New Brand',
        'view' => 'View',
        'view_item' => 'View Brand',
        'search_items' => 'Search Brands',
        'not_found' => 'No Brands found',
        'not_found_in_trash' => 'No Brands found in Trash',
        'parent' => 'Parent Brand'
      ),
      'public' => true,
      'menu_position' => 20,
      'supports' => array( 'title', 'thumbnail'),
      'taxonomies' => array( '' ),
      'menu_icon' => 'dashicons-tag',
      'has_archive' => true,
      'register_meta_box_cb' => 'add_brands_metaboxes'
    )
  );
}

add_action( 'add_meta_boxes', 'add_brands_metaboxes' );

function add_brands_metaboxes() {
    add_meta_box('demanes_brands_metabox', 'Brand Link', 'brand_link_callback', 'brands', 'normal', 'default');
}

function brand_link_callback(){
  global $wpdb;
  global $post;
  $values = get_post_custom( $post->ID );
  $brand_link = isset( $values['demanes_meta_box_brand_link'] ) ? esc_attr( $values['demanes_meta_box_brand_link'][0] ) : '';
  wp_nonce_field( 'my_meta_box_brand_nonce', 'meta_box_brand_nonce' );
  ?>
  <p>
    <label for="demanes_meta_box_brand_link">Brand Link</label>
    <input type="text" name="demanes_meta_box_brand_link" id="demanes_meta_box_brand_link" value="<?php echo $brand_link; ?>" />
  </p>
  <?php
}

add_action( 'save_post', 'demanes_meta_box_save_brand_link' );
function demanes_meta_box_save_brand_link( $post_id )
{
  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
  
  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['meta_box_brand_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_brand_nonce'], 'my_meta_box_brand_nonce' ) ) return;
  
  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_posts' ) ) return;
  
  // now we can actually save the data
  $allowed = array(
    'a' => array( // on allow a tags
      'href' => array() // and those anchords can only have href attribute
    )
  );
  
  // Probably a good idea to make sure your data is set
  if( isset( $_POST['demanes_meta_box_brand_link'] ) )
    update_post_meta( $post_id, 'demanes_meta_box_brand_link', wp_kses( esc_attr($_POST['demanes_meta_box_brand_link']), $allowed ) );
  
  
}




class Recent_News_Widget extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'Recent_News_Widget', /* Name */'Recent News ', array( 'description' => 'Display recent news posts' ) );
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        ?>
        

        <!-- customer counter -->
        
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 recentNewsWidget">
            <h3><?php $recentNewsTitle = get_option('demanes_options'); echo $recentNewsTitle['recent_news_title'];?></h3>
            <?php
                $the_query = new WP_Query( array ( 'post_type' => 'post', 'order' => 'DESC', 'post_status' => 'publish', 'posts_per_page' => 2) );
                while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                ?>
                <div class="recentNewsTitle">
                    <a href="<?php echo the_permalink();?>"><?php the_title();
                ?></a></div>
                <div class="recentNewsExcerpt"><?php
                    $ex = '<p>';
                    $ex .= get_the_excerpt();
                    $ex .= '...  &raquo</p>';
                    echo $ex;
                ?></div><?php
                endwhile;
            ?>
        </div>
        
        
        
        <?php
    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        
    }

}

class Location_Widget extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'Location_Widget', /* Name */'Location ', array( 'description' => 'Display location information' ) );
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        ?>
        

        <!-- customer counter -->
        
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 locationWidget">
            <h3><?php $something = get_option('demanes_options'); echo $something['location_title']; ?></h3>
            <div class="locationAddressWrapper">
                <div class="locationTearDrop"><img src="wp-content/themes/demanes/images/map-tear-drop.png" /></div>
                <div class="locationAddress">
                    <div>
                        <?php $something = get_option('demanes_options'); echo $something['location_street']; ?>
                    </div>
                    <div>
                        <?php $something = get_option('demanes_options'); echo $something['location_city'];echo ', ';echo $something['location_state']; ?>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="locationMap">
                <?php $something = get_option('demanes_options'); echo $something['location_map']; ?>
            </div>
            <div class="locationMapUrl">
                <a href="<?php $something = get_option('demanes_options'); echo $something['location_url']; ?>"><?php $something = get_option('demanes_options'); echo $something['location_url_text']; ?></a>
            </div>
        </div>
        
        
        
        <?php
    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        
    }

}

class Store_Hours_Widget extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'Store_Hours_Widget', /* Name */'Store Hours ', array( 'description' => 'Display store hours' ) );
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        ?>
        

        <!-- customer counter -->
        
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 storeHoursWidget">
            <h3><?php $something = get_option('demanes_options'); echo $something['store_hours_title']; ?></h3>
            <?php
                $the_query = new WP_Query( array ( 'post_type' => 'store-hours', 'order' => 'ASC', 'post_status' => 'publish') );
                while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    echo '<div class="storeHoursContainer">';
                    echo '<div class="clockWrapper">';
                    echo '<img src="wp-content/themes/demanes/images/alarmclock.png" />';
                    echo '</div>';
                    echo '<div>';
                    the_title();
                    echo '</div>';
                    echo '<div>';
                    $hours = get_post_meta(get_the_ID(), 'demanes_meta_box_store_hour', true);
                    echo $hours;
                    echo '</div>';
                    echo '</div>';
                endwhile;
            ?>
        </div>
        
        
        
        <?php
    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        
    }

}


add_action( 'widgets_init', create_function( '', 'register_widget("Recent_News_Widget");' ) );
add_action( 'widgets_init', create_function( '', 'register_widget("Location_Widget");' ) );
add_action( 'widgets_init', create_function( '', 'register_widget("Store_Hours_Widget");' ) );

//shortcodes

function show_brands_in_page(){
    $brandcode = '';
    $the_query = 'showposts=-1&post_type=brands';
    query_posts($the_query);
    
    if (have_posts()) : while (have_posts()) : the_post();
        $thumbUrl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full');
        $blink = get_post_meta(get_the_ID(), 'demanes_meta_box_brand_link', true);
        
        $brandcode .='<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-bottom:15px;">';
        $brandcode .='<a href="'. $blink . '"><img src="'. $thumbUrl[0] . '" style="width:100%;height:auto;border:5px solid #1F1F1F"/></a>';
        $brandcode .= "</div>";
          
   endwhile; else:
   
      $brandcode = "No Brands Found. ";
      
   endif;
   
   wp_reset_query();
    
    return $brandcode;
}
add_shortcode('brands', 'show_brands_in_page');

function show_tour_in_page(){
    $storetour = '';
    $the_query = 'showposts=-1&post_type=store-tour';
    query_posts($the_query);
    $storetour.='
    <div id="myCarouselTour" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner">';
    $numPosts = 0;
    if (have_posts()) : while (have_posts()) : the_post();
    $thumbUrl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full');
    $tourcaption = get_post_meta(get_the_ID(), 'demanes_meta_box_store_tour_caption', true);
        $storetour .='
        
    <div class="item ' . ($numPosts == 0 ? "active" : ""). '">
      <img src="'. $thumbUrl[0] .'" alt="..." style="width:100%;height:auto;">
      <div class="carousel-caption">
        '. $tourcaption . '
      </div>
    </div>
  ';
          $numPosts++;
   endwhile; else:
   
      $storetour = "No Store Tour Images Found. ";
      
   endif;
   
   wp_reset_query();
   
   $storetour .= '
   </div>
   <!-- Controls -->
  <a class="left carousel-control" href="#myCarouselTour" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#myCarouselTour" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

';
    
    return $storetour;
}
add_shortcode('tour', 'show_tour_in_page');


//remove gallery
function  strip_shortcode_gallery( $content ) {
    preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if ($pos !== false)
                    return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
            }
        }
    }
    return $content;
}

?>