<?php 

	add_action('admin_init', 'role_newsletter');
	function role_newsletter(){
		add_role( 'assinante_newsletter', 'Assinante da Newsletter', array('read' => false, 'edit_posts' => false, 'delete_posts' => false) );
	}
	// add_action('admin_init', 'custom_caps');
	// function custom_caps(){
	// 	global $themePrefix;
	// 	$userCaps = get_user_meta(get_current_user_id(),  $themePrefix.'cap_info', false);
	// 	for($i = 0; $i < count($userCaps); $i++){
	// 		echo '<input type="hidden" class="caps" value="'.$userCaps[$i].'">';
	// 	}

	// 	$user = new WP_User( get_current_user_id() );
	// 	echo '<input type="hidden" class="role" value="'.$user->roles[0].'">';
	// }
// Change the names
	add_action('init', 'change_role_name');
	function change_role_name() {
	    global $wp_roles;
	    if ( ! isset( $wp_roles ) ){
	    	$wp_roles = new WP_Roles();
	    }
	    // You can replace "administrator" with any other role "editor", "author", "contributor" or "subscriber"
	    $wp_roles->roles['author']['name'] = 'Repórter Pleno';
	    $wp_roles->role_names['author'] = 'Repórter Pleno';
	    $wp_roles->roles['contributor']['name'] = 'Repórter Júnior';
	    $wp_roles->role_names['contributor'] = 'Repórter Júnior';
		$wp_roles->roles['subscriber']['name'] = 'Leitor';
	    $wp_roles->role_names['subscriber'] = 'Leitor';
	}

// Read private posts
	add_action('admin_init','custom_private_caps',999);
	function custom_private_caps() {
		$roles = array('subscriber');
		foreach($roles as $the_role) { 
			$role = get_role($the_role);
			$role->remove_cap( 'read_private_pages' );
			$role->add_cap( 'read_private_posts');
		}
	}
?>