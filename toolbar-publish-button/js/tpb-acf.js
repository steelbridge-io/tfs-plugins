(function( $, _ ) {

    _.extend( acf.FieldObject.prototype, {

        // ACF focus on submit removed
        onSubmit: function( e, $el ){
            
            // vars
            var $title = $('#titlewrap #title');
            
            // empty
            if( !$title.val() ) {
                
                // prevent default
                e.preventDefault();
                
                // unlock form
                acf.unlockForm( $el );
                
                // alert
                alert( acf.__('Field group title is required') );
            }
        },

        // older ACF versions
        // close on submit removed
        submit: function(){

            // vars
            var inputName = this.getInputName();
            var save = this.get('save');

            // allow all inputs to save
            if( save == 'settings' ) {
                // do nothing

            // allow only meta inputs to save
            } else if( save == 'meta' ) {
                this.$('> .settings [name^="' + inputName + '"]').remove();

            // prevent all inputs from saving
            } else {
                this.$('[name^="' + inputName + '"]').remove();
            }

            // action
            acf.doAction('submit_field_object', this);
        }
    });

})( jQuery, _ );
