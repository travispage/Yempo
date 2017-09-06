<?php /* Wrapper Name: Footer */ ?>
<div class="row">
	<div class="span12 footer-widgets">
		<div class="row">
			<div class="span3 ext_poz0">
				<h4 class="title_nav"><?php echo of_get_option('title_footer'); ?></h4>
				<div class="footer_m" data-motopress-type="static" data-motopress-static-file="static/static-footer-nav.php">
					<?php get_template_part("static/static-footer-nav"); ?>
				</div>
			</div>
			<div class="span3 ext_poz1">
				<div data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="footer-sidebar-1">
					<?php dynamic_sidebar("footer-sidebar-1"); ?>
				</div>
			</div>
			<div class="span3 ext_poz2">
				<div data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="footer-sidebar-2">
					<?php dynamic_sidebar("footer-sidebar-2"); ?>
				</div>
			</div>
			<div class="span3 ext_poz3">
				<div data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="footer-sidebar-3">
					<?php dynamic_sidebar("footer-sidebar-3"); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12 block_01" data-motopress-type="static" data-motopress-static-file="static/static-footer-text.php">
		<?php get_template_part("static/static-footer-text"); ?>
	</div>
</div>