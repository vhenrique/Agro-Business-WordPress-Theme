<?php get_header(); ?>
	<div class="body-content">
		<div class="wrap">
			<div class="postBox">
				<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
			            'post_type'         => getAllPostTypes(),
			            'paged'             => $paged,
			            's'                 => $_GET['s']
			        ); 
					$query = new WP_Query($args);	
					if($query->have_posts()){ ?>
						<h2 class="page-title">Resultados da busca: <i><?php echo $_GET['s']; ?></i></h2>
						<?php while ($query->have_posts() ){
							$query->the_post(); ?>
							<div class="box">
								<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="post_title">
									<?php echo get_the_post_thumbnail(get_the_id(), 'popular-events-list')?>
								</a>
								<a href="<?php echo get_permalink(); ?>" class="title" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
								<span class="content">
									<?php echo get_the_excerpt() ?> <a href="<?php echo get_permalink(); ?>" class="seeMore" title="'.get_the_title().'">LEIA MAIS ></a>
								</span>
								<span class="social">
									<?php echo get_social_buttons(get_the_id());?>
								</span>
							</div>
							<hr class="line">
					<?php }
						get_numeric_pagination();
					} else{
						echo '<h2 class="legend">A busca por <i>'.$_GET['s'].'</i> não retornou resultados.</h2>';
					}
				?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div><!-- body-content -->
<?php get_footer(); ?>