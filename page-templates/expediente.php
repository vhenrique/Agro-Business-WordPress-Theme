<?php get_header();
/*
* Template name: Expediente
*/
?>
<div class="body-content">
	<div class="wrap">
		<div class="postBox">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="post-items">
					<?php getCommodities();?>
					<?php echo get_the_post_thumbnail($post->ID, 'featured-post'); ?>
					<hr class="single-line">
				</div>

				<span class="title"><?php echo $post->post_title; ?></span>
				<span class="excerpt"><?php echo $post->post_excerpt; ?></span>
				<span class="single-content"><?php the_content(); ?></span>

				<hr class="single-line">

				<div class="loadBanner">
					<?php wp_bannerize('group=content'); ?>
				</div>
				
				<div class="comments-wrapper"><?php comments_template(); ?></div>

			<?php endwhile; endif; ?>
		</div>

		<?php get_sidebar('Sidebar'); ?>

		<div class="postBox">
			<div class="blackTitle"><a href="<?php echo get_home_url();?>/as-noticias-mais-lidas/">As Notícias mais lidas</a></div>
			<ul class="popular">
			<?php 
				$args = array(
					'post_type'			=> getAllPostTypes(),
					'posts_per_page'	=> 2,
					'meta_key'			=> 'popular_count',
    				'orderby'   		=> 'meta_value_num'
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
							<span class="greenPopular">
								<?php // echo get_post_meta($popular->ID, 'popular_count', true); ?>
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