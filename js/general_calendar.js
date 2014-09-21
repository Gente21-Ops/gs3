//===== Calendar =====//

//console.log('CALENDAR CLASS CALLED');

var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();

$('#calendar').fullCalendar({
	header: {
		left: 'prev,next',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	},
	editable: true,
	eventSources: ['clases/general/events_calendar.php']
});