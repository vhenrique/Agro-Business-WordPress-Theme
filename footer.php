	</div>
	<footer class="main footer">
		<div class="wrap">
				<div class="footer-content">
					<div class="left-box">
						<a href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo('site_title'); ?>">
							<img src="<?php echo geT_template_directory_uri(); ?>/assets/images/logoFooter.png">
						</a>
						<span class="info">
						<?php 
							global $redux_options, $themePrefix;
							if(!empty($redux_options[$themePrefix.'expedient'])){
								echo '<a href="'.$redux_options[$themePrefix.'expedient'].'" class="info-title">EXPEDIENTE</a>';
							} ?>
							<?php 
								if(isset($redux_options[$themePrefix.'title'])) echo '<span>'.$redux_options[$themePrefix.'title'].'</span>';
								if(isset($redux_options[$themePrefix.'adress'])) echo '<span>'.$redux_options[$themePrefix.'adress'].'</span>';
								if(isset($redux_options[$themePrefix.'neighborhood'])) echo '<span>'.$redux_options[$themePrefix.'neighborhood'].'</span>';
							?>
						</span>
					</div>

					<div class="middle-box">
						<span class="categories">CATEGORIAS</span>
						<?php wp_nav_menu(array('menu' => 'footer-menu')); ?>

						<span class="mission">MISSÃO</span>
						<span class="mission-content">
							<?php if(isset($redux_options[$themePrefix.'mission'])) echo $redux_options[$themePrefix.'mission']; ?>
						</span>
					</div>

					<div class="right-box">
						<ul class="social-networks">
							<?php 
							if(!empty($redux_options[$themePrefix.'facebook_url'])){
								echo '<li><div class="fb-like" data-href="'.$redux_options[$themePrefix.'facebook_url'].'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>';
							}
							// Twitter
							if(!empty($redux_options[$themePrefix.'twitter_url'])){
								echo '<li><a href="'.$redux_options[$themePrefix.'twitter_url'].'" title="Twitter" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/twitter_ico_green.png"></a></li>';
							}
							// Google+
							if(!empty($redux_options[$themePrefix.'googlePlus_url'])){
								echo '<li><a href="'.$redux_options[$themePrefix.'googlePlus_url'].'" title="Google plus" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/googlePlus_ico_green.png"></a></li>';
							}
							// Linkedin
							if(!empty($redux_options[$themePrefix.'linkedin_url'])){
								echo '<li><a href="'.$redux_options[$themePrefix.'linkedin_url'].'" title="Linkedin" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/linkedin_ico_green.png"></a></li>';
							}
							// Instagram
							if(!empty($redux_options[$themePrefix.'instagram_url'])){
								echo '<li><a href="'.$redux_options[$themePrefix.'instagram_url'].'" title="Instagram" target="_blank"><img src="'.get_template_directory_uri().'/assets/images/instagram_ico_green.png"></a></li>';
							}
							?>
						</ul>
						<form role="search" method="get" id="searchform" class="searchForm" action="<?php bloginfo('home'); ?>">
							<input type="text" name="s" class="search-text-footer"/>
							<input type="submit" value="" class="submit-footer" title="Buscar" />
						</form>
					</div>
					<a href="#top" class="returnTop" title="Voltar ao topo"></a>
				</div>
			</div>			
		</div>
	</footer>
	<script type="text/javascript"> if(typeof wabtn4fg==="undefined")   {wabtn4fg=1;h=document.head||document.getElementsByTagName("head")[0],s=document.createElement("script");s.type="text/javascript";s.src="<?php echo geT_template_directory_uri(); ?>/assets/whatsapp-button.js";h.appendChild(s)}</script>
	<div class="main">
		<div class="wrap">
		<span class="copyright">@2015 - Successful Farming Brasil. Todos os direitos reservados
			<?php 
			if(!empty($redux_options[$themePrefix.'privacy'])){
				echo ' | <a href="'.$redux_options[$themePrefix.'privacy'].'">Políticas de privacidade</a>';
			}
			if(!empty($redux_options[$themePrefix.'serviceTerms'])){
				echo '| <a href="'.$redux_options[$themePrefix.'serviceTerms'].'">Termos de serviço</a>';
			} ?>
		</span>
		<span class="copyright"><a href="http://avivatec.com.br/" title="Desenvolvido por AVIVATEC" target="_BLANK">Desenvolvido por AVIVATEC - Soluções em TI</a></span>
		<!-- Vitor Henrique da Silva - vhenrique.vhs@gmail.com -->
		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>