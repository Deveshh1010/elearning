// JavaScript Document
jQuery.fn.caleDay = function(hour, minute, day, month, year){ 
	$.ajax({ url: 'calendar/ajax_calendar.php',
		type: 'POST', dataType: 'json',
		data: ({ get: 'day', cale_hour: hour, cale_minute: minute, cale_day: day, cale_month: month, cale_year: year }),
		error: function (data){
			$('#month_today').html('Error');
		},
		success: function (data){
			$('#month_today').html(data.list);
			$('#isMonthName').val(data.mName);
			$('#yearSelected').val(data.date);
			$('#timestamp').val(data.stamp);
			$('#signup_year').val(data.date);
			$('#timestamp_signup').val(data.stamp);
			if($('#jTime').val()>0) {
				$('#timestamp_end').val((parseFloat($('#jTime').val())*60)+parseFloat($('#timestamp_signup').val()));
			} else {
				$('#timestamp_end').val(parseFloat($('#timestamp_signup').val()));
			}			
		},
	});
}
jQuery.fn.caleMonth = function(hour, minute, day, month, year){ 
	$.ajax({ url: 'calendar/ajax_calendar.php',
		type: 'POST', dataType: 'json',
		data: ({ get: 'month', cale_hour: hour, cale_minute: minute, cale_day: day, cale_month: month, cale_year: year }),
		error: function (data){2
			$('#month_today').html('Error');
		},
		success: function (data){
			$('#month_today').html(data.list);
			$('#isMonthName').val(data.mName);
			$('#yearSelected').val(data.date);
			$('#timestamp').val(data.stamp);
			$('#signup_year').val(data.date);
			$('#timestamp_signup').val(data.stamp);
			if($('#jTime').val()>0) {
				$('#timestamp_end').val((parseFloat($('#jTime').val())*60)+parseFloat($('#timestamp_signup').val()));
			} else {
				$('#timestamp_end').val(parseFloat($('#timestamp_signup').val()));
			}			
		},
	});
} 
jQuery.fn.monthSelect = function(hour, minute, day, month, year){ 	
	$('#mChange').val(0);
	$('#month_today').animate({
		opacity: 0,
		top: '-=20',
	},200,function() {
		$('#month_today').caleDay(hour, minute, day, month, year);
		$('#isMonthName').removeAttr('disabled','disabled');
		// Show Animate
		$('#month_today').animate({
			opacity: 0,
			top: '+=40',
		},0,function() {
			$('#month_today').animate({
				opacity: 1,
				top: '-=20',
			},200,function() {

			});
		});
	});
} 