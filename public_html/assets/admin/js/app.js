    var config = {
        doc: $(document)
    }
    
    CKEDITOR.disableAutoInline = true;
    
    $( document ).ready( function() {
        $( 'textarea.editor' ).ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.
        $(".multiple_select2").removeClass('form-control');
        $(".multiple_select2").css('width', '100%');
        $(".multiple_select2").select2();
    } );
    

