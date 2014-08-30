
console.log('STUDENTS_FALTAS LOADED 934');

//localization (solo cuando hay calendario de UI)
var qlen = '';
if ($('#qlango').text() == 'es'){
	qlen = "js/datatablesloc/dataTables.spanish.txt";
} else if ($('#qlango').text() == 'en'){
	qlen = "js/datatablesloc/dataTables.english.txt";
} else if ($('#qlango').text() == 'fr'){
	qlen = "js/datatablesloc/dataTables.francais.txt";
}

$.ajax({
    // usually, we'll just call the same URL, a script
    // connected to a database, but in this case we only
    // have static example files so we need to modify the
    // URL
    url: "clases/student/students_faltas.php",
    method: 'GET',
    dataType: 'json',
    success: onOutboundReceived
});



function onOutboundReceived(datos) {
        var finalData = datos;
        $.plot("#placeholder", [ finalData ], {
			series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
					align: "center"
                }
            },
            xaxis: {
            	mode: "categories",
            	tickLength: 0,
                axisLabel: "Materias",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
            },
            yaxis: {
                axisLabel: "Número de faltas",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                tickFormatter: function (v, axis) {
                    return v;
                }
            },
            legend: {
                noColumns: 0,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
		});
		//$("#placeholder").UseTooltip();
    }

/*
         var options = {
            series: {
                bars: {
                    show: true
                }
            },
            bars: {
                align: "center",
                barWidth: 0.5
            },
            xaxis: {
                axisLabel: "Materias",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                ticks: ticks
            },
            yaxis: {
                axisLabel: "Número de faltas",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                tickFormatter: function (v, axis) {
                    return v;
                }
            },
            legend: {
                noColumns: 0,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
        };
        $.plot("#placeholder", data, options);
        //$.plot($("#placeholder"), dataset, options); 
		$("#placeholder").UseTooltip();


        function fetchData() {

        	$.ajax({
                url: "clases/student/students_faltas.php",
                type: "GET",
                dataType: "json",
                success: onDataReceived
            });

            function onDataReceived(series) {

                data = [series];

                $.plot("#placeholder", data, options);
            }

            
            if (iteration < 5) {
                setTimeout(fetchData, 10000);
            } else {
                data = [];
                alreadyFetched = {};
            }
            
        }
        fetchData();
        //setTimeout(fetchData, 10000);
*/
