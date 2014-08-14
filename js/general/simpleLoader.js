var loadme;
$(window).on("load", function(){

	// Check Location
	if ( document.location.protocol === 'file:' ) {
		alert('The HTML5 History API (and thus History.js) do not work on files, please upload it to a server.');
	}

	// Establish Variables
	var
		State = History.getState(),
		$log = $('#log');

	// Log Initial State
	History.log('initial:', State.data, State.title, State.url);

	// Bind to State Change
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		// Log the State
		var State = History.getState(); // Note: We are using History.getState() instead of event.state
		History.log('statechange:', State.data, State.title, State.url);
	});

	loadme = function (qpage,qtitle,qfolder){
		var elpago = qpage.split('/');
		//elpago = elpago.substring(0, elpago.length - 4)
		//elpago.replace(re, "");
		$( "#content" ).load( qpage, function() {
			alert('elpago: '+elpago[elpago.length - 1]);
			//history.replaceState('', qtitle, qfolder+'/'+elpago[elpago.length - 1]);
			History.replaceState({state:1}, qtitle, elpago[elpago.length - 1]);
		});
	}
});