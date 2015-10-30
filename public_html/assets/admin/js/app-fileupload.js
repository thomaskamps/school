			$(function () {
			    $('.fileupload').fileupload({
			        dataType: 'json',
			        done: function (e, data) {
						var container = $('#file-container');
                        // console.log('done');
			            $.each(data.result.files, function (index, file) {
                            // console.log(file.name);
			                $('<p/>').text(file.name).appendTo(container);
			                $('<input type="hidden" name="slideshow-files[]" value="' + file.name + '">').appendTo(container);
							
			            });
			        }
			    });
			});