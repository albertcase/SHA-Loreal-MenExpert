
;(function($){
	$(function(){

		$(".main .tips").fadeIn(1000);
		$(".main_tips").fadeIn(1000);
	
		$(".circle_ani_green").on("click",function(){
			$(".tips").fadeIn();
			$(".green_tips").fadeIn();
			
		});
		$(".circle_ani_red").on("click",function(){
			$(".tips").fadeIn();
			$(".red_tips").fadeIn();
			
		});
		$(".circle_ani_purple").on("click",function(){
			$(".tips").fadeIn();
			$(".purple_tips").fadeIn();
			
		});
		$(".circle_ani_orange").on("click",function(){
			$(".tips").fadeIn();
			$(".orange_tips").fadeIn();
			
		});
		$(".circle_ani_blue").on("click",function(){
			$(".tips").fadeIn();
			$(".blue_tips").fadeIn();
			
		});
		$(".close").on("click",function(){
			
			$(".tips").fadeOut();
			$(".tips_content").fadeOut();

		});


	})
})(jQuery);







