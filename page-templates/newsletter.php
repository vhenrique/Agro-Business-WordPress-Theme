<?php 
	require_once("../../../../wp-load.php");
	get_header(); ?>
	<div class="body-content">
		<div class="wrap">
			<div class="postBoxSingle">
				<div>
					<h1 class="page-titleGreen">
						Newsletter
					</h1>
					<hr class="titleLine">
				</div>
				<?php 
				global $redux_options, $themePrefix;
				getCommodities(); ?>
				<div>
					<h1 class="page-titleGreenMobile">
						<?php 
						echo '<a href="'.get_home_url().'/'.get_post_type().'" title="'.$ptTitle->labels->name.'">' .$ptTitle->labels->name. '</a>';
						?>
					</h1>
				</div>

				<div class="post-items">
					<img src="<?php echo ($redux_options[$themePrefix.'thumbnail']['url']); ?>" class="newsletterImg">
					<hr class="single-line"></div>

				<?php 
				if(isset($_POST['newName']) && isset($_POST['email'])){
					$userdata = array(
					    'user_login'  	=> 'assinante_'.$_POST['newName'].'_'.date('G_i_s'),
					    'user_email'	=> $_POST['email'],
					    'first_name'	=> $_POST['newName'],
					    'role'			=> 'assinante_newsletter'
					);
					$user_id = wp_insert_user( $userdata );
					if ( !is_wp_error( $user_id ) ) { 
						echo '<span class="title">'.$redux_options[$themePrefix.'newsLetterTitle'].'</span>';
						echo '<span class="title">'.$redux_options[$themePrefix.'newsLetterSubTitle'].'</span>';
						?>
					    <div class="cat-items">
					    	<form action="<?php $_SERVER['PHP_SELF']?>" method="GET">
								<?php 
									echo '<input type="hidden" name="userId" value="'.$user_id.'">';
									$terms = get_terms('tax_products', array('hide_empty' => 0));
									foreach ($terms as $term) {
										echo '<label>'.$term->name.'<input type="checkbox" name="term[]" value="'.$term->name.'"></label>';
									} 
								?>
								<input type="submit" value="Enviar">
							</form>
						</div>
					<?php 
					} else{
						echo '<h2>Você já possui cadastro em nossa Newsletter.</h2>';
					}
				}
				global $themePrefix;
				if(isset($_GET['userId'])){
					foreach ($_GET['term'] as $term) {
						$value = get_user_meta($_GET['userId'], $themePrefix.'cat_interesting', true);
						update_user_meta( $_GET['userId'], $themePrefix.'cat_interesting', $value.' '.$term);
					}
					echo '<h2>Seu cadastro foi feito com sucesso.</h2>';
					echo '<a href="'.get_home_url().'">Voltar para a home</a>';
					// header("Location: ".get_home_url());
				}?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer();?>