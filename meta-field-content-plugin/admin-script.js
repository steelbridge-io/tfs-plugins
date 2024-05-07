
jQuery(document).ready(function($){
    $('#upload_image_button1').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Image',
            // multiple: false
        }).open()
            .on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url1 = uploaded_image.toJSON().url;
                $('#image_url1').val(image_url1);
            });
    });

    $('#upload_image_button2').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Image',
            // multiple: false
        }).open()
            .on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url2 = uploaded_image.toJSON().url;
                $('#image_url2').val(image_url2);
            });
    });
});