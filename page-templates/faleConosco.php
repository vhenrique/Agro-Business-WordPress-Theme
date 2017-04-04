<?php get_header();
/*
* Template name: Fale conosco
*/
?>
<div class="body-content">
	<div class="wrap">
		<div class="postBox">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<hr class="titleLine">
			<input type="hidden" class="functionsUrl" value="<?php echo get_template_directory_uri()?>/extensions/ajax/functionsLoad.php">
			<input type="hidden" class="siteLink" value="<?php echo get_home_url(); ?>">
			<div class="box">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/spinner.gif" class="spinnerContact">
				<form method="POST">
					<label for="name">Seu nome (obrigatório)</label>
					<input type="text" name="formName" id="name"/>

					<label for="email">Seu e-mail (obrigatório)</label>
					<input type="email" name="formEmail" id="email"/>

					<label for="subject">Assunto do e-mail</label>
					<input type="text" name="formSubject" id="subject"/>

					<label for="message">Mensagem</label>
					<textarea name="formMessage" id="message" rows="10"></textarea>

					<input type="submit" value="Enviar" class="contactSubmit" />
					<img src="<?php echo get_template_directory_uri();?>/assets/images/logo.png" >
				</form>
			</div>
		</div>
		<?php get_sidebar();?>
	</div>
</div>
<?php 
	wp_mail(get_option('admin_email'), get_option('blogname').' - '.$_POST['formSubject'], $_POST['formName'].' - '.$_POST['formEmail']." enviou uma mensagem através do formulário de contato. \r\n".$_POST['formMessage']);
get_footer(); ?>