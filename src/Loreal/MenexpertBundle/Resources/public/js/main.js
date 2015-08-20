
;(function($){
	$(function(){

		$(".main .tips").fadeIn(1000);
		$(".main_tips").fadeIn(1000);
		$(".map_area .tips").fadeIn(1000);
		$(".map_tips").fadeIn(1000);
	
		$(".interaction .circle_ani_green").on("click",function(){
			$(".interaction .tips").fadeIn();
			$(".interaction .green_tips").fadeIn();
			
		});
		$(".interaction .circle_ani_red").on("click",function(){
			$(".interaction .tips").fadeIn();
			$(".interaction .red_tips").fadeIn();
			
		});
		$(".interaction .circle_ani_purple").on("click",function(){
			$(".interaction .tips").fadeIn();
			$(".interaction .purple_tips").fadeIn();
			
		});
		$(".interaction .circle_ani_orange").on("click",function(){
			$(".interaction .tips").fadeIn();
			$(".interaction .orange_tips").fadeIn();
			
		});
		$(".interaction .circle_ani_blue").on("click",function(){
			$(".interaction .tips").fadeIn();
			$(".interaction .blue_tips").fadeIn();
			
		});
		$(".close").on("click",function(){
			
			$(".tips").fadeOut();
			$(".tips_content").fadeOut();

		});
		$(".photo_tips").fadeIn(3000).fadeOut(5000);
		


	})
})(jQuery);







