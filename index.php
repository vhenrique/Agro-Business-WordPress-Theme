<?php get_header(); ?>
	<div class="body-content">
		<div class="wrap">
			<div class="featured-post">
			<?php 
			global $themePrefix;
			$args = array(
				'post_type'			=> getAllPostTypes(),
				'posts_per_page'	=> 1,
				'meta_query'		=> array(array('key' => $themePrefix.'featured', 'value' => 'on')),
			);
			$recents = get_posts($args);
			if(!empty($recents)){ ?>
				<?php foreach($recents as $recent){ 
					$seenPosts[] = $recent->ID; ?>
					<div class="post-items">
						<?php getCommodities(); ?>
						<a href="<?php echo get_permalink($recent->ID); ?>" title="<?php echo $recent->post_title; ?>" class="featuredLink">
							<?php 
							echo get_the_post_thumbnail($recent->ID, 'featured-post', array('class'=>'highlights')); ?>
							<span class="post-info">
								<span class="post-title"><?php echo $recent->post_title; ?></span>
							</span>
						</a>
					</div>
			<?php }
			}
			?>
			</div><!-- featured-post -->

			<div class="box-right box-rightQuotation">
				<div class="blackTitle">Cotações<label>Fonte: Safras & Mercado</label></div>
				<div class="background">
					<select class="commodities"></select>
				</div>

				<label class="exchange"></label>
				<div id="linechart_material"></div>
				<span class="featured"></span>
				<a href="<?php echo get_home_url(); ?>/cotacoes/" class="moreQuotation"></a>
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

			<div class="postBox">
			<?php 
				$args = array(
					'post_type'			=> getAllPostTypes(),
					'posts_per_page'	=> 3,
					'post__not_in'		=> $seenPosts,
					'meta_query'		=> array(array('key' => $themePrefix.'home', 'value' => 'on')),
				);
				$posts = get_posts($args);
				if(!empty($posts)){
					foreach($posts as $post){ 
						$seenPosts[] = $post->ID; ?>
						<div class="box">
							<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>" class="post_title">
								<?php echo get_the_post_thumbnail($post->ID, 'post-list')?>
							</a>
							<a href="<?php echo get_permalink($post->ID); ?>" class="title" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
							<span class="content">
								<?php echo $post->post_excerpt; ?> <a href="<?php echo get_permalink(); ?>" class="seeMore" title="<?php echo get_the_title(); ?>">LEIA MAIS ></a>
							</span>
						</div>
						
				<?php }
				}
			?>
			</div>
			<div class="box-right box-rightWeather">
				<div class="blackTitle">Previsão do Tempo</div>
				<input type="hidden" class="functionsUrl" value="<?php echo get_template_directory_uri()?>/extensions/ajax/functionsLoad.php">
				<div class="margin weatherBackground">
					<input type="text" class="txtCity" placeholder="Sua cidade">
					<span class="autoComplete"></span>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/spinner.gif" class="spinner">
					<div class="weather"></div>
					<span class="dataSource" title="Fonte de dados: Inmet">Fonte: Inmet</span>
				</div>
			</div>

			<div class="banner banner_content">
				<?php wp_bannerize('group=content-esquerda'); ?>
				<?php wp_bannerize('group=content-direita'); ?>
			</div>

			<div class="postBox">
			<?php 
				$args = array(
					'post_type'			=> getAllPostTypes(),
					'posts_per_page'	=> 3,
					'post__not_in'		=> $seenPosts,
					'meta_query'		=> array(array('key' => $themePrefix.'home', 'value' => 'on'))
				);
				$posts = get_posts($args);
				if(!empty($posts)){
					foreach($posts as $post){ ?>
						<div class="box">
							<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title; ?>" class="post_title">
								<?php echo get_the_post_thumbnail($post->ID, 'post-list')?>
							</a>
							<a href="<?php echo get_permalink($post->ID); ?>" class="title" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
							<span class="content">
								<?php echo $post->post_excerpt; ?> <a href="<?php echo get_permalink(); ?>" class="seeMore" title="'.get_the_title().'">LEIA MAIS ></a>
							</span>
						</div>
				<?php }
				}
			?>
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
				<?php $args = array('post_type' => 'pt_events', 'posts_per_page' => 4, 'meta_key' => $themePrefix.'date', 'orderby' => 'meta_value', 'order' => 'DESC');
					$events = get_posts($args);
					if(!empty($events)){
						foreach($events as $event){
							echo '<li><a href="'.get_permalink($event->ID).'" title="'.$event->post_title.'" class="dateTitle">';
							echo '> '. date("d/m", get_post_meta($event->ID, $themePrefix.'date', true)).'</a>';
							echo '<a href="'.get_permalink($event->ID).'" title="'.$event->post_title.'" class="title">'.$event->post_title.'</a></li>';
						}
					} ?>					
				</ul>
				<a href="<?php echo get_home_url()?>/pt_events/" class="seeMoreEvents" title="Veja a lista completa de eventos">Confira a lista completa de eventos</a>
			</div>

			<div class="postBox" id="moreSeenMargin">
				<div class="blackTitle"><a href="<?php echo get_home_url();?>/as-noticias-mais-lidas/" title="As Notícias mais lidas">As Notícias mais lidas</a></div>
				<ul class="popular">
				<?php 
					$args = array('post_type' => getAllPostTypes(), 'posts_per_page' => 2, 'meta_key' => 'popular_count', 'orderby' => 'meta_value', 'order' => 'DESC');
					$populars = get_posts($args);
					if(!empty($populars)){
						foreach($populars as $popular){ ?>
							<li>
								<a href="<?php echo get_permalink($popular->ID)?>" title="<?php echo $popular->post_title; ?>">
									<?php echo get_the_post_thumbnail($popular->ID, 'popular-events-list')?>
								</a>
								<a href="<?php echo get_permalink($popular->ID); ?>" title="<?php echo $popular->post_title; ?>" class="title"><?php echo $popular->post_title; ?></a>
								<span class="contentPopular">
								<?php 
									if(strlen($popular->post_excerpt) > 300){
										echo substr($popular->post_excerpt, 0, 300). ' <a href="'.get_permalink($popular->ID).'" class="seeMore" title="'.$popular->post_title.'">LEIA MAIS ></a>';
									} else{
										echo $popular->post_excerpt;
									}
								?>
								</span>
							</li>
					<?php }
					}
				?>
				</ul>
			</div>
			<?php getFooterBanner(); ?>
		</div>
	</div><!-- body-content -->

<?php get_footer(); ?>