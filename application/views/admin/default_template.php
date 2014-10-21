<!-- DOWNLOADED FROM WWW.SCRIPTGATES.COM -->
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>EPURSE ADMIN</title>
<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/style.default.css" type="text/css" />

<link rel="stylesheet" href="<?php echo base_url();?>public_html/css/responsive-tables.css" />
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/responsive-tables.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public_html/js/custom.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo $_title; ?>
        <?php echo $_meta; ?>
        <?php echo $_styles; ?>
        <?php echo $_scripts; ?>
        
</head>

<body>

<div class="mainwrapper">
    <?php echo $header; ?>
    <?php echo $leftpanel; ?>
    <div class="rightpanel">
        <?php echo $breadcrumbs; ?>
        <div class="pageheader">
            <form action="results.html" method="post" class="searchbar" />
                <input type="text" name="keyword" placeholder="To search type and hit enter..." />
            </form>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5><?php echo $desption;?></h5>
                <h1><?php echo $title; ?></h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
         <?php echo $content; ?>   
            <?php //var_dump($data); ?>
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
    
</div><!--mainwrapper-->
<script type="text/javascript">
    jQuery(document).ready(function() {
        
      // simple chart
		var flash = [[0, 11], [1, 9], [2,12], [3, 8], [4, 7], [5, 3], [6, 1]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
      var css3 = [[0, 6], [1, 1], [2,9], [3, 12], [4, 10], [5, 12], [6, 11]];
			
		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
	
			
		var plot = jQuery.plot(jQuery("#chartplace"),
			   [ { data: flash, label: "Flash(x)", color: "#6fad04"},
              { data: html5, label: "HTML5(x)", color: "#06c"},
              { data: css3, label: "CSS3", color: "#666"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#666', borderWidth: 2, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });
		
		var previousPoint = null;
		jQuery("#chartplace").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
						
					showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#chartplace").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});
    
        
        //datepicker
        jQuery('#datepicker').datepicker();
        
        // tabbed widget
        jQuery('.tabbedwidget').tabs();
        
        
    
    });
</script>
</body>
</html>
