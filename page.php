<?php get_header(); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>	
<div class="body-content">
	<div class="wrap">
		<div class="postBox">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<input type="hidden" class="siteLink" value="<?php echo get_home_url(); ?>">
			<div class="box">
				<span class="content">
					<?php the_content(); ?>
				</span>
			</div>
		</div>
		<?php 
		endwhile;
		endif;
		get_sidebar();?>
	</div>
</div>
<?php get_footer(); ?>