<?php 
	require_once('../../../../../wp-load.php');
	//Search city
	if($_GET['function'] == 'cityList'){
		$complete = file_get_contents('http://www.inmet.gov.br/portal/index.php?r=prevmet/municipioWebservice/listaCidadesJson');

		$json = json_decode($complete);
		for($i = 0; $i < count($json); $i++){
			if(strpos(strtolower($json[$i]->nome), strtolower($_GET['city']))!== FALSE) {
				$result[] = array('geocode'=>$json[$i]->geocode, 'nome'=>$json[$i]->nome, 'uf'=>$json[$i]->uf, 'lat'=>$json[$i]->lat, 'lon'=>$json[$i]->lon);
			}
		}
		echo json_encode($result);
	} else if($_GET['function'] == 'weatherForecast'){
		$complete = file_get_contents('http://www.inmet.gov.br/portal/index.php?r=prevmet/previsaoWebservice/getJsonPrevisaoDiariaPorCidade&code='.$_GET['code']);
		$json = json_decode($complete);

		$today =  new DateTime();
		$today = $today->format('d-m-Y');
		$nextDay1 = new DateTime('+1 day');
		$nextDay1 = $nextDay1->format('d-m-Y');
		$nextDay2 = new DateTime('+2 day');
		$nextDay2 = $nextDay2->format('d-m-Y');
		$nextDay3 = new DateTime('+3 day');
		$nextDay3 = $nextDay3->format('d-m-Y');
		$nextDay4 = new DateTime('+4 day');			
		$nextDay4 = $nextDay4->format('d-m-Y');
		$dates = array($today, $nextDay1, $nextDay2, $nextDay3, $nextDay4);

		for($i = 0; $i < count($dates); $i++){
			$result[$i] = $json->{$_GET['code']}->$dates[$i];
		}
		echo json_encode($result);
	} else if($_GET['function'] == 'findLocation'){
		$complete = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$_GET['lat'].','.$_GET['lon'].'&sensor=true');
		$json = json_decode($complete);	

		for($i = 0; $i < sizeof($json->results[0]->address_components); $i++){
			if($json->results[0]->address_components[$i]->types[0] == 'administrative_area_level_2'){
				$result[] = array('city' => $json->results[0]->address_components[$i]->long_name);
			}
		}
		echo json_encode($result);
	} else if($_GET['function'] == 'getQuotationDolar'){
		$complete = file_get_contents('http://sfeed-cot01.cma.com.br/clientes/meredith/moedas.xml');
		echo $complete;
	} else if($_GET['function'] == 'getCommodities'){
		$xml = new SimpleXMLElement(file_get_contents('http://sfeed-cot01.cma.com.br/clientes/meredith/futuros.xml'));
		for($i = 0; $i < count($xml->QUOTES); $i+=2){
			// Verify the key and translate to the name of commoditie (the keys are created by API, It was necessary to translate)
			switch (substr($xml->QUOTES[$i]->PAPEL, 0, 2)) {
				// Sugar
				case 'SB':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 2),
						'key'			=> 'Açúcar'
					);
					break;
				// Cotton
				case 'CT':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 2),
						'key'			=> 'Algodão'
					);
					break;
				// Coffee
				case 'KC':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 2),
						'key'			=> 'Café'
					);
					break;
				// Orange juice
				case 'OJ':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 2),
						'key'			=> 'Suco de laranja',
					);
					break;
				// Soybeans
				case 'ZS':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 2),
						'key'			=> 'Soja'
					);
					break;
				// Corn
				case 'ZC':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 2),
						'key'			=> 'Milho'
					);
					break;
				// Wheat
				case 'ZW':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 2),
						'key'			=> 'Trigo'
					);
					break;
				default:
					$result[] = array('id'=>'fail', 'key'=>'');
					break;
			}
		}
		echo json_encode($result);
	} else if($_GET['function'] == 'getFutureQuotation'){
		$args = array(
			'post_type'			=> 'pt_quotationapi',
			'posts_per_page'	=> 5,
			'post_status'		=> 'private'
		);
		// Get lastest posts at quotation API post_type
		$quotations = get_posts($args);
		foreach($quotations as $quotation){
			// Concat the content in array
			$result = json_decode($quotation->post_content);
			for($i = 0; $i < count($result); $i+=2){
				// Compare commodity
				if(substr($result[$i]->key, 0, 2) == $_GET['commodity']){
					// Once
					$jsonResult[] = $result[$i];
				}
			}
		}
		echo json_encode(array_reverse($jsonResult));
	} else if($_GET['function'] == 'getFutureQuotationPage'){
		if($_GET['period'] == 1){
			$args = array(
				'post_type'			=> 'pt_quotationapi',
				'posts_per_page'	=> 22,
				'post_status'		=> 'private'
			);
			// Get lastest posts at quotation API post_type
			$quotations = get_posts($args);
			for($i = 0; $i < count($quotations); $i++){
				// Concat the content in array
				$result = json_decode($quotations[$i]->post_content);
				for($n = 0; $n < count($result); $n+=2){
					// Compare commodity
					if(substr($result[$n]->key, 0, 2) == $_GET['commodity']){
						$jsonResult[] = $result[$n];
					}
				}
			}
			echo json_encode(array_reverse($jsonResult));			
		}
	} else if($_GET['function'] == 'getFutureQuotationPageTable'){
		$args = array(
			'post_type'			=> 'pt_quotationapi',
			'posts_per_page'	=> 1,
			'post_status'		=> 'private'
		);
		// Get lastest posts at quotation API post_type
		$quotations = get_posts($args);
		// Concat the content in array
		$result = json_decode($quotations[0]->post_content);
		for($n = 0; $n < count($result); $n++){
			// Compare commodity
			if(substr($result[$n]->key, 0, 2) == $_GET['commodity']){
				$jsonResult[] = $result[$n];
			}
		}
		echo json_encode($jsonResult);
	} 
	else if($_GET['function'] == 'getFisicCommodities'){
		// Call to API, wait to receive response and transform to an array objects
		$xml = new SimpleXMLElement(file_get_contents('http://sfeed-cot01.cma.com.br/clientes/meredith/fisicos.xml'));
		// Loop that make step 3 to 3
		for($i = 0; $i < count($xml->QUOTES); $i+=3){
			switch (substr($xml->QUOTES[$i]->PAPEL, 0, 3)) {
				// Soybeans
				case 'SOJ':	
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Soja'
					);
					break;
				// Corn
				case 'MIL':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Milho'
					);
					break;
				// Cotton
				case 'ALG':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Algodão'
					);
					break;
				// Coffee
				case 'CFD':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Café',
					);
					break;
				// bull
				case 'BOI':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Boi gordo'
					);
					break;
				// Corn
				case 'TRG':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Trigo'
					);
					break;
				// Wheat
				case 'ACR':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Açúcar'
					);
					break;
			// Alcohol
				case 'ALC':
					$result[] = array(
						'id'			=> substr($xml->QUOTES[$i]->PAPEL, 0, 3),
						'key'			=> 'Álcool'
					);
			}
		}
		echo json_encode($result);
	} else if($_GET['function'] == 'getFisicQuotationPage'){
		$xml = new SimpleXMLElement(file_get_contents('http://sfeed-cot01.cma.com.br/clientes/meredith/fisicos.xml'));
		// print_r($xml);
		for($i = 0; $i < count($xml->QUOTES); $i++){
			if(substr($xml->QUOTES[$i]->PAPEL, 0, 3) == $_GET['commodity']){
				$desc = (string)$xml->QUOTES[$i]->DESCRICAO;
				if(strpos($desc, 'Paranagua') > 0){
					$desc = str_replace("Paranagua", "Paranaguá", $desc);
				} 
				if(strpos($desc, 'Rondonopolis') > 0){
					$desc = str_replace("Rondonopolis", "Rondonópolis", $desc);
				} 
				if(strpos($desc, 'Algodao') > 0 || strpos($desc, 'Algodao') == '000'){
					$desc = str_replace("Algodao", "Algodão", $desc);
				} 
				if(strpos($desc, 'Cafe') > 0 || strpos($desc, 'Cafe') == '000'){
					$desc = str_replace("Cafe", "Café", $desc);
				} 
				if(strpos($desc, 'Aracatuba') > 0){
					$desc = str_replace("Aracatuba", "Araçatuba", $desc);
				} 
				if(strpos($desc, 'Garca') > 0){
					$desc = str_replace("Garca", "Garça", $desc);
				} 
				if(strpos($desc, 'Sao ') > 0){
					$desc = str_replace("Sao ", "São ", $desc);
				} 
				if(strpos($desc, 'Acucar') > 0 || strpos($desc, 'Acucar') == '000'){
					$desc = str_replace("Acucar", "Açúcar", $desc);
				} 
				if(strpos($desc, 'Maringa') > 0){
					$desc = str_replace("Maringa", "Maringá", $desc);
				} 
				if(strpos($desc, 'Alcool') > 0 || strpos($desc, 'Alcool') == '000'){
					$desc = str_replace("Alcool", "Álcool", $desc);
				} 
				
				$result[] = array(
					'PAPEL'		=> $xml->QUOTES[$i]->PAPEL,
					'ORIGEM'	=> $xml->QUOTES[$i]->ORIGEM,
					'DESCRICAO' => $desc,
					'PRECO'		=> $xml->QUOTES[$i]->PRECO,
					'MINIMO'	=> $xml->QUOTES[$i]->MINIMO,
					'MAXIMO'	=> $xml->QUOTES[$i]->MAXIMO,
					'HORA'		=> $xml->QUOTES[$i]->HORA,
					'DATA'		=> $xml->QUOTES[$i]->DATA
				);
			}
		}
		echo json_encode($result);
	} else if($_GET['function'] == 'sendContactForm'){
		wp_mail( get_option( 'admin_email'), $_GET['subject'], $_GET['name']." - ".$_GET['email']." enviou uma mensagem através do furmulário de contato. \r\n \r\n".$_GET['message']);
	}
?>