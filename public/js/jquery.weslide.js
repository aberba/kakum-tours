

(function($) { 

    $.fn.weSlide = function(customOptions) {
    	var options = $.extend({}, $.fn.weSlide.defaultOptions, customOptions);

        var slider = $(this);
        
        //create textbox for each slider image alt text
        var textP   = $("<p />");
        var textDiv = $("<div />", {"class":"text-div"}).css({
            position: "absolute",
            top: "40px",
            left: "40px",
            padding: "10px",
            color: options.textColor,
            width: options.textBoxWidth,
            height: options.textBoxHeight,
            backgroundColor: options.textBoxBG,
            zIndex: 4
        }).append(textP);

        slider.append(textDiv);
        slider.children("img").addClass("slide");

        slider.children("img").css({
            position: "absolute",
            top: 0,
            left: 0,
            width: options.slideWidth + "px",
            height: options.slideHeight + "px",
            zIndex: 0
        });

        slider.children("img.current").css({
            zIndex: 2
        });
       
        slider.children("img.previous").css({
            zIndex: 1
        });



        //Sliding functions
        slider.children("img:first").addClass("current");

        function _next() {
            var current = slider.children("img.current");
            var next    = current.next();

            if (!next.is("img.slide")) {
                next = slider.children("img:first");
            }

            current.css({ left: options.slideWidth + "px" }); 
            next.addClass("current");
            current.removeClass("current").addClass("previous");
            next.animate({ left: 0}, "linear", 2000, function() {
                current.removeClass("previous");
            });
        }

        slider.on("click", function() {
            _next();
        });
    };

    $.fn.weSlide.defaultOptions = 
    {
      slideWidth: 600,
      slideHeight: 350,
      slideInterval: 3000,
      textColor: "#000000",
      textBoxBG: "#ffffff",
      textBoxWidth: 300,
      textBoxHeight: 80,
    };

}(jQuery));