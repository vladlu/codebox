'use strict';

jQuery( $ => {


    // CodeMirror


    function editor( selector, readOnly=false ) {
        return CodeMirror.fromTextArea(
            document.querySelector( selector ),
        {
            mode: "application/x-httpd-php",
            lineNumbers: true,
            lineWrapping: true,
            indentUnit: 4,
            indentWithTabs: true,
            readOnly: readOnly,

            matchBrackets: true
        });
    }

    let input  = editor( '.codebox__input' ),
        output = editor( '.codebox__output', true );


    // Submit Form Handler (AJAX)


    $( '.codebox__form' ).submit( (event) => {
        event.preventDefault();

        let data = {
            'action': 'codebox_execute',
            'token':  codebox.token,

            'code':   input.getValue()
        };

        $.post( ajaxurl, data, result => {
            output.setValue( result );
        } );
    });


    // Shortcuts


    function keyUpHandler( event ) {
        if ( event.ctrlKey && event.keyCode === 13 ) { // Ctrl + Enter
            $( '.codebox__form' ).submit();
        }
    }
    document.addEventListener( 'keyup', keyUpHandler, false );
});