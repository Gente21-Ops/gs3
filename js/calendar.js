$(function() {

	$('#calendar').fullCalendar({
		/*header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},*/
		//editable: true,
		events: '/gs3b/clases/general/events_calendar.php'


		/*events: {
	        url: 'http://187.177.180.127:81/gs3b/clases/general/events_calendar.php',
	        type: 'POST',
	        error: function() {
	            alert('there was an error while fetching events!');
	        },
    	}*/
		
	});




});