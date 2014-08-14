$(function () {
    var previousPoint;
 

    //Display horizontal graph
    var d1_h = [];
    //for (var i = 0; i <= 4; i += 1)
        d1_h.push([2,1]);
        d1_h.push([4,2]);
        d1_h.push([6,3]);
        d1_h.push([8,4]);
        d1_h.push([10,5]);

    var d2_h = [];
    //for (var i = 0; i <= 4; i += 1)
        d2_h.push([1,1]);
        d2_h.push([2,2]);
        d2_h.push([3,3]);
        d2_h.push([4,4]);
        d2_h.push([5,5]);

    var d3_h = [];
    //for (var i = 0; i <= 4; i += 1)
        d3_h.push([10,1]);
        d3_h.push([8,2]);
        d3_h.push([6,3]);
        d3_h.push([4,4]);
        d3_h.push([2,5]);

    var d4_h = [];
    //for (var i = 0; i <= 4; i += 1)
        d4_h.push([6,1]);
        d4_h.push([7,2]);
        d4_h.push([8,3]);
        d4_h.push([9,4]);
        d4_h.push([10,5]);

    /*
    var d2_h = [];
    for (var i = 0; i <= 4; i += 1)
        d2_h.push([parseInt(Math.random() * 30),i ]);

    var d3_h = [];
    for (var i = 0; i <= 4; i += 1)
        d3_h.push([ parseInt(Math.random() * 30),i]);
    */          
    var ds_h = new Array();
    ds_h.push({
        data:d1_h,
        bars: {
            horizontal:true, 
            show: true, 
            barWidth: 0.2, 
            order: 0,
        }
    });

    ds_h.push({
        data:d2_h,
        bars: {
            horizontal:true, 
            show: true, 
            barWidth: 0.2, 
            order: 1,
        }
    });

    ds_h.push({
        data:d3_h,
        bars: {
            horizontal:true, 
            show: true, 
            barWidth: 0.2, 
            order: 2,
        }
    });

    ds_h.push({
        data:d4_h,
        bars: {
            horizontal:true, 
            show: true, 
            barWidth: 0.2, 
            order: 3,
        }
    });
/*ds_h.push({
    data:d2_h,
    bars: {
        horizontal:true, 
        show: true, 
        barWidth: 0.2, 
        order: 2
    }
});
ds_h.push({
    data:d3_h,
    bars: {
        horizontal:true, 
        show: true, 
        barWidth: 0.2, 
        order: 3
    }
});
*/
    //tooltip function
    function showTooltip(x, y, contents, areAbsoluteXY) {
        var rootElt = 'body';
	
        $('<div id="tooltip3" class="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y - 35,
            left: x - 5,
			'z-index': '9999',
			'color': '#fff',
			'font-size': '11px',
            opacity: 0.8
        }).prependTo(rootElt).show();
    }

/*$.plot($("#placeholder1_hS"), ds_h, {
    grid:{
        hoverable:true
    }
});*/

$.plot($("#placeholder"), [ [[0, 0], [1, 1]] ], { yaxis: { max: 1 } });

//add tooltip event
$("#placeholder1_h").bind("plothover", function (event, pos, item) {
    if (item) {
        if (previousPoint != item.datapoint) {
            previousPoint = item.datapoint;
 
            //delete de prГ©cГ©dente tooltip
            $('.tooltip').remove();
 
            var x = item.datapoint[0];
 
            //All the bars concerning a same x value must display a tooltip with this value and not the shifted value
            if(item.series.bars.order){
                for(var i=0; i < item.series.data.length; i++){
                    if(item.series.data[i][3] == item.datapoint[0])
                        x = item.series.data[i][0];
                }
            }
 
            var y = item.datapoint[1];
 
            showTooltip(item.pageX+5, item.pageY+5,x + " = " + y);
 
        }
    }
    else {
        $('.tooltip').remove();
        previousPoint = null;
    }
 
});

 
});