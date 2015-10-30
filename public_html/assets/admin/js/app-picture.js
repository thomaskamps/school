;(function(){
    var config = {
        doc: $(document)
    }

    var PictureConf = {
        holder          : '.picture_collection',
        item            : '.picture_collection li',
        // add_txt         : 'Video toevoegen',
        add_class       : 'add_form_exercise',
        delete_class    : 'delete_picture_form',
        check_class     : '.picture-check',
        check_ok        : '<i class="fa fa-check"></i>',
        check_fail      : '<i class="fa fa-times "></i>',
        check_refresh   : '<i class="fa fa-refresh fa-spin"></i>',
    }
    console.log('kip')
    var PictureFunc = {
        picture_init: function() {
            var h = $(PictureConf.holder)
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
            
            // $(PictureConf.item + ' input[data-id="video-url"]').trigger('keyup');
            $('input[data-id="picture-filename"]').on('change.bs.fileinput', config.doc.picture_show_thumb);
            
        },
        picture_add_form: function() {
            return this.delegate('.' + PictureConf.add_class, "click", function(e){
                e.preventDefault();
                console.log("kip");
                // console.log('add picture');
                var h = $(PictureConf.holder);
                // Get the data-prototype explained earlier
                var prototype = h.data('prototype');
                var index = h.data('index');

                var newForm = prototype.replace(/__name__/g, index+1);
                
                // increase the index with one for the next item
                h.data('index', index + 1);

                // Display the form in the page in an li, before the "new" link li
                var $newFormLi = $('<li style="display:inline-block; margin-top:2em;" class="gallary-picture-item col-sm-12 col-md-12 col-lg-12"></li>').append(newForm);
                h.append($newFormLi);

                config.doc.picture_delete_form($newFormLi);
                $newFormLi.find('input[data-id="picture-filename"]').on('change.bs.fileinput', config.doc.picture_show_thumb);
                return false;
            })
        },
        picture_delete_form: function(t) {
            
            return this.delegate('.' + PictureConf.delete_class, "click", function(e){
                e.preventDefault();
                var t = $(e.target).closest('.gallary-picture-item');
                t.remove();
            });
        },
        picture_show_thumb: function(e) {
                // console.log('preview')
                var preview = $(e.target).closest('.list-group-item').find('.preview');
        
                if (e.target.files.length === 0) {
                    preview.hide();
                } else {
                    var reader = new FileReader()
                    var file = e.target.files[0]

                    reader.onload = function (re) {
                        var $img = $('<img class="img-responsive">').attr('src', re.target.result)
                        e.target.files[0].result = re.target.result
                        preview.html($img)
                        preview.show();
                    }
                    reader.readAsDataURL(file)
                }
            
        }
    }

    $.extend(config.doc, PictureFunc);
    config.doc.picture_add_form();
    config.doc.picture_delete_form();
    // config.doc.picture_show_thumb();

    config.doc.picture_init();
    
    

}(jQuery, window, document));