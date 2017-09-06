(function($){

	$(document).ready(function(){

		$('.nav__primary>ul>li>a').each(function(){
	        var $this = $(this),
	            txt = $this.text();
		        $this.html('<div><span>'+ txt +'</span></div><div><span>'+ txt +'</span></div>');
		});

		$('.banner-btn').find('a').addClass('btn-primary');

		$('.btn-primary').each(function(){
	        var $this = $(this),
	            txt = $this.text();
		        $this.html('<span>'+ txt +'</span>');
		});

		
		
		$('.ext_poz0').find('.footer_m .footer-nav').each(function(){
			$(this).parent().parent().find('.title_nav').css("display", "block");	
		});
	    


	});


 
})(jQuery);
