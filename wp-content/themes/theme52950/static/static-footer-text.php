<?php /* Static Name: Footer text */ ?>
<div id="footer-text" class="footer-text">
	<?php $myfooter_text = apply_filters( 'cherry_text_translate', of_get_option('footer_text'), 'footer_text' ); ?>
    <div class="logo pull-left">

	<?php if($myfooter_text){?>
		<?php echo $myfooter_text; ?>
	<?php } else { ?>

		<span class="comp_name"><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> </span> <span class="copyr_info">&copy; <?php echo date ('Y'); ?> <span class="sep">|</span> <a href="<?php echo home_url(); ?>/privacy-policy/" title="<?php echo theme_locals('privacy_policy'); ?>"><?php echo theme_locals("privacy_policy"); ?></a></span>

	<?php } ?> 
        
	<?php if( is_front_page() ) { ?>
		<?php 
            //More Business WordPress Templates at <a rel="nofollow" href="http://www.templatemonster.com/category/business-wordpress-templates/" target="_blank">TemplateMonster.com</a>
        ?>
	<?php } ?>
        
    </div>
</div>