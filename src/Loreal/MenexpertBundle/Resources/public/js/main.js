
;(function($){
	$(function(){
	
		$(".green").on("click",function(){
			$(".tips").fadeIn();
			console.log(1);
		});
		$(".close").on("click",function(){
			console.log(0);
			$(".tips").fadeOut();

		});


	})
})(jQuery);







