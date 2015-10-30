;(function(){

    var VideoConf = {
        holder          : '.video_collection',
        item            : '.video_collection li',
        add_txt         : 'Video toevoegen',
        add_class       : 'add_form_videos',
        delete_class    : 'delete_video_form',
        check_class     : '.video-check',
        check_ok        : '<i class="fa fa-check"></i>',
        check_fail      : '<i class="fa fa-times "></i>',
        check_refresh   : '<i class="fa fa-refresh fa-spin"></i>',
    }

    var VideoFunc = {
        video_init: function() {
            var h = $(VideoConf.holder)
            /*
            h.find('form-group').each(function() {
                addTagFormDeleteLink($(this));
            });
            */
            
            // add 'new' link
            // var nl = $('<a href="#" class="pull-right btn btn-default ' + VideoConf.add_class + '"><i class="fa fa-plus"></i> ' + VideoConf.add_txt + '</a>')
            // VideoConf.new_li = $('<li></li>').append(nl);
            // h.append(VideoConf.new_li);

            // count the current form inputs we have (e.g. 2), use that as the new
            // index when inserting a new item (e.g. 2)
            h.data('index', h.find(':input').length);
            
            $(VideoConf.item + ' input[data-id="video-url"]').trigger('keyup');
        },
        video_add_form: function() {
            return this.delegate('.' + VideoConf.add_class, "click", function(e){
                e.preventDefault();
                
                // console.log('add video');
                var h = $(VideoConf.holder);
                // Get the data-prototype explained earlier
                var prototype = h.data('prototype');
                var index = h.data('index');

                var newForm = prototype.replace(/__name__/g, index+1);
                
                // increase the index with one for the next item
                h.data('index', index + 1);

                // Display the form in the page in an li, before the "Add a tag" link li
                var $newFormLi = $('<li class="list-group-item"></li>').append(newForm);
                // $(VideoConf.item + ':last').after($newFormLi);
                h.append($newFormLi);
                config.doc.video_delete_form($newFormLi);
                //addTagFormDeleteLink($newFormLi);
                return false;
            })
        },
        video_delete_form: function(t) {
            return this.delegate('.' + VideoConf.delete_class, "click", function(e){
                e.preventDefault();
                var t = $(e.target).closest('.list-group-item');
                t.remove();
            });
        },
        video_show_thumb: function() {
            return this.delegate(VideoConf.item + ' input[data-id="video-url"]', "keyup", function(){
                // console.log('show video');
                var v = $(this).closest('li');
                
                v.find(VideoConf.check_class).html(VideoConf.check_refresh);
                var video_id = v.find('input[data-id="video-url"]').val();
                // console.log("b: " + video_id);
				video_id = config.doc.youtube_parser(video_id);
                // console.log("a: " + video_id);
				
                if(video_id == undefined || video_id == "") {
                    return false;
                }
                
                var url = 'http://gdata.youtube.com/feeds/api/videos/' + video_id + '?v=2&alt=jsonc';
                $.getJSON(url, function() {})
                .success(function(data,status,xhr) {
                    // console.log ("success 2 ");
                    
                    v.find(VideoConf.check_class).html(VideoConf.check_ok);
                    var img = data.data.thumbnail.hqDefault;
                    var title = data.data.title;
                    var id = data.data.id;
                
                    v.find('img:first').attr('src', img);
					if(!v.find('input[data-id="video-title"]').val()) {
	                    v.find('input[data-id="video-title"]').attr('value', title);
					}
                })
                .error(function() {
                    // console.log ("error occurred ");
                    v.find(VideoConf.check_class).html(VideoConf.check_fail);
                })
                .complete(function() { //console.log("Done"); 
                });
                
                return false;
            });
            
        },
		youtube_parser: function (url) {
		    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		    var match = url.match(regExp);
		    if (match&&match[7].length==11){
		        return match[7];
		    } else {
                // console.log("Url incorrect");
				return url;
		    }
		}
    }

    $.extend(config.doc, VideoFunc);
    config.doc.video_add_form();
    config.doc.video_delete_form();
    config.doc.video_show_thumb();

    config.doc.video_init();
    

}(jQuery, window, document));