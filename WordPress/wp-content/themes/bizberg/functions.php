<?php
/**
 * Bizberg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bizberg
 */

if ( ! function_exists( 'bizberg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bizberg_setup() {
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_post_type_support( 'page', 'excerpt' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats' , array( 'aside', 'gallery' , 'standard', 'link', 'image' , 'quote', 'status', 'video', 'audio' , 'chat' ));

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bizberg' ),
			'footer' => esc_html__( 'Footer', 'bizberg' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_image_size( 'bizberg_medium', 300, 300, true );
		add_image_size( 'bizberg_gallery', 500, 400, true );
		add_image_size( 'bizberg_blog_list', 368, 240, true );
		add_image_size( 'bizberg_detail_image', 825, 400, true );
		add_image_size( 'bizberg_detail_image_no_sidebar', 920, 400, true );
		add_image_size( 'bizberg_portfolio_homepage', 600, 400, true );
		add_image_size( 'bizberg_blog_list_no_sidebar_1', 220, 190, true );
	}
endif;
add_action( 'after_setup_theme', 'bizberg_setup' );

add_filter( 'elegant_blocks_bootstrap', 'bizberg_bootstrap' );
function bizberg_bootstrap(){
	return true;
}

add_filter( 'elegant_blocks_fontawesome', 'bizberg_fontawesome' );
function bizberg_fontawesome(){
	return true;
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bizberg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bizberg_content_width', 640 );
}
add_action( 'after_setup_theme', 'bizberg_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bizberg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bizberg' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bizberg_widgets_init' );

/**
 * Enqueue scripts and styles backend.
 */

add_action( 'admin_enqueue_scripts', 'bizberg_custom_wp_admin_style' );
function bizberg_custom_wp_admin_style() {
    wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/icons/font-awesome-5/css/all.css' );
}

/**
 * Enqueue scripts and styles.
 */
function bizberg_scripts() {

	$my_theme = wp_get_theme();
	$current_version = $my_theme->get( 'Version' ); // Get theme Current Version

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/icons/font-awesome-5/css/all.css' );
	wp_enqueue_style( 'bizberg-main', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'bizberg-component', get_template_directory_uri() . '/assets/css/component.css' );

	wp_enqueue_style( 'bizberg-style2', get_template_directory_uri() . '/assets/css/style.css' , array() , '0.8' );
	wp_enqueue_style( 'bizberg-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
	wp_enqueue_style( 'bizberg-style', get_stylesheet_uri() );

	$scripts = array(
		array(
			'id' => 'bootstrap',
			'url' => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
			'footer' => false
		),
		array(
			'id' => 'mousescroll',
			'url' => get_template_directory_uri() . '/assets/js/jquery.mousewheel.min.js',
			'footer' => true
		),
		array(
			'id' => 'inview',
			'url' => get_template_directory_uri() . '/assets/js/jquery.inview.min.js',
			'footer' => true
		),
		array(
			'id' => 'slicknav',
			'url' => get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js',
			'footer' => true
		),
		array(
			'id' => 'matchHeight',
			'url' => get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js',
			'footer' => true
		),
		array(
			'id' => 'swiper',
			'url' => get_template_directory_uri() . '/assets/js/swiper.js',
			'footer' => true
		)
	);

	wp_enqueue_script('masonry');

	bizberg_add_scripts( $scripts , $current_version );

	wp_register_script( 'bizberg-custom' , get_template_directory_uri() . '/assets/js/custom.js' , array('jquery') , $current_version , true );

	$translation_array = array(
	   'admin_bar_status' => is_admin_bar_showing(),
	   'slider_loop' => bizberg_get_theme_mod( 'slider_loop_status' ),
	   'slider_speed' => bizberg_get_theme_mod( 'slider_speed' ),
	   'autoplay_delay' => bizberg_get_theme_mod( 'autoplay_delay' ),
	   'slider_grab_n_slider' => bizberg_get_theme_mod( 'slider_grab_n_slider' )
	);
	wp_localize_script( 'bizberg-custom', 'bizberg_object', $translation_array );
	 
	// Enqueued script with localized data.
	wp_enqueue_script( 'bizberg-custom' );

    wp_add_inline_style( 'bizberg-style', bizberg_inline_style() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'bizberg_scripts' );

function bizberg_inline_style(){

	$detail_page_img_position = get_theme_mod( 'detail_page_img_position' , 'left' );
	$slider_banner_status = bizberg_get_theme_mod( 'slider_banner' );

	// Gradient Slider
	$slider_primary_color = bizberg_get_theme_mod( 'slider_gradient_primary_color' );
	$slider_gradient_secondary_color = bizberg_get_theme_mod( 'slider_gradient_secondary_color' );

	$inline_css = '';
	if( $detail_page_img_position == 'center' ){
		$inline_css .= "
        .detail-content.single_page img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			text-align: center;
		}";
	}

	if( $slider_banner_status == 'none' ){
		$inline_css .= 'header#masthead {
		    border-bottom: 1px solid #eee;
		}';
	}

	$inline_css .= '.banner .slider .overlay {
	   background: linear-gradient(-90deg, ' . esc_attr( $slider_primary_color ) . ', ' . esc_attr( $slider_gradient_secondary_color ) . ');
	}';

	return apply_filters( 'bizberg_inline_style', $inline_css );

} 

function bizberg_add_scripts( $scripts, $current_version ){

	foreach ( $scripts as $key => $value ) {

		wp_enqueue_script( 
			$value['id'], 
			$value['url'], 
			array( 'jquery' ), 
			$current_version, 
			$value['footer'] 
		);

	}

}

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * WP Comment Walker
 */
require get_template_directory() . '/wp-comment-walker.php';

/**
 * Walker Nav Menu
 */
require get_template_directory() . '/wp-menu-walker.php';

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/fontawesome-5-icons.php';

require get_template_directory() . '/inc/plugins/kirki/kirki.php';

/**
* Displays the author name
*/

function bizberg_get_display_name( $post ){
	
	$user_id = $post->post_author;
	if( empty( $user_id ) ){
		return;
	}

	$user_info = get_userdata( $user_id );
	echo esc_html( $user_info->display_name );
}

function bizberg_post_categories( $post , $limit = false , $plain_text = false , $echo = true ){
	
	$post_categories = wp_get_post_categories( $post->ID );
	$cats = array();

	foreach($post_categories as $key =>  $c){

		if( $key === $limit ){
			break;
		}

	    $cat = get_category( $c );
	    if( $plain_text == true ){
	    	$cats[] = esc_html( $cat->name );
	    } else {
	    	$cats[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';	 
	    }   
	}
	
	if( empty( $cats ) ){
		return false;
	} else{
		if( $echo == true ){
			echo wp_kses_post( implode( ' , ' , $cats ) );	
		} else{
			return implode( ' , ' , $cats );
		}
	
	}
	
}

function bizberg_numbered_pagination(){

	echo '<div class="result-paging-wrapper">';
	the_posts_pagination( 
		array(
			'mid_size' 	=> 2,
			'prev_text' => esc_html__( '&laquo;', 'bizberg' ),
			'next_text' => esc_html__( '&raquo;', 'bizberg' ),
		) 
	);
	echo '</div>';

}

if( !function_exists( 'bizberg_get_custom_logo_link' ) ){

	function bizberg_get_custom_logo_link(){

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

		if ( has_custom_logo() ) {
	        return $logo[0];
		} 

		return;       

	}

}

function bizberg_get_slider_1(){ 

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 2,
		'post_status' => 'publish',
		'cat' => get_theme_mod( 'slider_category' , '0' )
	);

	$query = new WP_Query( $args );
	$count = 0;

	if( $query->have_posts() ): ?>
	
	    <!-- banner starts -->
	    <section class="banner">
	        <div class="slider">
	            <div class="swiper-container">
	                <div class="swiper-wrapper">

	                	<?php 
		            	while( $query->have_posts() ): $query->the_post(); 

		            		$thumbnail_id = get_post_thumbnail_id(); ?>

		                    <div class="swiper-slide">

		                        <div class="slide-inner">

		                           <div class="slide-image" style="background-image:url(<?php echo esc_url( bizberg_get_image_link_by_id( $thumbnail_id , 'full' ) ); ?>)"></div>

		                           <div class="swiper-content">
		                                	<h1><?php the_title(); ?></h1>
		                                	<p class="mar-bottom-20">
		                                		<?php 
		                                		echo wp_trim_words( 
		                                			sanitize_text_field( get_the_content() ), 
		                                			bizberg_get_theme_mod( 'slider_content_length' ), 
		                                			' [...]'
		                                		); ?>
		                                	</p>
		                                	<a 
		                                	href="<?php the_permalink(); ?>" 
		                                	class="slider_btn btn btn-primary btn-lg">
		                                		<?php 
		                                		echo esc_html( bizberg_get_theme_mod( 'slider_read_more_text' ) );
		                                		?>
		                                	</a>
		                            </div> 
		                            <div class="overlay"></div>
		                        </div> 
		                    </div>

		                 	<?php

		                endwhile;
		                ?>

	                </div>
	                <!-- Add Arrows -->
	                <div class="swiper-button-next"></div>
	                <div class="swiper-button-prev"></div>
	                <div class="swiper-pagination"></div>
	            </div>
	            
	        </div>
	    </section>
    	<!-- banner ends -->

		<?php

	endif;

	wp_reset_postdata();
}

function bizberg_get_image_link_by_id( $image_id , $size ){
	$image_attributes = wp_get_attachment_image_src( $image_id , $size );
	if( !empty( $image_attributes[0] ) ){
		return $image_attributes[0];
	}
	return;
}

function bizberg_get_all_posts( $post_type = 'post' ){

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'name',
		'order' => 'ASC'
	);

	$query = new WP_Query($args);
	$data = array();

	if( $query->have_posts() ):

		while( $query->have_posts() ): $query->the_post();

			global $post;
			$data[$post->ID] = esc_html( get_the_title() );

		endwhile;

		wp_reset_postdata();

	endif;

	return $data;
}

function bizberg_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => false,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	return $data;

}

function bizberg_sidebar_position(){

	$position =  get_theme_mod( 'sidebar_settings' , apply_filters( 'bizberg_sidebar_settings', '1' ) );

	switch ( $position ) {
		case 1:
			return 'blog-rightsidebar';
			break;
		
		case 2:
			return 'blog-leftsidebar';
			break;

		case 3:
			return 'blog-nosidebar';
			break;

		default:
			return 'blog-nosidebar-1';
			break;
	}

}

function bizberg_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length' , 60 );
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'bizberg_excerpt_length', 999 );

function bizberg_icon( $post_id ){

	$format = get_post_format( $post_id );

	$custom_icon = get_post_meta( $post_id, 'listing_icon', true );

	if( !empty( $custom_icon ) ){
		return $custom_icon;
	}

	switch ( $format ) {
		case 'aside':
			return 'fas fa-file-alt';
			break;

		case 'gallery':
			return 'fas fa-images';
			break;
		
		case 'link':
			return 'fas fa-link';
			break;	

		case 'image':
			return 'fas fa-camera-retro';
			break;	

		case 'quote':
			return 'fas fa-quote-right';
			break;	

		case 'status':
			return 'fas fa-thermometer-three-quarters';
			break;	

		case 'video':
			return 'fas fa-video';
			break;	

		case 'audio':
			return 'fas fa-volume-up';
			break;	

		case 'chat':
			return 'fas fa-comments';
			break;		

		default:
			return 'fas fa-thumbtack';
			break;
	}

}

add_filter( 'get_search_form', 'bizberg_search_form', 100 );
function bizberg_search_form( $form ) {
    $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    	<label for="s">
    		<input placeholder="' . esc_attr__( 'Search ...' , 'bizberg' ) . '" type="text" value="' . esc_attr( get_search_query() ) . '" name="s" id="s" class="search-field" />
    		<input class="search-submit" type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' , 'bizberg' ) .'" />
    	</label>    	
    </form>';

    return $form;
}

function bizberg_get_banner(){ 

	$breadcrumb_bg = get_theme_mod( 'banner_image' );

	if( empty( $breadcrumb_bg ) ){
		$breadcrumb_bg = get_template_directory_uri() . '/assets/images/breadcrum.jpg';		
	} ?>

	<div 
	class="breadcrumb-wrapper homepage_banner" 
	style="background-image:url( <?php echo esc_url( $breadcrumb_bg ); ?> )">
		<div class="container">
			<div class="col-sm-12">
				<div class="section-title">
					<h1 class="banner_title">
						<?php 
						$banner_title = get_theme_mod( 'banner_title' );
						echo esc_html( $banner_title ? $banner_title : 'Blog' ); ?>
					</h1>
					<p class="banner_subtitle">
						<?php 
						$banner_subtitle = get_theme_mod( 'banner_subtitle' );
						echo esc_html( $banner_subtitle ? $banner_subtitle : "Lorem Ipsum has been the industry's standard dummy" ); 
						?> 
					</p>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
	</div>

	<?php
}

function bizberg_get_banner_title(){
	return esc_html( get_theme_mod( 'banner_title' ) );
}

function bizberg_get_banner_subtitle(){
	return esc_html( get_theme_mod( 'banner_subtitle' ) );
}

function bizberg_get_breadcrums(){

	$breadcrumb_bg = get_theme_mod( 'banner_image' );

	if( empty( $breadcrumb_bg ) ){
		$breadcrumb_bg = get_template_directory_uri() . '/assets/images/breadcrum.jpg';		
	} ?>

	<div 
	class="breadcrumb-wrapper" 
	style="background-image: url( <?php echo( esc_url( $breadcrumb_bg ) ); ?> )">
		<div class="container">
			<div class="col-sm-12">
				<div class="section-title">
					<h1><?php bizberg_get_breadcrum_title(); ?></h1>
					<ol class="breadcrumb">
						<?php bizberg_custom_breadcrumbs(); ?>
					</ol>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
	</div>
	<?php
}

function bizberg_get_breadcrum_title(){

	if( is_single() || is_page() ){
		the_title();
	} elseif( is_search() ){
		$search_title = explode( ',' , get_search_query() );
		printf(
			esc_html__( 'Search Results for: %s' , 'bizberg' ),
			esc_html( $search_title[0] )
		);
	} elseif( is_404() ){
		echo esc_html__( 'Error 404' , 'bizberg' );
	} else {
		the_archive_title( '', '' );
	}

}

function bizberg_custom_breadcrumbs() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = esc_html__( 'Home' , 'bizberg' );
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'destinations';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
           
        // Home page
        echo '<li class="item-home cyclone-blog-home"><a class="bread-link bread-home" href="' . esc_url( home_url() ) . '">' . esc_html( $home_title ) . '</a></li>';
        
        if ( is_single() ) {
              
            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = array_slice($category, -1);
                $last_category = array_pop( $last_category );
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'. wp_kses_post( $parents ) .'</li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );

                if( !empty( $taxonomy_terms ) && is_array( $taxonomy_terms ) ){

                	$cat_id         = $taxonomy_terms[0]->term_id;
	                $cat_nicename   = $taxonomy_terms[0]->slug;
	                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	                $cat_name       = $taxonomy_terms[0]->name;

                }
                
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {

                $allowed_html = array(
                	'li' => array(
                		'class' => array()
                	),
                	'a' => array(
                		'href' => array()
                	)
                );

                echo wp_kses( $cat_display , $allowed_html );
                echo '<li class="item-current"><span class="bread-current active">' . esc_html( get_the_title() ) . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat"><a class="bread-cat" href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a></li>';

                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                  
            }
              
        } elseif ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } elseif ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                $parents = '';
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( get_permalink($ancestor) ) . '">' . esc_html( get_the_title($ancestor) ) . '</a></li>';
                }
                   
                // Display parent pages

                echo wp_kses( 
                	$parents, 
                	array(
                		'li' => array(
                			'class' => array()
                		),
                		'a' => array(
                			'class' => array(),
                			'href' => array(),
                			'title' => array()
                		),
                	)
                );
                   
                // Current page
                echo '<li class="item-current"><span class="active"> ' . esc_html( get_the_title() ) . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                   
            }
               
        } elseif ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current"><span class="active">' . esc_html( $get_term_name ) . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month link
            echo '<li class="item-month"><a class="bread-month" href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('M') ) . '</a></li>';
               
            // Day display
            echo '<li class="item-current"><span class="active bread-current"> ' . esc_html( get_the_time('jS') ) . ' ' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month display
            echo '<li class="item-month"><span class="active bread-month">' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_time('Y') ) . ' </span></li>';
               
        } elseif ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            /* translators: %s is replaced with "string". It will display the author name */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Author: %s', 'bizberg' ) , esc_html( $userdata->display_name ) ) . '</span></li>';
           
        } elseif ( is_search() ) {
           
           $search_title = explode( ',' , get_search_query() );

            /* translators: %s is replaced with "string". It will display the search title */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Search results for: %s' , 'bizberg' ) , esc_html( $search_title[0] ) ) . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li class="active">' . esc_html__( 'Error 404' , 'bizberg' ) . '</li>';
        } elseif( is_tax() ){

        	$term = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );

	        $tmpTerm = $term;
	        $tmpCrumbs = array();
	        while ($tmpTerm->parent > 0){
	            $tmpTerm = get_term($tmpTerm->parent, get_query_var("taxonomy"));
	            $crumb = '<li><a href="' . esc_url( get_term_link($tmpTerm, get_query_var('taxonomy')) ) . '">' . esc_html( $tmpTerm->name ) . '</a></li>';
	            array_push($tmpCrumbs, $crumb);
	        }
	        echo implode('', array_reverse($tmpCrumbs));
	        echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . esc_html( $term->name ) . '</span></li>';

        }
                  
    }
       
}

if( !function_exists( 'bizberg_get_copyright_section' ) ){

	function bizberg_get_copyright_section(){

		esc_html_e( 'Copyright &copy;', 'bizberg' ); 
		echo date_i18n( __( 'Y' , 'bizberg' ) ); ?> 
				
		<?php bloginfo( 'name' ); ?>

		<?php 

		esc_html_e( '. All rights reserved. ', 'bizberg' ); 

		echo '<span class="bizberg_copyright_inner">';

		printf( 
			esc_html__( 'Powered %1$s by %2$s', 'bizberg' ), 
			'', 
			'<a href="https://wordpress.org/" target="_blank">WordPress</a>' ); 

		?>

	    <span class="sep"> &amp; </span>

	    <?php esc_html_e( 'Designed by', 'bizberg' ); ?> 

	    <a href="<?php echo esc_url( 'http://cyclonethemes.com/'); ?>" target="_blank">
	    	<?php esc_html_e( 'Cyclone Themes', 'bizberg' ); ?>
	    </a>

	    <?php

	    echo '</span>';

	}

}

function bizberg_get_comments_number( $post ){

	$no_of_comments = get_comments_number( $post->ID );

	echo '<a href="' . esc_url( get_comments_link() ) . '"><i class="fas fa-comments"></i> ';
	echo absint( $no_of_comments );	
	echo '</a>';

}

add_action( 'admin_notices', 'bizberg_admin_notice_demo_data' );
function bizberg_admin_notice_demo_data() {

	// Hide bizberg admin message
	if( !empty( $_GET['status'] ) && $_GET['status'] == 'bizberg_hide_msg' ){
		update_option( 'bizberg_hide_msg', true );
	}

	$status = get_option( 'bizberg_hide_msg' );
	if( $status == true ){
		return;
	} 

	$check_elegant_block_plugin_status = is_plugin_active( 'elegant-blocks/plugin.php' ) ? true : false;

	$my_theme = wp_get_theme();
	$theme_name = $my_theme->get( 'Name' );

	?>

    <div class="theme-info-start notice notice-info">

    	<div class="theme-info-wrapper" style="padding: 20px 20px 20px 5px;">

	        <?php 
	        echo '<strong style="font-size: 20px; padding-bottom: 10px; display: block;">';
	        printf(
	        	esc_html__( 'Thank you for installing %1$s', 'bizberg' ),
	        	$theme_name
	        ); 
	        echo '</strong>';
	        echo '<p>' . esc_html__( "It comes with prebuild templates so that you don't have to build it from the start. Install all recommended plugins to get started." , 'bizberg' ) . '</p>';
	        ?>

	        <div class="button_wrapper_theme" style="margin-top: 20px;">
	        <a 
	        href="<?php echo esc_url( admin_url( $check_elegant_block_plugin_status ? 'themes.php?page=cyclone-one-click-demo-import&status=bizberg_hide_msg' : 'themes.php?page=tgmpa-install-plugins&status=bizberg_hide_msg' ) ); ?>" 
	        class="button button-primary button-hero" 
	        ><?php esc_html_e( 'Get Started', 'bizberg' ) ?></a>

	        <a 
	        href="<?php echo esc_url( admin_url('/?status=bizberg_hide_msg') ); ?>" 
	        class="button button-default button-hero" ><?php esc_html_e( 'Close', 'bizberg' ) ?></a>
	        </div>

        </div>
        
    </div>
    
    <?php
}

add_action( 'tgmpa_register', 'bizberg_register_required_plugins' );
function bizberg_register_required_plugins() {

	$plugins = array(

		array(
			'name' => esc_html__( 'One Click Demo Import', 'bizberg' ),
			'slug' => 'one-click-demo-import',
			'required'=> false,
		),
		array(
			'name' => esc_html__( 'Elegant Blocks &ndash; Amazing Gutenberg Blocks', 'bizberg' ),
			'slug' => 'elegant-blocks',
			'required'=> false,
		),
		array(
			'name' => esc_html__( 'Gutenberg Blocks &ndash; Ultimate Addons for Gutenberg', 'bizberg' ),
			'slug' => 'ultimate-addons-for-gutenberg',
			'required'=> false,
		),
		array(
			'name' => esc_html__( 'Contact Form 7', 'bizberg' ),
			'slug' => 'contact-form-7',
			'required'=> false,
		)

	);

	$plugins = apply_filters( 'bizberg_recommended_plugins', $plugins );

	/**
	* If gutenberg is not installed, download and install
	*/

	if( function_exists( 'is_gutenberg_page' ) ){
		$plugins[]['name'] = esc_html__( 'Gutenberg', 'bizberg' );
		$plugins[]['slug'] = 'gutenberg';
		$plugins[]['required'] = false;
	}

	$config = array(
		'id'           => 'bizberg_tgmpa',         // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => ''                   // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

function bizberg_get_homepage_style_class(){

	if( is_page_template( 'page-templates/page-fullwidth-transparent-header.php' ) ){
		return 'page-fullwidth-transparent-header theme-sticky';
	} elseif( is_page_template( 'page-templates/page-fullwidth-transparent-header-border.php' ) ){
		return 'page-fullwidth-transparent-header-border';
	} elseif( is_page_template( 'page-templates/full-width.php' ) ){
		return 'page-fullwidth';
	}

}

add_filter('wp_nav_menu_items', 'bizberg_add_items_on_menus', 10, 2);
function bizberg_add_items_on_menus( $items, $args ) {

    if( $args->theme_location == 'menu-1' ){ 

    	$search_status = get_theme_mod( 'header_search', false );
    	$header_button = get_theme_mod( 'header_button', true );

    	ob_start(); 

    	/**
		* @param boolean $search_status
		* If true show the search icon
    	*/

    	if( empty( $search_status ) ){ ?>

	    	<li class="menu-item search_wrapper">
	    		<div class="header-search">
					<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
				</div>
	    	</li>

	    	<?php 
	    } 

	    if( empty( $header_button ) ){ ?>

		    <li class="menu-item header_search_wrapper header_btn_wrapper">
		    	<?php bizberg_get_menu_btn(); ?>
		    </li>

	    	<?php
	    }

    	$content = ob_get_clean();
      	$items .= $content;
    }

    return $items;

}

/**
* @param boolean $header_button
* If true show the button
*/

function bizberg_get_menu_btn(){

	$header_button = get_theme_mod( 'header_button', false );
	if( !empty( $header_button ) ){
		return;
	}
	
    $header_button_label = get_theme_mod( 'header_button_label', 'Buy Now' );
    $header_button_link = get_theme_mod( 'header_button_link', '#' ); ?>
    	
	<a href="<?php echo esc_url( $header_button_link ); ?>" class="btn btn-primary menu_custom_btn">
		<?php 
		echo esc_html( $header_button_label );
		?>
	</a>
        
    <?php

}

if( !function_exists( 'bizberg_get_footer' ) ){
	function bizberg_get_footer(){ 
		bizberg_get_footer_5();
	}
}

function bizberg_get_footer_social_links(){

	$social_icons = get_theme_mod( 'footer_social_links' );
	$content = '';

    if( !empty( $social_icons ) && is_array( $social_icons ) ){

    	ob_start();

        echo '<ul class="social-net">';
        $count = 0.2;
        foreach( $social_icons as $value ){
            echo '<li class="wow fadeInUp animated" data-wow-delay="' . esc_attr( $count ) . 's" data-wow-offset="50"><a href="' . esc_html( $value['link'] ) . '"><i class="' . esc_attr( $value['icon'] ) . '"></i></a></li>';
            $count = $count + 0.2;
        }
        echo '</ul>';

        $content = ob_get_clean();
        return $content;

    }

    return $content;

}

function bizberg_get_footer_5(){ 

	$social_icons = bizberg_get_footer_social_links(); ?>

	<footer 
	id="footer" 
	class="footer-style"
	style="<?php echo ( empty( $social_icons ) ? 'padding-top: 20px;' : '' ); ?>">

	    <div class="container">

	    	<?php 
	    	if( !empty( $social_icons ) ){ ?>
		    	<div class="footer_social_links">
			        <?php 
			        echo wp_kses_post( $social_icons );
			        ?>
		        </div>
		        <?php 
		    } ?>

	        <?php
	        wp_nav_menu( array(
	            'theme_location' => 'footer',
	            'menu_class'=>'inline-menu',
	            'container' => 'ul',
	            'depth' => 1
	        ) );
	        ?>

	        <p class="copyright">
	            <?php bizberg_get_copyright_section(); ?>
	        </p>
	    </div>
	</footer>

	<?php
}

if( !function_exists('bizberg_adjustBrightness') ){

	function bizberg_adjustBrightness( $hexCode, $adjustPercent = '-0.2' ) {
    
	  	$hexCode = ltrim($hexCode, '#');

	    if (strlen($hexCode) == 3) {
	        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
	    }

	    $hexCode = array_map('hexdec', str_split($hexCode, 2));

	    foreach ($hexCode as & $color) {
	        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
	        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

	        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
	    }

	    return '#' . implode($hexCode);

	}

}

add_filter( 'kirki_telemetry', '__return_false' );

function bizberg_check_sidebar_active_inactive_class(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar'  ) ) ){

		return 'col-sm-9 content-wrapper';
		
	}
	return 'col-sm-10 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

function bizberg_check_sidebar_active_inactive_class_home(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar'  ) ) ){
		return 'col-sm-9 content-wrapper';
	}

	return 'col-sm-10 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

function bizberg_check_sidebar_active_inactive_class_page(){

	if( is_active_sidebar( 'sidebar-2' ) ){
		return 'col-sm-9 content-wrapper';
	}

	return 'col-sm-10 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

if ( ! function_exists( 'bizberg_get_theme_mod' ) ) {
  	function bizberg_get_theme_mod( $field_id, $default_value = '' ) {
    	if ( $field_id ) {
      	if ( !$default_value ) {
        		if ( class_exists( 'Kirki' ) && isset( Kirki::$fields[ $field_id ] ) && isset( Kirki::$fields[ $field_id ]['default'] ) ) {
          		$default_value = Kirki::$fields[ $field_id ]['default'];
        		}
      	}
      	$value = get_theme_mod( $field_id, $default_value );
      	return $value;
    	}
    	return false;
  	}
}