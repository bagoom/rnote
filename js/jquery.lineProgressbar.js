/**
 * jQuery Line Progressbar
 * Author: KingRayhan<rayhan095@gmail.com>
 * Author URL: http://rayhan.info
 * Version: 1.0.0
 */

(function($){
	'use strict';

	$.fn.LineProgressbar = function(options){

		var options = $.extend({
			percentage : null,
			ShowProgressCount: true,
			duration: 1000,

			// Styling Options
			fillBackgroundColor: '#db5b99',
			backgroundColor: '#fbecf7',
			radius: '0px',
			height: '10px',
			width: '100%'
		},options);

		return this.each(function(index, el) {
			// Markup
			$(el).html('<div class="progressbar"><div class="proggress"></div><div class="percentCount"></div></div>');



			var progressFill = $(el).find('.proggress');
			var progressBar= $(el).find('.progressbar');


			progressFill.css({
				width : options.width,
				backgroundColor : options.fillBackgroundColor,
				height : options.height,
				borderRadius: options.radius
			});
			progressBar.css({
				width : options.width,
				backgroundColor : options.backgroundColor,
				borderRadius: options.radius
			});

			// Progressing
			progressFill.animate(
				{
					width: options.percentage + "px"
				},
				{
					step: function(x) {
						if(options.ShowProgressCount){
							$(el).find(".percentCount").text(Math.round(x) + "px");
						}
					},
					duration: options.duration
				}
			);
		////////////////////////////////////////////////////////////////////
		});
	}
})(jQuery);
