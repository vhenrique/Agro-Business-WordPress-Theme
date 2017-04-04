	<div id="sidebar">
		<div class="box-right">
			<div class="blackTitle">Cotações<label>Fonte: Safras & Mercado</label></div>
				<div class="background">
					<select class="commodities"></select>
				</div>

				<label class="exchange"></label>
				<div id="linechart_material"></div>
				<ul class="quotation"></ul>
				<span class="featured"></span>
				<a href="/cotacoes/" class="moreQuotation"></a>
		</div>

		<div class="box-right">
			<div class="greenTitle">Assine nossa newsletter</div>
			<div class="margin newsLetterBackground">
				<span class="desc">Receba nosso conteúdo gratuitamente</span>
				<form action="<?php echo get_template_directory_uri().'/page-templates/newsletter.php';?>" method="POST">
					<input type="text" name="newName" placeholder="Nome" class="newsletterName">
					<input type="email" name="email" placeholder="e-mail" class="newsletterEmail">
					<input type="submit" value="Enviar" class="newsSubmit">
				</form>
			</div>
		</div>

		<div class="box-right">
			<div class="blackTitle">Previsão do Tempo</div>
			<input type="hidden" class="functionsUrl" value="<?php echo get_template_directory_uri()?>/extensions/ajax/functionsLoad.php">
			<div class="margin weatherBackground">
				<input type="text" class="txtCity" placeholder="Sua cidade">
				<span class="autoComplete"></span>

				<div class="weather"></div>
			</div>
		</div>

		<div class="box-right">
			<div class="blackTitle">Enquete</div>
			<div class="margin pollBackground">
				<?php if (function_exists('vote_poll') && !in_pollarchive()): ?>
				  <li>
				    <ul>
				      <li><?php get_poll();?></li>
				    </ul>
				  </li>
				<?php endif; ?>
			</div>
		</div>

		<div class="box-right">
			<div class="blackTitle">Calendário de eventos</div>
			<ul class="events">
			<?php global $themePrefix;
				$args = array('post_type' => array('pt_events'), 'posts_per_page' => 4, 'meta_key' => $themePrefix.'date', 'orderby' => 'meta_value', 'order' => 'DESC');
				$events = get_posts($args);
				if(!empty($events)){
					foreach($events as $event){
						echo '<li><a href="'.get_permalink($event->ID).'" title="'.$event->post_title.'" class="dateTitle">';
						echo '> '. date("d/m", get_post_meta($event->ID, $themePrefix.'date', true)).'</a>';
						echo '<a href="'.get_permalink($event->ID).'" title="'.$event->post_title.'" class="title">'.$event->post_title.'</a></li>';
					}
				} ?>
			</ul>
			<a href="<?php echo get_home_url()?>/pt_events/" class="seeMoreEvents" title="Confira a lista completa de eventos">Confira a lista completa de eventos</a>
		</div>
	</div>