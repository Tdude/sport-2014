<?php
/*-----------------------------------------------------------------------------------*/
/*  Load and init menu class
/*-----------------------------------------------------------------------------------*/
include_once( 'includes/wpboot_post_type_functions.php' );



/*-----------------------------------------------------------------------------------*/
/*  Js
/*-----------------------------------------------------------------------------------*/
function wpboot_scripts_with_jquery() {
// Register your scripts like this after jquery:
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );
    wp_register_script( 'clock', get_template_directory_uri() . '/js/clock.js', array( 'jquery' ) );
    wp_register_script( 'validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array( 'jquery' ) );
    wp_register_script( 'functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ) );
    
    // Ex: filnamnet functions.js laddas m jquery beroende. Se ovan.
    wp_enqueue_script('bootstrap');
    wp_enqueue_script( 'clock' );
    wp_enqueue_script( 'validate' );
    wp_enqueue_script( 'functions' );

}
add_action( 'wp_enqueue_scripts', 'wpboot_scripts_with_jquery' );



/*-----------------------------------------------------------------------------------*/
/* Enqueue CSS. Laddas i ratt ordning fran style.css
/*-----------------------------------------------------------------------------------*/
// function wpboot_enqueue_css() {
//     //responsive
//     wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', 'style'); 
// }
// add_action('wp_enqueue_scripts', 'wpboot_enqueue_css');


/*-----------------------------------------------------------------------------------*/
/*  Create meta description from posts
/*-----------------------------------------------------------------------------------*/
// function create_meta_desc() {  
//     global $post;  
//    // if (!is_single()) { return; }  
//     $meta = strip_tags($post->post_content);  
//     $meta = strip_shortcodes($post->post_content);  
//     $meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);  
//     $meta = substr($meta, 0, 125);  
//     echo '<meta name="description" content="' . $meta . '">';  
//     }  
// add_action('wp_head', 'create_meta_desc');  



/*-----------------------------------------------------------------------------------*/
/*  Output which theme/template file in use. Should be shortened
/*-----------------------------------------------------------------------------------*/
add_action('wp_footer', 'show_template');
function show_template() {
    global $template;
    // whole url to server root if possible
    // print_r($template); 
    // after last slash 
    print_r( substr( $template, strrpos( $template, '/' ) + 1 ) );
}


/*-----------------------------------------------------------------------------------*/
/*	Remove junk from head
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator'); //removes WP Version # for security
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );



/*-----------------------------------------------------------------------------------*/
/* FILTER NUMBER OF WORDS
/* Example: echo excerpt(25); OR echo content(25);
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}


/*-----------------------------------------------------------------------------------*/
/*	// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT ALL ADMINs
/*-----------------------------------------------------------------------------------*/
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins 
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}


/*-----------------------------------------------------------------------------------*/
/*	Set the post revisions unless the constant was set in wp-config.php
/*-----------------------------------------------------------------------------------*/
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);


/*-----------------------------------------------------------------------------------*/
/*  CUSTOM LOGIN LOGOTYP
/*-----------------------------------------------------------------------------------*/
function custom_login_logo() {
  echo '<style type="text/css">
            .login #login h1 a {
            background-image:url('.get_bloginfo('template_directory').'/images/logo-2013.svg) !important;
            background-size: 200px 200px!important;
            height: 220px;
            margin: 0 auto;
            width: 200px;
         }
        </style>';
}
add_action('login_head', 'custom_login_logo');


/*-----------------------------------------------------------------------------------*/
/* HEADER LOGO URL for login screen (dafaults to wordpress.org)
/*-----------------------------------------------------------------------------------*/
add_filter('login_headerurl', 
    create_function(false,"return 'http://www.sportandmarketing.se';"));
 
// Your own login logo title text
function wpboot_login_title() {
    return 'Till startsidan';
}
add_filter('login_headertitle', 'wpboot_login_title');



/*-----------------------------------------------------------------------------------*/
/*	// MAKE CUSTOM POST TYPES SEARCHABLE
/*-----------------------------------------------------------------------------------*/
function searchAll( $query ) {
	if ( $query->is_search ) { $query->set( 'post_type', array( 'site', 'plugin', 'theme', 'person' )); } 
	return $query;
}
add_filter( 'the_search_query', 'searchAll' );



/*-----------------------------------------------------------------------------------*/
/* CUSTOM ADMIN MENU LINK FOR ALL SETTINGS
/*-----------------------------------------------------------------------------------*/
function all_settings_link() {
 add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'all_settings_link');




/*-----------------------------------------------------------------------------------*/
/*	CUSTOM FOOTER I ADMIN
/*-----------------------------------------------------------------------------------*/
function modify_footer_admin() {
  echo 'Front end kodning av <a href="http://klickomaten.com">Tibor Berki</a>. Maila mig p&aring; tibbemail@gmail.com. ';
  echo 'Drivs av <a href="http://WordPress.org">WordPress</a>. Bra dokumentation finns d&auml;r.';
  echo 'Logga in på <a href="https://www.google.com/analytics/">Google Analytics</a> om du fått kontouppgifter.';
}

add_filter('admin_footer_text', 'modify_footer_admin');





/*-----------------------------------------------------------------------------------*/
/*  Featured image i listvy i admin f posts o wpboot_bildspel
/*-----------------------------------------------------------------------------------*/
function wpboot_get_featured_image($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {  
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'small-thumb');  
        return $post_thumbnail_img[0];  
    }  
}
// ADD NEW COLUMN  
function wpboot_columns_head($defaults) {  
    $defaults['featured_image'] = 'F&ouml;rvald bild';
    return $defaults;  
}
// SHOW THE FEATURED IMAGE  
function wpboot_columns_content($column_name, $post_ID) {  
    if ($column_name == 'featured_image') {  
        $post_featured_image = wpboot_get_featured_image($post_ID);  
        if ($post_featured_image) {  
            echo '<img src="' . $post_featured_image . '" />';  
        }  
    }  
}
// FOR BILDSPEL
add_filter('manage_wpboot_bildspel_posts_columns', 'wpboot_columns_head');  
add_action('manage_wpboot_bildspel_posts_custom_column', 'wpboot_columns_content', 10, 2); 


// FOR POSTS
add_filter('manage_posts_columns', 'wpboot_columns_head');  
add_action('manage_posts_custom_column', 'wpboot_columns_content', 10, 2);  






/*-----------------------------------------------------------------------------------*/
/*  Replaces the excerpt "more" text by a link
/*-----------------------------------------------------------------------------------*/
function new_excerpt_more($more) {
       global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Läs hela artikeln...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');



/*-----------------------------------------------------------------------------------*/
/*	ADMIN DASHBOARD WIDGET
 * THIS FUNCTION IS HOOKED INTO THE 'WP_DASHBOARD_SETUP' ACTION BELOW.
/*-----------------------------------------------------------------------------------*/
function wpboot_add_dashboard_widgets() {
	wp_add_dashboard_widget(
                 'wpboot_dashboard_widget',         // Widget slug.
                 'If all else fails...',         // Title.
                 'wpboot_dashboard_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'wpboot_add_dashboard_widgets' );

// Create the function to output the contents of our Dashboard Widget.
function wpboot_dashboard_widget_function() {
	// Display whatever it is you want to show.
	echo 'Om du kört fast och inte hittar någon info i <a href="http://codex.wordpress.org/First_Steps_With_WordPress">Wordpress dokumentation</a>,
     maila Tibor Berki som kodat denna site på <a href="mailto:tibbe@klickomaten.com">tibbe@klickomaten.com</a>, eller ring 072-7150003.';
}




/*-----------------------------------------------------------------------------------*/
/*	NAVBAR WIDGETS
/*-----------------------------------------------------------------------------------*/
function header_widget_init() {
	register_sidebar( array(
		'name' => 'Header widget',
		'id' => 'header-widget',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
		'before_widget' => '',
		'after_widget' => ''
	));
}
add_action( 'widgets_init', 'header_widget_init' );



/*-----------------------------------------------------------------------------------*/
/*	FOOTER WIDGETS
/*-----------------------------------------------------------------------------------*/
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Footer One',
        'id' => 'footer-one',
        'description' => __('Widgets in this area will be shown in the first footer area.','adapt'),
        'before_widget' => '<div class="footer-widget clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Footer Two',
        'id' => 'footer-two',
        'description' => __('Widgets in this area will be shown in the sedcon footer area.','adapt'),
        'before_widget' => '<div class="footer-widget clearfix">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
));



/*-----------------------------------------------------------------------------------*/
/*	TA BORT IDIOTISK EDITERINGSMOJLIGHET AV PHP-FILER OCH ANNAT KRAFS I WP TEMAT
/*-----------------------------------------------------------------------------------*/
add_action('admin_init', 'my_remove_menu_elements', 102);
function my_remove_menu_elements() {
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
}

// REMOVE STUPID WP GALLRY INLINE STYLESHEET
add_filter( 'use_default_gallery_style', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/*	IMAGES
/*-----------------------------------------------------------------------------------*/
if (function_exists( 'add_theme_support') ) {
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 'thumbnail', 196, 96, false ); // WP ORIGINAL THUMB. TRUE = HARDCROPPAD
}

if ( function_exists('add_image_size') ) {
	// THEME IMAGES
	add_image_size( 'slider',  1000, 250, true );
  add_image_size( 'teaser-thumb',  270, 270, true );
	add_image_size( 'small-thumb',  50, 50, true );

}



/*-----------------------------------------------------------------------------------*/
/*  GET FIRST IMAGE IN POST AND THEN FILTER
/*-----------------------------------------------------------------------------------*/
// http://www.livexp.net/wordpress/get-the-first-image-from-the-wordpress-post-and-display-it.html

function get_first_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];

	if(!empty($first_img)){ //Defines a default image
		//$first_img = '/images/default.jpg';
		return '<img src="' .$first_img. '" alt="first image" />';
	}
}


/*-----------------------------------------------------------------------------------*/
/*  STRIP OUT IMAGE IN THE_CONTENT
/*-----------------------------------------------------------------------------------*/
function the_content_text_only(){
    ob_start();
    the_content('Read more',true);
    $postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
    ob_end_clean();
    echo $postOutput;


 //   echo appply_filters('the_content', substr(get_the_content(), 0, 200) );
}





// TEST SHOW ONLY IMGS
function the_content_image_only() {
    global $post;
    $post = get_post($post);

    /* image code */
    $images =& get_children( 'post_type=attachment&post_mime_type=image&output=ARRAY_N&orderby=menu_order&order=ASC&post_parent='.$post->ID);
    if($images){
        foreach( $images as $imageID => $imagePost ){
            unset($the_b_img);
            $the_b_img = wp_get_attachment_image($imageID, 'thumbnail', false);
            $thumblist .= '<a href="'.get_attachment_link($imageID).'">'.$the_b_img.'</a>';
        }
    }
    return $thumblist;
}




/*-----------------------------------------------------------------------------------*/
/*  Slider carousel custom post type & hax
/*-----------------------------------------------------------------------------------*/
///////  http://generatewp.com/taxonomy/
///////  http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress


function create_bildspel_post_types() {
  register_post_type( 'wpboot_bildspel',
    array( 'labels' => array(
        'name' => __( 'Bildspel' ),
        'singular_name' => __( 'Bildspel &amp; text' ),
        'add_new' => __( 'Skapa nytt inl&auml;gg' ),
        'add_new_item' => __( 'H&auml;r l&auml;gger du till bild &amp; text i bildspelet p&aring; startsidan.' ),
        'edit' => __( '&Auml;ndra' ),
        'edit_item' => __( '&Auml;ndra i bildspel' ),
        'new_item' => __( 'Nytt bildspelinl&auml;gg' ),
        'view' => __( 'Se bildspel' ),
        'view_item' => __( 'Kolla' ),
        'search_items' => __( 'S&ouml;k i bildspel' ),
        'not_found' => __( 'Inget bildspelsinl&auml;gg hittat' ),
        'not_found_in_trash' => __( 'Inget bildspelsinl&auml;gg hittat i papperskorgen' ),
        'parent' => __( 'Huvudkategori till bildspel' ),
        'description' => __( 'Bildspelet &auml;ndras h&auml;r. <a href="#" class="button insert-media add_media" data-editor="content" 
                    title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>' ),

                // FOR MEDIA IFRAME
                //'register_meta_box_cb' => 'my_meta_box_cb',
      ),

    'public' => true,
    'show_ui' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'menu_position' => 5,
    'show_in_nav_menus' => true,
    'menu_icon' => get_stylesheet_directory_uri() . '/images/but-admin-bildspel.png',
    'query_var' => true,
    'supports' => array('title', 'thumbnail', 'wpboot_spiderfood'),
    'rewrite' => array( 'slug' => 'bildspel', 'with_front' => false ), 
    //'rewrite' => array( 'slug' => 'wpboot_bildspel' ),
    )
  );
}

add_action ( 'init', 'create_bildspel_post_types' );



/*-----------------------------------------------------------------------------------*/
/*  Register attachment in carousel bildspel slider. See modification from original - 140128!
/*-----------------------------------------------------------------------------------*/
add_filter( 'pre_get_posts', 'my_get_posts' );
function my_get_posts( $query ) {

    if ( is_home() && false == $query->get('suppress_filters') )
        $query->set( 'post_type', array( 'wpboot_bildspel', 'attachment' ) );
    return $query;
}





/*-----------------------------------------------------------------------------------*/
/*  IMAGE UPLOAD ON NORMAL PAGES
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
    'id'        => 'wpboot_imgupload',
    'title'     => 'Bildspel över menyn',
    'pages'     =>  array('wpboot_bildspel'),
    'fields'    => array(

        array(
        'name'      => 'Bild',
        'id'        => 'wpboot_img',
        'type'      => 'image',
        'desc'      => '',
        ),
            
        array(
        'name'      => 'Bildtext',
        'id'        => 'wpboot_text',
        'type'      => 'textarea',
        'desc'      => 'Anv&auml;nd detta f&auml;lt f&ouml;r en kort bildtext.',
        'default'   => 'Bildtext h&auml;r.',
        ),
        array(
        'name'      => 'Länka bilden?',
        'id'        => 'wpboot_img_link',
        'type'      => 'text',
        'desc'      => 'Gå till sidan du vill länka till. Kopiera URLen och klistra in här. Inte nödvändigt!',
        'default'   => 'URL här.',
        ),
));     



/*-----------------------------------------------------------------------------------*/
/*  SPIDERFOOD FOR POST, PAGE 
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
    'id'        =>  'wpboot_spiderfood',
    'title'     =>  'S&ouml;kmotormat',
    'pages'     =>  array('page', 'post'),
    'fields'    =>  array(
    
        array(
        'name'      =>  'SEO till svenska eller engelska sidor.',
        'id'        =>  'wpboot_spiderfood',
        'default'   =>  'Din spindelmat h&auml;r.',
        'desc'      =>  'Skriv meningar laddade med s&ouml;kuttryck.',
        'type'      =>  'text',
        ),
));




/*-----------------------------------------------------------------------------------*/
/*  EXTRA TEXT FIELD FOR MISCELLANEOUS STUFF, LIKE MAP ETC.
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
    'id'        => 'wpboot_extra_textfield',
    'title'     => 'Extragrejs',
    'pages'     =>  array('page', 'post'), // OBS SINGULAR
    'fields'    => array(

        array(
        'name'      => 'Text',
        'id'        => 'wpboot_textfield',
        'type'      => 'textarea',
        'desc'      => 'Anv&auml;nd detta f&auml;lt f&ouml;r extra saker som ska vara innan bildpuffarna.',
        'default'   => 'URL, text eller annat h&auml;r.',
        ),
));     



// Disables Kses only for textarea saves
foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
    remove_filter($filter, 'wp_filter_kses');
}

// LOOPA OVER ALLA METABOXARS ARRAYER (HAS TO BE AFTER BOXES ARRAYS)
foreach ($meta_boxes as $meta_box) {
    $my_box = new wpboot_meta_box_taxonomy($meta_box);
}






/*-----------------------------------------------------------------------------------*/
/*  Random quotes from Adam Burucs, http://burucs.com
/*-----------------------------------------------------------------------------------*/
// Register custom post type
add_action( 'init', 'wpboot_random_quote' );
function wpboot_random_quote() {
    register_post_type( 'random_quote',
        array(
            'labels' => array(
                'name' => __( 'Slumpade citat' ),
                'singular_name' => __( 'Slumpat citat' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'excerpt'),
            'exclude_from_search' => true,
        )
    );
}

// Create admin interface
add_filter("manage_edit-random_quote_columns", "wpboot_project_edit_columns");

function wpboot_project_edit_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Bevingade ord",
        "description" => "Person",
    );

    return $columns;
}

add_action("manage_posts_custom_column",  "wpboot_project_custom_columns");

function wpboot_project_custom_columns($column) {
    global $post;
    switch ($column) {
        case "description":
            the_excerpt();
            break;
    }
}

// Main function to get quotes
function wpboot_generate() {
    // Retrieve one random quote
    $args = array(
        'post_type' => 'random_quote',
        'posts_per_page' => 1,
        'orderby' => 'rand'
    );
    $query = new WP_Query( $args );

    // Build output string
    $quo = '';
    $quo .= $query->post->post_title;
    $quo .= ' said "';
    $quo .= $query->post->post_content;
    $quo .= '"';

    return $quo;
}

// Helper function
function wpboot_change_bloginfo( $text, $show ) {
    if( 'description' == $show ) {
        $text = wpboot_generate();
    }
    return $text;
}

// Override default filter with the new quote generator
add_filter( 'bloginfo', 'wpboot_change_bloginfo', 10, 2 );





/*-----------------------------------------------------------------------------------*/
/*  Register Custom Post Type (http://generatewp.com/post-type/)
/*-----------------------------------------------------------------------------------*/
/*
function wpboot_page_puffar() {

    $labels = array(
        'name'                => _x( 'Puffar', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Puff', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Puffar', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Puff:', 'text_domain' ),
        'all_items'           => __( 'Alla Puffar', 'text_domain' ),
        'view_item'           => __( 'Se Puffar', 'text_domain' ),
        'add_new_item'        => __( 'Lägg till Puff', 'text_domain' ),
        'add_new'             => __( 'Ny Puff', 'text_domain' ),
        'edit_item'           => __( 'Ändra Puff', 'text_domain' ),
        'update_item'         => __( 'Uppdatera Puffar', 'text_domain' ),
        'search_items'        => __( 'Sök bland Puffar', 'text_domain' ),
        'not_found'           => __( 'Ingen träff bland Puffar', 'text_domain' ),
        'not_found_in_trash'  => __( 'Inga Puffar bland skräp', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                => 'puffar',
        'with_front'          => false,
        'pages'               => false,
        'feeds'               => false,
    );
    $args = array(
        'label'               => __( 'puffar', 'text_domain' ),
        'description'         => __( 'Bildpuffar på sidan', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'excerpt', 'thumbnail', ),
        'taxonomies'          => array( 'pages' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => '',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'query_var'           => 'puffar',
        'rewrite'             => $rewrite,
        'capability_type'     => 'page',
    );
    register_post_type( 'puffar', $args );

}

// Hook into the 'init' action
add_action( 'init', 'wpboot_page_puffar', 0 );
*/


/*-----------------------------------------------------------------------------------*/
/*  BOOTSTRAP PAGINATION
/*-----------------------------------------------------------------------------------*/

function bootstrap_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if( $pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if( !$pages ) {
            $pages = 1;
        }
    }

    if(1 != $pages) {
    echo '<div class="pagination pagination-centered"><ul class="pagination">';
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<li><a href="' . get_pagenum_link(1). '">&laquo;</a></li>';
    if($paged > 1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged - 1) . '">&lsaquo;</a></li>';

    for ( $i=1; $i <= $pages; $i++ ) {
        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
            echo ($paged == $i)? '<li class="active"><span class="current">' . $i . '</span></li>' : '<li><a href="' . get_pagenum_link($i). 
            '" class="inactive" >' . $i . '</a></li>';
        }
    }

        if ($paged < $pages && $showitems < $pages) echo '<li><a href="' . get_pagenum_link($paged + 1) . '">&rsaquo;</a></li>';
        if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo '<li><a href="' . get_pagenum_link($pages) . '">&raquo;</a></li>';
        echo '</ul></div>';
    }
}






/*-----------------------------------------------------------------------------------*/
/* Help Contact Form 7 Play Nice With Twitter Bootstrap
/* Add a Twitter Bootstrap-friendly class to the "Contact Form 7" form (http://www.wildli.com/blog/dev-tip-getting-contact-form-7-wordpress-plugin-and-twitter-bootstrap-to-play-nice/)
/*-----------------------------------------------------------------------------------*/

add_filter( 'wpcf7_form_class_attr', 'wildli_custom_form_class_attr' );
function wildli_custom_form_class_attr( $class ) {
  $class .= ' form-horizontal';
  return $class;
}




/*-----------------------------------------------------------------------------------*/
// Load external file to add support for MultiPostThumbnails. Allows you to set more than one "feature image" per post.
//require_once('includes/multi-post-thumbnails.php');
/*-----------------------------------------------------------------------------------*/

// SEE PLUGIN
// De