jQuery(document).ready(function() {
 	var $ = jQuery;
    var screenRes = $(window).width();
// Remove links outline in IE 7
	$("a").attr("hideFocus", "true").css("outline", "none");

// cols
	$(".row .col:first-child").addClass("alpha");
	$(".row .col:last-child").addClass("omega"); 

	$(".partnerships li:last-child").addClass("omega");

//widget text last <p> no-margin

$(".sidebar .textwidget p:last-child").addClass("last");

//dropdown parent
    $(".dropdown ul ul").parent("li").addClass("parent");


// style Select, Radio, Checkbox
  if ($("select").hasClass("select_styled")) {
    cuSel({changedEl: ".select_styled", visRows: 10});
  }
  if ($("div,p").hasClass("input_styled")) {
    $(".input_styled input").customInput();
  }

// tabs   
  if ($("ul").hasClass("tabs")) {   
    $("ul.tabs").tabs("> .tabcontent", {tabs: 'li', effect: 'fade'}); 
  }
  if ($("ul").is(".tabs.linked")) {   
    $("ul.tabs").tabs("> .tabcontent");
  }

// Pricing cols		 
	$(".pricing_box .price_col:first-child").addClass("first");
	$(".pricing_box .price_col:last-child").addClass("last");

//Filter menu
	$(".filter_menu li:first-child").addClass("first");
	$(".filter_menu li:last-child").addClass("last"); 

//image align middle

    if (screenRes > 480){$(".img-to-center").each(function(){
        $(this).css("line-height", $(this).height()+'px');
    });}



    //col2 service-item odd/even add class alpha/omega
    $(".cols2 .service_list .service_item:even").addClass("alpha");
    $(".cols2 .service_list .service_item:odd").addClass("omega");
    if (screenRes > 750){ // last 3 service-item no-margin
        var service_cols = 3;

        if(jQuery('#middle').hasClass('cols2'))  service_cols = 2;

        if(jQuery('.service_list .service_item').length> service_cols)
        {
            var last_count = (jQuery('.service_list .service_item').length % service_cols);
            if(!last_count) last_count = service_cols;
            jQuery('.service_list .service_item').slice(-last_count).css('margin-bottom', '0');
        }}




// toggle content
  $(".toggle_content").hide();  
  $(".toggle").toggle(function(){
    $(this).addClass("active");
    }, function () {
    $(this).removeClass("active");
  });
  
  $(".toggle").click(function(){
    $(this).next(".toggle_content").slideToggle(300,'easeInQuad');
  });


// pricing

	$(".price_col_body ul").each(function () {
		$(this).find("li").removeClass("even").filter(":even").addClass("even");
	});
	
	if (screenRes > 750) {
		if ((".pricing_box .price_col").length > 1){

		jQuery(".pricing_box").each(function(){
			var $this = $(this);
			var box_width = $this.width() - 25;
            jQuery(".price_col",$this).css("width", (box_width / jQuery(".price_col", $this).length) + "px" );
            jQuery(".col_active",$this).css("width", jQuery(".price_col",$this).width() + 25 + "px")
		});

        jQuery(".price_style2").each(function(){
            var $this = $(this);
            var box_width = $this.width()- 50;
            console.log(box_width);
            jQuery(".price_col",$this).css("width", (box_width / jQuery(".price_col", $this).length) + "px" );
            jQuery(".col_active",$this).css("width", jQuery(".price_col",$this).width() + 50 + "px")
        });
	}} 


// prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
	if($('a').is('[data-rel]') && screenRes > 600) {
        $('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});
		$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});	
    }

// odd/even
	$("ul.recent_posts > li:odd, ul.popular_posts > li:odd, .styled_table table>tbody>tr:odd, .boxed_list > .boxed_item:odd, .grid_layout .post-item:odd").addClass("odd");
	$(".widget_recent_comments ul > li:even, .widget_recent_entries li:even, .widget_twitter .tweet_item:even, .widget_archive ul > li:even, .widget_categories ul > li:even, .widget_nav_menu ul > li:even, .widget_links ul > li:even, .widget_meta ul > li:even, .widget_pages ul > li:even").addClass("even");

// Smooth Scroling of ID anchors	
  function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
  }
  var locationPath = filterPath(location.pathname);
  var scrollElem = scrollableElement('html', 'body');
 
  $('a[href*=#].anchor').each(function() {
    $(this).click(function(event) {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $(this.hash), target = this.hash;
      if (target && $target.length != 0) {
        var targetOffset = $target.offset().top;
          event.preventDefault();
          $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
            location.hash = target;
          });
      }
    }
   });	
  });

  // use the first element that is "scrollable"
  function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
      var el = arguments[i],
          $scrollElement = $(el);
      if ($scrollElement.scrollTop()> 0) {
        return el;
      } else {
        $scrollElement.scrollTop(1);
        var isScrollable = $scrollElement.scrollTop()> 0;
        $scrollElement.scrollTop(0);
        if (isScrollable) {
          return el;
        }
      }
    }
    return [];
  }

//partenerships 
$('.partnerships li:nth-child(5n + 5)').css("margin-right", " 0");
// centering dropdown submenu
    $(".dropdown > li").hover(function(){
        var dropDown = $(this).children("ul");
        var dropDownLi = $(this).children().children("li").width();
        var posLeft = ((dropDownLi - $(this).width())/2);

    });

    $(".dropdown li:first-child, .pricing_box li:first-child, .sidebar .widget-container:first-child").addClass("first");
    $(".dropdown li:last-child, .pricing_box li:last-child, .widget_twitter .tweet_item:last-child, .sidebar .widget-container:last").addClass("last");
    $(".dropdown li:only-child").removeClass("last").addClass("only");
    $(".sidebar .current-menu-item, .sidebar .current-menu-ancestor").prev().addClass("current-prev");


// dropdown menu
    function mega_show(){
        $('.dropdown li, .dropdown li ul li').hoverIntent({
            sensitivity: 5,
            interval: 100,
            over: subm_show,
            timeout: 50,
            out: subm_hide
        });
    }
    function subm_show(){
        $(this).children("ul").slideDown(100);
    }
    function subm_hide(){
        $(this).children("ul").slideUp(90);
    }


    // Topmenu <ul> replace to <select>
    function responsive(mainNavigation) {
        var $ = jQuery;
        var screenRes = $('.body_wrap').width();

        if (screenRes < 768) {
            //jQuery('ul.dropdown').css('display', 'none');
            /* Replace unordered list with a "select" element to be populated with options, and create a variable to select our new empty option menu */
            $('#topmenu').html('<select class="select_styled" id="topm-select"></select>');
            var selectMenu = $('#topm-select');

            /* Navigate our nav clone for information needed to populate options */
            $(mainNavigation).children('ul').children('li').each(function() {

                /* Get top-level link and text */
                var href = $(this).children('a').attr('href');
                var text = $(this).children('a').text();

                /* Append this option to our "select" */
                if ($(this).is(".current-menu-item") && href != '#') {
                    $(selectMenu).append('<option value="' + href + '" selected>' + text + '</option>');
                } else if (href == '#') {
                    $(selectMenu).append('<option value="' + href + '" disabled="disabled">' + text + '</option>');
                } else {
                    $(selectMenu).append('<option value="' + href + '">' + text + '</option>');
                }

                /* Check for "children" and navigate for more options if they exist */
                if ($(this).children('ul').length > 0) {
                    $(this).children('ul').children('li').not(".mega-nav-widget").each(function() {

                        /* Get child-level link and text */
                        var href2 = $(this).children('a').attr('href');
                        var text2 = $(this).children('a').text();

                        /* Append this option to our "select" */
                        if ($(this).is(".current-menu-item") && href2 != '#') {
                            $(selectMenu).append('<option value="' + href2 + '" selected> - ' + text2 + '</option>');
                        } else if (href2 == '#') {
                            $(selectMenu).append('<option value="' + href2 + '" disabled="disabled"># ' + text2 + '</option>');
                        } else {
                            $(selectMenu).append('<option value="' + href2 + '"> - ' + text2 + '</option>');
                        }

                        /* Check for "children" and navigate for more options if they exist */
                        if ($(this).children('ul').length > 0) {
                            $(this).children('ul').children('li').each(function() {

                                /* Get child-level link and text */
                                var href3 = $(this).children('a').attr('href');
                                var text3 = $(this).children('a').text();

                                /* Append this option to our "select" */
                                if ($(this).is(".current-menu-item")) {
                                    $(selectMenu).append('<option value="' + href3 + '" class="select-current" selected>' + text3 + '</option>');
                                } else {
                                    $(selectMenu).append('<option value="' + href3 + '"> -- ' + text3 + '</option>');
                                }

                            });
                        }
                    });
                }
            });
        } else {
            jQuery('#topm-select').css('display', 'none');
            jQuery('#menu-menu').css('display', 'inline-block');
        }

        /* When our select menu is changed, change the window location to match the value of the selected option. */
        $(selectMenu).change(function() {
            location = this.options[this.selectedIndex].value;
        });
    }

// reload topmenu on Resize
    var mainNavigation = $('#topmenu').clone();
    responsive(mainNavigation);

    $(window).resize(function() {
        var screenRes = $('.body_wrap').width();
        responsive(mainNavigation);
    });

    // responsive megamenu
    var screenRes = $(window).width();


});





