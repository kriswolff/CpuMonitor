<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <title>CPU @<?php echo $_SERVER['HTTP_HOST']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="kris">

        <script src="jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="raphael-min.js" type="text/javascript" charset="utf-8"></script>
        <script src="g.raphael-min.js" type="text/javascript" charset="utf-8"></script>
        <script src="g.bar-min.js" type="text/javascript" charset="utf-8"></script>
        <script src="g.line-min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
        var r;
		function lastHour(){
            		var x = []; 
            		var y = [];
            		var y = $.getJSON("./data.php?hour=1", function(data){
                		y = data["y"];
            		})
                	.success(function() {  })
                	.error(function() { alert("error"); })
                	.complete(function() {
                    		for (var i = 0; i < y[0].length; i++) {
                        		x[i] = i ;
                    		}
				setCpus(y.length);
                if(y.length > 1 && y[0].length > 1){
				headline(1, 'Last hour');
                    		draw(1,x,y);
                            } else {
                            headline(1, 'Last hour - collecting data');
                            }
                	});
		};
		function lastDay(){
            		var x = []; 
            		var y = [];
            		var y = $.getJSON("./data.php?hour=24", function(data){
                		y = data["y"];
            		})
                	.success(function() {  })
                	.error(function() { alert("error"); })
                	.complete(function() {
                    		for (var i = 0; i < y[0].length; i++) {
                        		x[i] = i ;
                    		}
                            if(y[0].length > 1 && y[0].length > 1){
				headline(2, 'Last 24 hours');
                    		draw(2,x,y);
                            } else {
                            headline(2, 'Last 24 hours - collecting data');
                            }
                	});
		};
		var setCpus = function(count){
			$('#cpucount').html(""+ count);
		}
		var headline = function(i, text){
			r.g.text(25 +(10*i), (i*200)-200 +(10 *i), text);
		}
            	var draw = function(i, x, y){
			if(i == 1){
                	d = r.g.linechart(10, (i*200)-200 +(15 *i), 600, 200, x, y, {shade: true, axis: "0 0 0 1", symbol: "", smooth: false});
			} else {
			d = r.g.linechart(10, (i*200)-200 +(15 *i), 600, 200, x, y, {shade: true, axis: "0 0 0 1", symbol: "", smooth: true});
			}
            	};
                
            window.onload = function () {

                r = Raphael("holder");
		r.g.txtattr.font = "12px 'Fontin Sans', Fontin-Sans, sans-serif";
                    lastHour(); 
            lastDay(); 
            window.setInterval("refresh()", 6000 * 10);

            };
        var refresh = function(){
            r.clear();
            lastHour(); 
            lastDay(); 
        };
        </script>
    </head>
    <style>
#holder {
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    -webkit-box-shadow: 0 1px 3px #666;
    background: #ddd url(./bg.png);
    margin: 0 auto;
    width: 640px;
    height: 430px;
}
    </style>
    <body class="raphael" id="com.sinnerschrader.intern.cpuload">
	<div id="holder"></div>
        <p>
            CpuMonitor@<?php echo $_SERVER['HTTP_HOST']; ?> (<span id="cpucount"></span> cpus)
        </p>
    </body>
</html>
