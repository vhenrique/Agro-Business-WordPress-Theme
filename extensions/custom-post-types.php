<?php

/***************************
**** Custom post types
***************************/

	add_action('init', 'quotationApi_register');
	function quotationApi_register(){
		$singular_label = 'cotação';
		$labels = array(
			'name'					=> __('Cotações Api'),
			'singular_name'			=> __('Cotação Api'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Nova ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> false,
			'publicly_queryable'	=> true,
			'show_ui'				=> false,
			'query_var'				=> true,			
			'capability_type'     	=> 'post',
            'map_meta_cap'       	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-no-alt',
			'has_archive'			=> false,
			'exclude_from_search'	=> true,
			'supports'				=> array('editor')
		);
		register_post_type('pt_quotationApi', $args);
	}

//Business
	add_action('init', 'business_register');
	function business_register(){
		$singular_label = 'negócio';
		$labels = array(
			'name'					=> __('Negócios'),
			'singular_name'			=> __('Negócio'),
			'add_new'				=> __('Adicionar novo'),
			'add_new_item'			=> __('Adicionar novo ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Novo ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,			
			'capability_type'     	=> 'post',
            'map_meta_cap'       	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-chart-area',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_business', $args);
	}

//Agrobusiness
	add_action('init', 'agrobusiness_register');
	function agrobusiness_register(){
		$singular_label = 'agroindústria';
		$labels = array(
			'name'					=> __('Agroindústria'),
			'singular_name'			=> __('Agroindústria'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Nova ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'map_meta_cap'        	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-chart-line',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_agrobusiness', $args);
	}

//Markets
	add_action('init', 'markets_register');
	function markets_register(){
		$singular_label = 'mercado';
		$labels = array(
			'name'					=> __('Mercados'),
			'singular_name'			=> __('Mercado'),
			'add_new'				=> __('Adicionar novo'),
			'add_new_item'			=> __('Adicionar novo ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Novo ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'map_meta_cap'        	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-products',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_markets', $args);
	}

//Technology
	add_action('init', 'technologies_register');
	function technologies_register(){
		$singular_label = 'tecnologia';
		$labels = array(
			'name'					=> __('Tecnologia'),
			'singular_name'			=> __('Tecnologia'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Nova ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'map_meta_cap'        	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-welcome-view-site',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_technologies', $args);
	}

//Policies
	add_action('init', 'policies_register');
	function policies_register(){
		$singular_label = 'política';
		$labels = array(
			'name'					=> __('Políticas'),
			'singular_name'			=> __('Política'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Nova ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'map_meta_cap'        	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-format-chat',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_policies', $args);
	}

//Logistics
	add_action('init', 'logistics_register');
	function logistics_register(){
		$singular_label = 'logística';
		$labels = array(
			'name'					=> __('Logística'),
			'singular_name'			=> __('Logística'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Nova ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'map_meta_cap'        	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-location-alt',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_logistics', $args);
	}

//Interviews
	add_action('init', 'interviews_register');
	function interviews_register(){
		$singular_label = 'entrevista';
		$labels = array(
			'name'					=> __('Entrevistas'),
			'singular_name'			=> __('Entrevista'),
			'add_new'				=> __('Adicionar nova'),
			'add_new_item'			=> __('Adicionar nova ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Nova ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'map_meta_cap'        	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-format-quote',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_interviews', $args);
	}

//Events
	add_action('init', 'events_register');
	function events_register(){
		$singular_label = 'eventos';
		$labels = array(
			'name'					=> __('Eventos'),
			'singular_name'			=> __('Evento'),
			'add_new'				=> __('Adicionar novo'),
			'add_new_item'			=> __('Adicionar novo ').$singular_label,
			'edit_item'				=> __('Editar ').$singular_label,
			'new_item'				=> __('Novo ').$singular_label,
			'view_item'				=> __('Ver ').$singular_label,
			'search_items'			=> __('Procurar ').$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'map_meta_cap'        	=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 7,
			'menu_icon'				=> 'dashicons-calendar',
			'has_archive'			=> true,
			'exclude_from_search'	=> true,
			'taxonomies'			=> array('post_tag'),
			'supports'				=> array('title', 'editor', 'comments', 'thumbnail', 'excerpt')
		);
		register_post_type('pt_events', $args);
	}

/***************************
**** Custom taxonomies types
***************************/

	// Products
	add_action( 'init', 'create_custom_tax_products');
	function create_custom_tax_products() {
		$singular_label = 'produto';
		$labels = array(
			'name'					=> _x( 'Produto', 'taxonomy general name' ),
			'singular_name'			=> _x( 'Produtos', 'taxonomy singular name' ),
			'search_items'			=> __( 'Procurar' ),
			'all_items'				=> __( 'Todos' ),
			'edit_item'				=> __( 'Editar' ),
			'update_item'			=> __( 'Alterar' ),
			'add_new_item'			=> __( 'Novo ' ) . $singular_label,
			'new_item_name'			=> __( 'Novo ' ) . $singular_label,
			'menu_name'				=> __( 'Produtos' )
		);
		$args = array(
			'hierarchical'			=> true,
			'labels'				=> $labels,
			'show_ui'				=> true,
			'show_admin_column'		=> true,
			'capability_type'     	=> 'post',
			'query_var'				=> true,
			'rewrite'				=> array( 'slug' => 'tax_products' ),
			'has_archive'			=> false,
			'exclude_from_search'	=> true,
			'supports'				=> array('title'),
		);
		register_taxonomy('tax_products', getAllPostTypes(), $args );
	}

	// Region
	add_action( 'init', 'create_custom_tax_region');
	function create_custom_tax_region() {
		$singular_label = 'região';
		$labels = array(
			'name'					=> _x( 'Região', 'taxonomy general name' ),
			'singular_name'			=> _x( 'Regiões', 'taxonomy singular name' ),
			'search_items'			=> __( 'Procurar' ),
			'all_items'				=> __( 'Todas' ),
			'edit_item'				=> __( 'Editar' ),
			'update_item'			=> __( 'Alterar' ),
			'add_new_item'			=> __( 'Nova ' ) . $singular_label,
			'new_item_name'			=> __( 'Nova ' ) . $singular_label,
			'menu_name'				=> __( 'Regiões' ),
		);
		$args = array(
			'hierarchical'			=> true,
			'labels'				=> $labels,
			'show_ui'				=> true,
			'show_admin_column'		=> true,
			'query_var'				=> true,
			'capability_type'     	=> 'post',
			'rewrite'				=> array( 'slug' => 'tax_regiao' ),
			'has_archive'			=> false,
			'exclude_from_search'	=> true,
			'supports'				=> array('title'),
		);
		register_taxonomy('tax_regiao', getAllPostTypes(), $args );
	}
?>