// JavaScript Document
(function($){

    $.fn.imageTick = function(options) {

        var defaults = {
            tick_image_path: "resume-bid.png",
            no_tick_image_path: "job_bid_2.png",
            image_tick_class: "ticks_" + Math.floor(Math.random()),
            hide_radios_checkboxes: false
        };
		var defaults1 = {
            tick_image_path: "job_bid.png",
            no_tick_image_path: "resume-bid_2.png",
            image_tick_class: "ticks_" + Math.floor(Math.random()),
            hide_radios_checkboxes: false
        };

        var opt = $.extend(defaults, options);
var opt1 = $.extend(defaults1, options);
        this.each(function(){

            var obj = $(this);
            var type = obj.attr('type'); // radio or checkbox

            var tick_image_path = typeof opt.tick_image_path == "object" ?
                opt.tick_image_path[this.value] || opt.tick_image_path["default"] :
                opt.tick_image_path;
               
            var no_tick_image_path = function(element_id) {
                var element = document.getElementById(element_id) || { value: "default" };
                return typeof opt.no_tick_image_path == "object" ?
                    opt.no_tick_image_path[element.value] || opt.no_tick_image_path["default"]:
                    opt.no_tick_image_path;
            }

            // hide them and store an image background
            var id = obj.attr('id');
            var imgHTML = '<img src="' + no_tick_image_path(id) + '" alt="no_tick" class="' + opt.image_tick_class + '" id="tick_img_' + id + '" />';

            obj.before(imgHTML);
            if(!opt.hide_radios_checkboxes){
                obj.css('display','none');
            }

            // if something has a checked state when the page was loaded
            if(obj.attr('checked')){
                $("#tick_img_" + id).attr('src', tick_image_path);
            }

            // if we're deadling with radio buttons
            if(type == 'radio'){

                // if we click on the image
                $("#tick_img_"+id).click(function(){
                    $("." + opt.image_tick_class).each(function() {
                        var r = this.id.split("_");
                        var radio_id = r.splice(2,r.length-2).join("_");
                        $(this).attr('src', no_tick_image_path(radio_id))
                    });
                    $("#" + id).trigger("click");
                    $(this).attr('src', tick_image_path);
                });

                // if we click on the label
                $("label[for='" + id + "']").click(function(){
                    $("." + opt.image_tick_class).each(function() {
                        var r = this.id.split("_");
                        var radio_id = r.splice(2,r.length-2).join("_");
                        $(this).attr('src', no_tick_image_path(radio_id))
                    });
                    $("#" + id).trigger("click");
                    $("#tick_img_" + id).attr('src', tick_image_path);
                });

            }

            // if we're deadling with checkboxes
            else if(type == 'checkbox'){

                $("#tick_img_" + id).click(function(){
                    $("#" + id).trigger("click");
                    if($(this).attr('src') == no_tick_image_path(id)){
                        $(this).attr('src', tick_image_path);
                    }
                    else {
                        $(this).attr('src', no_tick_image_path(id));
                    }

                });

                // if we click on the label
                $("label[for='" + id + "']").click(function(){
                    if($("#tick_img_" + id).attr('src') == no_tick_image_path(id)){
                        $("#tick_img_" + id).attr('src', tick_image_path);
                    }
                    else {
                        $("#tick_img_" + id).attr('src', no_tick_image_path(id));
                    }
                });

            }

        });
    }

})(jQuery);