<?php get_header();
$ptTitle = get_post_type_object($wp_query->query_vars['post_type']); ?>
	<div class="body-content">
		<div class="wrap">
			<div class="postBox">
				<h1 class="page-title"><?php echo $ptTitle->labels->name;?></h1>
				<hr class="titleLine">
				<?php $pt = $wp_query->query_vars['post_type']; ?>
				<?php getCommodities(); ?>
				<h1 class="page-titleMobile"><?php echo $ptTitle->labels->name;?></h1>
				<hr class="titleLineMobile">
				<div class="featuredBox">
					<?php 
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array('post_type' => $pt, 'paged' => $paged);
						$query = new WP_Query($args);	
						if($query->have_posts()){
							while ($query->have_posts() ){
								$query->the_post(); ?>
								<div class="box">
									<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title() ?>" class="post_title">
										<?php echo get_the_post_thumbnail(get_the_id(), 'popular-events-list')?>
									</a>
									<a href="<?php echo get_permalink(); ?>" class="title" title="<?php echo get_the_title() ?>"><?php echo get_the_title(); ?></a>
									<span class="content">
										<?php echo get_the_excerpt(); ?> <a href="<?php echo get_permalink(); ?>" class="seeMore" title="<?php echo get_the_title(); ?>">LEIA MAIS ></a>
									</span>
								</div>
						<?php }
						get_numeric_pagination();
						}
					?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div><!-- body-content -->
<?php get_footer(); ?>