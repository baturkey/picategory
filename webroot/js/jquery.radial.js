if(typeof jQuery === 'undefined')
{
	throw new Error('Buttonguard requires jQuery');
}

+function($)
{
	$.fn.radial = function(options)
	{
		var settings = $.extend({
			outerRadius: 150,
			innerRadius: 20
		}, options);
		var subDiv     = document.createElement('div');
		var radialLink = document.createElement('a');

		this.addClass('radial');
		$(subDiv).addClass('radial-center').appendTo(this);

		for(var i = 0, l = settings.children.length; i < l; i++)
		{
			var a = document.createElement('a');
			var radialStyle = document.createElement('style');

			radialStyle.innerHTML += "#radial-sub" + i + ".open {" +
				"left:" + (settings.outerRadius * Math.cos(2*Math.PI * i/l - Math.PI/2) - settings.innerRadius).toFixed() + "px;" +
				"top: " + (settings.outerRadius * Math.sin(2*Math.PI * i/l - Math.PI/2) - settings.innerRadius).toFixed() + "px;" +
				"}";
			$(subDiv).append(radialStyle);
			$(a).appendTo(subDiv).attr({'href':'', 'id':'radial-sub' + i}).html(settings.children[i]).click(function(e) {
				e.preventDefault();
				$('.radial-link').html($(this).html());
				$('.radial-center a').toggleClass('open');
				return false;
			});
		}

		$(radialLink).addClass('radial-link').attr({'href':''}).appendTo(this).click(function(e) {
			e.preventDefault();
			$('.radial-center a').toggleClass('open');
			return false;
		});

		return this;
	}
}(jQuery);
