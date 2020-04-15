<hr>
                
                
                
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div id="footer" class="span12"> 2020 &copy; Universal Tag Manager Portal </div>
</div>
<script src="<?php echo base_url(); ?>resources/js/excanvas.min.js"></script> 
<script src="<?php echo base_url(); ?>resources/js/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>resources/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>resources/js/jquery.flot.min.js"></script> 
<script src="<?php echo base_url(); ?>resources/js/jquery.flot.resize.min.js"></script> 
<script src="<?php echo base_url(); ?>resources/js/jquery.peity.min.js"></script> 
<script src="<?php echo base_url(); ?>resources/js/maruti.js"></script> 
<script>

$(document).ready(function(){
	var sin = [], cos = [], sites = [];
        var dataload = [ { data: sin, label: "sin(x)", color: "#ee7951"}, { data: cos, label: "cos(x)",color: "#4fb9f0" } ];
        var max = 20;
        $('.loadingGraph').show();
        $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Ajaxdata/loadData',
                data: {"site": 1,"id":2}, // set the "id" key
                dataType: 'json',
                success: function(cdata) {
                    // $('#search_data_load').html(sdata);val(cdata.msg);
                    //console.log(cdata);
                    var returnedData = cdata.data;
                    //console.log(returnedData);
                    max = cdata.max;
//                    for (var i = 0; i < 14; i += 0.5) {
//                            sin.push([i, Math.sin(i)]);
//                            cos.push([i, Math.cos(i)]);
//                        }
                    //sites.push([returnedData]);
                    $.each( returnedData, function( index, value ){
                        //alert(returnarray(value.data));
                        var obj = {
                            'data':returnarray(value.data),
                            'label':value.label,
                            'color':"#"+value.color
                        };
                        sites.push(obj);
                    });
                    //console.log(sites);
                    $('.loadingGraph').hide();
                    loadcharts(sites,max);
                }
            });
	
	// === Prepare peity charts === //
	maruti.peity();
	
	// === Prepare the chart data ===/
	
//    for (var i = 0; i < 14; i += 0.5) {
//        sin.push([i, Math.sin(i)]);
//        cos.push([i, Math.cos(i)]);
//    }
//
//	// === Make chart === //
//    loadcharts(sin,cos,site1);
    
    
});


function returnarray(sitedata){
    var sites = [];
    $.each( sitedata, function( index, value ){
        sites.push([index,value]);
    });
    return sites;
}


maruti = {
		// === Peity charts === //
		peity: function(){		
			$.fn.peity.defaults.line = {
				strokeWidth: 1,
				delimeter: ",",
				height: 24,
				max: null,
				min: 0,
				width: 50
			};
			$.fn.peity.defaults.bar = {
				delimeter: ",",
				height: 24,
				max: null,
				min: 0,
				width: 50
			};
			$(".peity_line_good span").peity("line", {
				colour: "#57a532",
				strokeColour: "#459D1C"
			});
			$(".peity_line_bad span").peity("line", {
				colour: "#FFC4C7",
				strokeColour: "#BA1E20"
			});	
			$(".peity_line_neutral span").peity("line", {
				colour: "#CCCCCC",
				strokeColour: "#757575"
			});
			$(".peity_bar_good span").peity("bar", {
				colour: "#459D1C"
			});
			$(".peity_bar_bad span").peity("bar", {
				colour: "#BA1E20"
			});	
			$(".peity_bar_neutral span").peity("bar", {
				colour: "#4fb9f0"
			});
		},

		// === Tooltip for flot charts === //
		flot_tooltip: function(x, y, contents) {
			
			$('<div id="tooltip">' + contents + '</div>').css( {
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
}

function loadcharts(dataload,max){
    var plot = $.plot($(".chart"),
           dataload , {
               series: {
                   lines: { show: true },
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true },
               yaxis: { min: 0, max: max }
		   });
    
	// === Point hover in chart === //
    var previousPoint = null;
    $(".chart").bind("plothover", function (event, pos, item) {
		
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                
                $('#tooltip').fadeOut(200,function(){
					$(this).remove();
				});
                var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
                    
                maruti.flot_tooltip(item.pageX, item.pageY,item.series.label + " of " + x + " = " + y);
            }
            
        } else {
			$('#tooltip').fadeOut(200,function(){
					$(this).remove();
				});
            previousPoint = null;           
        }   
    });
}

</script> 



</body>
</html>