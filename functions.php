<?php 
/*
 *  	Allow .svg and .svg upload
 */

	function cc_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		$mimes['srt'] = 'text/plain';
		return $mimes;
	}
	add_filter( 'upload_mimes', 'cc_mime_types' );
	
	


/*
 *  	AJAX Calls
 */
	
	function add_myjavascript(){
		wp_enqueue_script( 'ajax-script.js', get_bloginfo('template_directory') . "/js/ajax-script.js", array( 'jquery' ) );
	}
	add_action( 'init', 'add_myjavascript' );




/*
 *  	User Roles
 */
	 
	function hide_menu() {
		global $current_user;
		$user_id = get_current_user_id();
		// echo "user:".$user_id;   // Use this to find your user id quickly
		
		if($user_id != '1') {
			
			remove_menu_page( 'index.php' );                  	//Dashboard
			remove_menu_page( 'upload.php' );                 	//Media
			remove_menu_page( 'edit-comments.php' );          	//Comments
			remove_menu_page( 'plugins.php' );                	//Plugins
				remove_submenu_page( 'themes.php', 'themes.php' );
				remove_submenu_page( 'themes.php', 'theme-editor.php' );
				remove_submenu_page( 'themes.php', 'customize.php' );
			remove_menu_page( 'nav-menus.php' );              	//Editar Menus
			// remove_menu_page( 'users.php' );                  	Users
			remove_menu_page( 'tools.php' );                  	//Tools
			remove_menu_page( 'options-general.php' );        	//Settings			
			remove_menu_page( 'edit.php?post_type=acf' );     	//Advanced Custom Fields		
			remove_menu_page( 'admin.php?page=cpt_main_menu' );	//Custom Post Types		
			remove_menu_page( 'themes.php' );     			//Custom Fields		
		}
	}
	
	add_action('admin_head', 'hide_menu');




/*
 * 		Posts -> Episodes
 */
	 
	function revcon_change_post_label() {
		global $menu;
		global $submenu;
		$menu[5][0] = 'Episodes';
		$submenu['edit.php'][5][0] = 'Episodes';
		$submenu['edit.php'][10][0] = 'Add Episode';
		$submenu['edit.php'][16][0] = 'News Tags';
		echo '';
	}
	function revcon_change_post_object() {
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
		$labels->name = 'Episodes';
		$labels->singular_name = 'Episode';
		$labels->add_new = 'Add Episode';
		$labels->add_new_item = 'New Episode';
		$labels->edit_item = 'Edit Episode';
		$labels->new_item = 'Episodes';
		$labels->view_item = 'View Episodes';
		$labels->search_items = 'Search Episodes';
		$labels->not_found = 'No Episodes found';
		$labels->not_found_in_trash = 'No Episodes found in Trash';
		$labels->all_items = 'All Episodes';
		$labels->menu_name = 'Episodes';
		$labels->name_admin_bar = 'Episodes';
	}
	 
	add_action( 'admin_menu', 'revcon_change_post_label' );
	add_action( 'init', 'revcon_change_post_object' );
	



/*
 *  	Resize Images
 */

	add_theme_support( 'post-thumbnails' ); 
	update_option('large_size_w', 570);
	update_option('large_size_h', 320);




/*
 * Search 
 */
	
	function my_search_form( $form ) {
		$form = '
		<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
			<input type="text" placeholder="Search for:" value="' . get_search_query() . '" name="s" id="s" />
			<button type="submit" id="submit" ><img src="'. get_template_directory_uri() .'/img/i-br.svg" width="21" height="21" /></button>
		</form>';
		
		return $form;
	}
	
	add_filter( 'get_search_form', 'my_search_form' );	
	
	


/*
 * Category shows paginator 
 */
	
	function limit_posts_per_archive_page() {
		if ( is_search() ) {
			set_query_var('posts_per_page', 10); // or use variable key: posts_per_page
		} 
	}
	add_filter('pre_get_posts', 'limit_posts_per_archive_page');




/*
 *  	Options Page
 */
	
	if( function_exists('acf_add_options_page') ) { 
		// acf_add_options_page(
		// array(
		// 	'page_title' 	=> 'Publicidad',
		// 	'menu_title'	=> 'Publicidad',
		// 	'menu_slug' 	=> 'theme-general-settings',
		// 	'capability'	=> 'edit_posts',
		// 	'redirect'		=> false
		// ),
		// array(
		// 	'page_title' 	=> 'Opciones Generales',
		// 	'menu_title'	=> 'Opciones',
		// 	'menu_slug' 	=> 'theme-general-settings',
		// 	'capability'	=> 'edit_posts',
		// 	'redirect'		=> false
		// )); 
		acf_add_options_page('Publicidad');
		acf_add_options_page('Opciones');
	}

function post_type_tags_fix($request) {
    if ( isset($request['tag']) && !isset($request['post_type']) )
    $request['post_type'] = 'any';
    return $request;
}
add_filter('request', 'post_type_tags_fix');