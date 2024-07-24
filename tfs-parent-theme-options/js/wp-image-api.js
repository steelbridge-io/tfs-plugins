jQuery(document).ready( function($){ "use strict";

    // Signature Travel Template.
    var landing_pg_logo_frame;

    // Runs when the image button is clicked.
    $('#landing-page-logo-button').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( landing_pg_logo_frame ) {
            landing_pg_logo_frame.open();
            return;
        }

        // Sets up the media library frame
        landing_pg_logo_frame = wp.media.frames.landing_pg_logo_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        landing_pg_logo_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = landing_pg_logo_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            $('#landing-page-logo').val(media_attachment.url);
        });

        // Opens the media library frame.
        landing_pg_logo_frame.open();
    });


    // Signature Travel Template.
    var landing_pg_hero_frame;

    // Runs when the image button is clicked.
    $('#landing-page-image-button').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( landing_pg_hero_frame ) {
            landing_pg_hero_frame.open();
            return;
        }

        // Sets up the media library frame
        landing_pg_hero_frame = wp.media.frames.landing_pg_hero_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        landing_pg_hero_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = landing_pg_hero_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            $('#landing-page-image').val(media_attachment.url);
        });

        // Opens the media library frame.
        landing_pg_hero_frame.open();
    });
});