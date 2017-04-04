<?php get_header();
/*
* Template name: Cotações
*/
?>

<div class="body-content">
	<div class="wrap">
		<div class="postBox">
			<h1 class="large-page-title"><?php echo $post->post_title;?></h1>
			<h4 class="quotationSource">*Conteúdo da consultoria Safras & Mercado</h4>

			<div class="quotation-bar">Mercado Futuro</div>
			<div class="quotation-box1">
				<div class="quotation-content">
					<div class="filters">
						<input type="hidden" class="functionsUrl" value="<?php echo get_template_directory_uri()?>/extensions/ajax/functionsLoad.php">
						<select class="commodities" title="Selecione o produto"></select>
						<label></label>
					</div>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/spinner.gif" class="spinner">
					<table class="tb-quotation"></table>

					<div class="quotation-bar-into">
						<label>Histórico de preços</label>
						<select title="selecione o período" class="period">
							<option value="1">Últimos dias</option>
						</select>
						<label class="monthsRefer"></label>
					</div>
					<div id="linechart_material"></div>
				</div>
			</div>
			<div class="quotation-bar">Mercado Físico</div>
			<div class="quotation-box2">
				<div class="quotation-content">
					<div class="filters">
						<select class="fisicCommodities" title="Selecione o produto"></select>
					</div>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/spinner.gif" class="spinner">
					<table class="tb-quotationFisic"></table>
				</div>
			</div>
			<div class="quotation-bar">Dólar comercial</div>
			<div class="quotation-box3">
				<div class="quotation-content">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/spinner.gif" class="spinner">
					<table class="tb-quotationDolar"></table>
					<span class="dolarHour"></span>
				</div>
			</div>
		</div>
		<?php getFooterBanner(); ?>
	</div>
</div>
<?php get_footer(); ?>