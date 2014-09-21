
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
    url: "clases/student/students_grades.php",
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
                axisLabelFontSizePixels: 14,
                //axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
            },
            yaxis: {
                axisLabel: "Calificación",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 14,
                //axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
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
