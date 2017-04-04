<?php

//include the main class file
$extensions_path = TEMPLATEPATH . '/extensions/';
if(file_exists($extensions_path . 'tax-meta-class/tax-meta-class.php')) require_once($extensions_path . 'tax-meta-class/tax-meta-class.php');

if (is_admin()){
	global $themePrefix, $wpdb;

	/* term meta de Produtos */
	$config = array(
		'id'				=> 'products_meta_box',
		'title'				=> 'Opções de produtos',
		'pages'				=> array('tax_products'),
		'context'			=> 'normal',
		'fields'			=> array(),
		'local_images'		=> false,
		'use_with_theme'	=> true
	);
	$products_meta = new Tax_Meta_Class($config);
	// Imagem
	$products_meta->addImage(
		$themePrefix.'product_ico',
		array('name'=> 'Ícone')
	);
	$products_meta->Finish();
}
