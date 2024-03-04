<?php load_theme_textdomain('text_domain'); ?>
<?php
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );
	add_image_size( 'single-post-thumbnail', 300, 9999 );

	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
		// Declare sidebar widget zone
	if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h4>',
    		'after_title'   => '</h4>'
    	));
    }

function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

if (function_exists('register_nav_menus')) {
register_nav_menus( array(
		'main' => __( 'Main Menu', '' ),
		'footer' => __( 'Footer Menu', '' ),
	) );
}

function fallbackmenu1(){ ?>
			<div id="menu">
				<ul><li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus to work.</li></ul>
			</div>
<?php }

function fallbackmenu2(){ ?>
			<div id="menu">
				<ul><li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus to work.</li></ul>
			</div>
<?php }

function add_more_buttons($buttons) {
 $buttons[] = 'hr';
 $buttons[] = 'del';
 $buttons[] = 'sub';
 $buttons[] = 'sup';
 $buttons[] = 'fontselect';
 $buttons[] = 'fontsizeselect';
 $buttons[] = 'cleanup';
 $buttons[] = 'styleselect';
 $buttons[] = 'lineheight';
 return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");

function add_first_and_last($items) {
    $items[1]->classes[] = 'first-menu-item';
    $items[count($items)]->classes[] = 'last-menu-item';
    return $items;
}
 
add_filter('wp_nav_menu_objects', 'add_first_and_last');

function enqueue_custom_form_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-form-script', get_template_directory_uri() . '/calc/custom-form-script.js', array('jquery'), null, true); 
    wp_localize_script('custom-form-script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
 }
 
 add_action('wp_enqueue_scripts', 'enqueue_custom_form_scripts');


 add_action('wp_ajax_save_step_data', 'save_step_data');
add_action('wp_ajax_nopriv_save_step_data', 'save_step_data');

function save_step_data() {
   // Check nonce and permissions if needed

   $step = intval($_POST['step']);
   $data = sanitize_text_field($_POST['formData']);

   // Process and save data based on the step
   // Replace the code below with your data saving logic

   update_post_meta(get_the_ID(), 'step_' . $step . '_data', $data);

   wp_die();
}

 