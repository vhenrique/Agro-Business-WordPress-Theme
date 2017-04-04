<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {
	global $themePrefix;
	// Featured posts
	$meta_boxes['posts_metabox'] = array(
		'id'         => 'post_metabox',
		'title'      => 'Opções de destaque',
		'pages'      => getAllPostTypes(),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => 'Incluir na listagem de publicações da Home Page?',
				'desc' => 'Sim',
				'id'   => $themePrefix . 'home',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Tornar este post um destaque?',
				'desc' => 'Sim',
				'id'   => $themePrefix . 'featured',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Autor',
				'desc' => 'Autor da publicação',
				'id'   => $themePrefix . 'postAuthor',
				'type' => 'text',
			)
		)
	);
	
	// Events
	$meta_boxes['events_metabox'] = array(
		'id'			=> 'videos_metabox',
		'title'			=> 'Data',
		'pages'			=> array('pt_events'),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'		=> 'Data do evento',
				'desc'		=> 'Informe em que dia o evento será realizado.',
				'id'		=> $themePrefix . 'date',
				'type'		=> 'text_date_timestamp'
			)
		)
	);

	// User newsletter
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'Caps', 'cmb' ),
		'pages'      => array( 'user' ), 
		'show_names' => true,
		'cmb_styles' => false,
		'fields'     => array(
			array(
				'name'     	=> __( 'Categorias de interesse.'),
				'desc'     	=> __( 'Essas opções são válidas somente para assinantes da Newsletter.', 'cmb' ),
				'id'       	=> $themePrefix . 'cat_interesting',
				'type' 		=> 'text'
			),
		)

	);

	// Interview featured phrase
	$meta_boxes['interview_metabox'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'Info', 'cmb' ),
		'pages'      => array( 'pt_interviews' ), 
		'show_names' => true,
		'cmb_styles' => false,
		'fields'     => array(
			array(
				'name'     	=> __( 'Frase de destaque.'),
				'desc'     	=> __( 'Esta frase será exibida no topo da página da entrevista.', 'cmb' ),
				'id'       	=> $themePrefix . 'featuredPhrase',
				'type' 		=> 'text'
			),
			array(
				'name'     	=> __( 'Frase de destaque.'),
				'desc'     	=> __( 'Esta frase será exibida a esquerda da página da entrevista.', 'cmb' ),
				'id'       	=> $themePrefix . 'featuredPhraseLeft',
				'type' 		=> 'text'
			),
		)
	);
	return $meta_boxes;	
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
// Initialize the metabox class.
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'custom-metaboxes/init.php';

}