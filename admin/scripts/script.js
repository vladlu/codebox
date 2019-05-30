'use strict';

jQuery( $ => {


    /*
     * CodeMirror
     */


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

    let $form  = $( '.codebox__form' ),

        input  = editor( '.codebox__input' ),
        output = editor( '.codebox__output', true );


    /*
     * Setups
     *
     * Focuses to the input and moves cursor to the third line.
     */


    input.focus();
    input.setCursor( {line: 3, ch: 1} );


    /*
     * Submit Form Handler (AJAX)
     */


    $form.submit( (event) => {
        event.preventDefault();

        let data = {
            'action': 'codebox_execute',
            'token':  codebox.token,

            'code':   input.getValue()
        };


        $.post( {
            url: ajaxurl,
            data: data,
            error: jqXHR => {
                output.setValue( jqXHR.responseText );
            }
        } )
            .done( result => {
                output.setValue( result );
            });
    });


    /*
     * Shortcuts
     */


    function keyUpHandler( event ) {
        if ( event.ctrlKey && event.keyCode === 13 ) { // Ctrl + Enter
            $form.submit();
        }
    }
    document.addEventListener( 'keyup', keyUpHandler, false );
});
