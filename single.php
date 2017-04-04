<?php get_header();
$ptTitle = get_post_type_object($wp_query->query_vars['post_type']); ?>
<div class="body-content">
	<div class="wrap">
		<div class="postBoxSingle">
			<div>
				<h1 class="page-titleGreen">
					<?php 
					echo '<a href="'.get_home_url().'/'.get_post_type().'" title="'.$ptTitle->labels->name.'">' .$ptTitle->labels->name. '</a>';
					?>
				</h1>
				<hr class="titleLine">
			</div>
			<?php getCommodities(); ?>
			<div>
				<h1 class="page-titleGreenMobile">
					<?php 
					echo '<a href="'.get_home_url().'/'.get_post_type().'" title="'.$ptTitle->labels->name.'">' .$ptTitle->labels->name. '</a>';
					?>
				</h1>
			</div>
				<hr class="titleLineMobile">
			<?php global $themePrefix; 
				if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="post-items">
					<?php 
					$args = array(
						'p' => get_post_thumbnail_id(get_the_id()),
						'post_type' => 'attachment'
					);
					$thumb_image = get_posts($args);
					$thumb_caption = $thumb_image[0]->post_content;
					$attr = array(
						'title'		=> $thumb_caption,
						'class'		=> 'highlights'
					);
					if(strlen(get_the_post_thumbnail($post->ID, 'thumb', $attr)) > 0){
						echo get_the_post_thumbnail($post->ID, 'thumb', $attr);
						echo '<hr class="single-line">';
					}
					?>
				</div>

				<span class="date"><?php echo 'DATA: '.get_the_date('d/m/Y'); ?></span>
				<span class="title"><?php echo $post->post_title; ?></span>
				<span class="excerpt"><?php echo $post->post_excerpt; ?></span>
				<span class="author"><?php if(strlen(get_post_meta(get_the_id(), $themePrefix.'postAuthor', true)) > 0) echo 'Por ' . get_post_meta(get_the_id(), $themePrefix.'postAuthor', true); ?></span>
				<span class="single-content"><?php the_content(); ?>
					<span class="social">
						<?php echo get_social_buttons($post->ID); ?>
					</span>
				</span>

				<hr class="single-line">

				<div class="loadBanner">
					<?php wp_bannerize('group=content-esquerda'); ?>
				</div>
				
				<div class="comments-wrapper"><?php comments_template(); ?></div>

			<?php endwhile; endif; ?>
		</div>

		<?php get_sidebar('Sidebar'); ?>

		<div class="postBox">
			<a href="<?php echo get_home_url().'/'.get_post_type(); ?>" title="Ver mais notícias" class="seeMoreContent">Ver mais notícias ></a>
			<div class="blackTitle"><a href="<?php echo get_home_url();?>/as-noticias-mais-lidas/" title="As Notícias mais lidas">As Notícias mais lidas</a></div>
			<ul class="popular">
			<?php 
				$args = array(
					'post_type'			=> getAllPostTypes(),
					'posts_per_page'	=> 2,
        			'meta_key' 			=> 'popular_count',
					'orderby' 			=> 'meta_value',
					'order' 			=> 'DESC'
				);
				$populars = get_posts($args);
				if(!empty($populars)){
					foreach($populars as $popular){ ?>
						<li>
							<a href="<?php echo get_permalink($popular->ID)?>" title="<?php echo $popular->post_title; ?>">
								<?php echo get_the_post_thumbnail($popular->ID, 'popular-events-list')?>
							</a>
							<a href="<?php echo get_permalink($popular->ID); ?>" title="<?php echo $popular->post_title; ?>" class="title"><?php echo $popular->post_title; ?></a>
							<span class="content">
							<?php 
								if(strlen($popular->post_excerpt) > 80){
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
</div>
<?php get_footer(); ?>