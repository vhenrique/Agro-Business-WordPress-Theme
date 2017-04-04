<?php get_header();
$ptTitle = get_post_type_object($wp_query->query_vars['post_type']); 
?>
<div class="body-content">
	<div class="wrap">
		<div class="postBoxSingle">
			<div class="main-title">
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
			<?php 
				global $themePrefix; 
				if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="headerInterview">
					<?php 
					$args = array(
						'p' => get_post_thumbnail_id(get_the_id()),
						'post_type' => 'attachment'
					);
					$thumb_image = get_posts($args);
					$thumb_caption = $thumb_image[0]->post_content;
					$attr = array(
						'title'		=> $thumb_caption,
						'class'		=> 'thumbInterview'
					);
					echo get_the_post_thumbnail($post->ID, 'thumb', $attr); ?>
					<div class="box-right">
						<h1 class="large-page-titleInterview"><?php the_title();?></h1>
						<span class="featuredPhrase"><?php if(strlen(get_post_meta(get_the_id(), $themePrefix.'featuredPhrase', true)) > 0) echo '<label></label>' . get_post_meta(get_the_id(), $themePrefix.'featuredPhrase', true); ?></span>
						
					</div>
					<hr class="single-line">
				</div>
				<div class="post-items">
				<span class="authorInterview"><?php if(strlen(get_post_meta(get_the_id(), $themePrefix.'postAuthor', true)) > 0) echo 'Por ' . get_post_meta(get_the_id(), $themePrefix.'postAuthor', true) . ' - '; ?><?php echo 'DATA: '.get_the_date('d/m/Y'); ?></span>
					<span class="excerpt"><?php echo $post->post_excerpt; ?></span>
					<span class="single-content"><?php the_content(); ?>
						<span class="social">
							<?php echo get_social_buttons($post->ID); ?>
						</span>
					</span>

					<div class="comments-wrapper"><?php comments_template(); ?></div>
				</div>

				<div class="box-right">
					<div class="phraseContent">
						<span class="featuredPhraseConten"><?php if(strlen(get_post_meta(get_the_id(), $themePrefix.'featuredPhraseLeft', true)) > 0) echo '<label class="breake"></label>'.get_post_meta(get_the_id(), $themePrefix.'featuredPhraseLeft', true); ?></span>
						<span class="who">
							<?php the_title();?>
						</span>
					</div>
				</div>
			</div>

				<div class="loadBanner">
					<?php wp_bannerize('group=content-esquerda'); ?>
				</div>

			<?php endwhile; endif; ?>
			<?php getFooterBanner(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>