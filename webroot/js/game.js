$(function()
{
	/* Fetch words */
	$('#CategoryInput').autocomplete({
		source: "/words/autocomplete",
		minLength: 2
	});

	/* Scroll messages to bottom */
	var messages = document.getElementById("MessageList");
	messages.scrollTop = messages.scrollHeight;

	/* Image Size slider */
	var sliderUpdate = function(e)
	{
		var newSize = e.value * 100;
		$(".image").css("width", newSize + "px").css("height", newSize + "px");
		$(".identifier").css("font-size", e.value + "em");
		if(e.value == 2)
		{
			$("#Game").removeClass('col-lg-6').addClass('col-lg-9').removeClass('col-lg-12');
			$("#Log" ).show();
			$("#Chat").hide();
		}
		else if(e.value == 3)
		{
			$("#Game").removeClass('col-lg-6').removeClass('col-lg-9').addClass('col-lg-12');
			$("#Log" ).hide();
			$("#Chat").hide();
		}
		else
		{
			$("#Game").addClass('col-lg-6').removeClass('col-lg-9').removeClass('col-lg-12');
			$("#Log" ).show();
			$("#Chat").show();
		}
	}

	$("#GameSlider").bootstrapSlider({
		value:   1,
		ticks:   [1, 2, 3],
		tooltip: 'hide',
	}).on('slide', sliderUpdate).on('slideStop', sliderUpdate);

	$("#RadialMenu").radial({'children'   : [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
							 'outerRadius': 60,
							 'innerRadius': 15
							});
});

function log(cell, limit)
{
	var selected = JSON.parse($("#GameSelected").val());

	if($(cell).hasClass('selected'))
	{
		$(cell).removeClass('selected');
	}
	else
	{
		if(selected.length < limit)
		{
			$(cell).addClass('selected');
		}
	}

	var ids = [];
	$('.selected').each(function(i, j) {
		ids.push(parseInt(j.id.substring(4, 6)));
	});
	$("#GameSelected").val(JSON.stringify(ids));
}
