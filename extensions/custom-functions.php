<?php
	add_action('init', 'allToUnix');
	function allToUnix(){
		global $themePrefix;
		$args = array('post_type'=>'pt_events', 'posts_per_page'=>-1);
		$events = get_posts($args);
		if(!empty($events)){
			foreach($events as $event){
				if(strlen(strtotime(get_post_meta($event->ID, $themePrefix.'date', true))) > 1){
					update_post_meta($event->ID, $themePrefix.'date', strtotime(get_post_meta($event->ID, $themePrefix.'date', true)));
				}
			}
		}
	}

// Add all post feed
	add_filter('request', 'myfeed_request');
	function myfeed_request($qv) {
		if (isset($qv['feed']))
			$qv['post_type'] = getAllPostTypes();
		return $qv;
	}

// Rename email sender
	add_filter('wp_mail_from_name', 'new_mail_from_name');
	function new_mail_from_name($old) {
		return get_bloginfo('name');
	}

// Get header banners
function getHeaderBanner(){
	if(function_exists( 'wp_bannerize' )){
		echo '<div class="banner top-banner"><div class="wrap">';
			wp_bannerize('group=cabecalho-esquerda', 'limit=1');
			wp_bannerize('group=cabecalho-direita', 'limit=1');
		echo '</div></div>';
	}
}
// Get footer banners
function getFooterBanner(){
	if(function_exists( 'wp_bannerize' )){
		echo '<div class="advertisingTitle">Publicidade</div>';
		echo '<div class="advertisingContent">';
			wp_bannerize('group=home_group', 'limit=3');
		echo '</div>';
	}
}
// Take the current commodities values and update database with that contains
	add_action( 'wp', 'dailyFunctionApi' );
	add_action('dailyEventApi', 'getDailyEventApi');
	function dailyFunctionApi() {
		// This function will be call everyday at 09:30PM
		if( !wp_next_scheduled( 'dailyEventApi' ) ) {
			wp_schedule_event(strtotime('18:01:00'), 'daily', 'dailyEventApi');
		}
	}
	function getDailyEventApi() {
		// Get the XML value in API and transform to a simple php object
		$xml = new SimpleXMLElement(file_get_contents('http://sfeed-cot01.cma.com.br/clientes/meredith/futuros.xml'));

		// Take last post updated with Api values to compare the date
		$args = array('posts_per_page' => 1, 'post_status' => 'private', 'post_type' => 'pt_quotationApi');
		$lastUpdated = get_posts($args);
		$content = json_decode($lastUpdated[0]->post_content);

		// Compare the last date updated with the current date api response
		if(strlen($xml->QUOTES[0]->PAPEL) > 1 && $xml->QUOTES[0]->DATA != substr($content[0]->day, 0, 5)){
			for($i = 0; $i < count($xml->QUOTES); $i++){
				if(strlen($xml->QUOTES[$i]->DATA) > 1){
					$data = $xml->QUOTES[$i]->DATA.date('/Y');
				} else{
					$data = date('d/m/Y');
				}
				$result[] = array(
					'key'			=> (string)$xml->QUOTES[$i]->PAPEL,
					'origin'		=> (string)$xml->QUOTES[$i]->ORIGEM,
					'description'	=> (string)$xml->QUOTES[$i]->DESCRICAO,
					'maturityMonth'	=> substr($xml->QUOTES[$i]->VENCIMENTO, 0, 3),
					'maturityYear'	=> substr($xml->QUOTES[$i]->VENCIMENTO, 4, 9),
					'closing'		=> (string)$xml->QUOTES[$i]->FECHAMENTO,
					'diferential'	=> (string)$xml->QUOTES[$i]->DIFERENCIAL,
					'hour'			=> (string)$xml->QUOTES[$i]->HORA,
					'day'			=> (string)$data
				);
			}
			if(!empty($result)){
				$post = array(
					'post_content'		=> json_encode($result),
					'post_title'		=> 'History - ' . date('d/m/Y') . ' at ' . date('H:i:s'),
					'post_status'		=> 'private',
					'post_type'			=> 'pt_quotationApi',
					'post_author'		=> 1
				);
				// Inser a new post with the API returns
				wp_insert_post($post, true);
			}
		}
	}

// Get commodities and icons
	function getCommodities(){
		global $themePrefix;
		echo '<div class="tax-items">';
		$products = get_terms( 'tax_products', array('hide_empty' => true) );
		if(!empty($products)){
			foreach($products as $product){
				$ico = get_tax_meta($product->term_id, $themePrefix.'product_ico');
				if(isset($ico["url"])){
					echo '<a href="'.get_term_link($product, 'tax_products').'" id="'.$product->slug.'"><img src="'.$ico["url"].'" title="'.$product->name.'">';
					echo '<label class="'.$product->slug.'" for="'.$product->slug.'">'.$product->name.'</label></a>';
				}
			}
		}
		echo '</div>';
	}
// Return all post types
	function getAllPostTypes(){
		return array('pt_business', 'pt_agrobusiness', 'pt_markets', 'pt_technologies', 'pt_policies', 'pt_logistics', 'pt_interviews', 'pt_events');
	}
//Export user at newsletter
	add_action('admin_init', 'export_newsletter');
	function export_newsletter(){
		add_submenu_page( 'users.php', 'Exportação de Newsletter', 'Exportar assinantes da Newsletter', 'administrator', 'export-newsletter');
	}

// Get posts more seen
	function count_more_seen($id){
		if(strlen(get_post_meta($id, 'popular_count', true)) > 0){
			update_post_meta($id, 'popular_count', get_post_meta($id, 'popular_count', true)+1);
		} else{
			add_post_meta($id, 'popular_count', 1);
		}
	}
//Get custom post types
	function get_custom_post_types(){
		$post_types = get_post_types();
		foreach($post_types as $post_type){
			$pts = get_post_type_object($post_type);
			$result[$post_type] = $pts->labels->name;
		}
		unset($result['page'], $result['post'], $result['revision'], $result['nav_menu_item'], $result['pt_videos'], $result['pt_quotationapi'], $result['attachment']);
		return $result;
	}
// enqueue JS to share published posts at Facebook
	add_action('admin_enqueue_scripts', 'jsLoad');
	function jsLoad(){
		wp_enqueue_script('functions', get_template_directory_uri() . '/assets/js/adminFunctions.js', array('jquery'), '', true);
	}

// Social share buttons
	function get_social_buttons($id){
		// Facebook
		$button = '<div class="socialAlign fb"><div class="fb-share-button" data-href="'.get_permalink($id).'" data-layout="button_count"></div></div>';
		// Twitter
		$button .= '<div class="socialAlign tw"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.get_permalink($id).'" data-text="'.get_the_title($id).'"  data-counturl="'.get_permalink($id).'">Tweet</a></div>';
		// Linkedin
		$button .= '<div class="socialAlign in" ><script type="IN/Share" data-url="'.get_permalink($id).'" data-counter="right"></script></div>';
		// Whatsapp
		$button .= '<div class="socialAlign wt"><a href="whatsapp://send" data-text="'.get_the_title($id).' - " data-href="'.get_permalink($id).'" class="wa_btn wa_btn_s">Compartilhar</a></div>';
		// Google+
		$button .= '<div class="socialAlign gp"><div class="g-plus" data-action="share" href="'.get_permalink($id).'" data-annotation="bubble" data-height="20"></div></div>';
		return $button;
	}

// Custom numeric pagination function
	function get_numeric_pagination(){
		global $wp_query;
		global $numpages;
		$total_pages	= $wp_query->max_num_pages;
		$big			= 999999999; // need an unlikely integer
		if($total_pages > 1){
			echo '<div class="numeric-pagination">';
			echo paginate_links(
				array(
					'base'		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format'	=> '/page/%#%',
					'current'	=> max(1, get_query_var('paged')),
					'total'		=> $wp_query->max_num_pages,
					'type'		=> 'list',
					'prev_text'	=> ' < notícias recentes',
					'next_text'	=> ' notícias anteriores > '
				)
			);
			echo '</div>';
		}
	}

// Remove default post type
add_action('admin_menu','remove_default_post_type');
function remove_default_post_type() {
	remove_menu_page('edit.php');
}
?>