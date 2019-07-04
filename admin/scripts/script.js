/**
 * Contains common JS routines.
 *
 * @author Vladislav Luzan
 * @since 1.1.0
 */
'use strict';


jQuery( $ => {

    /*
     * Defines variables & Inits CodeMirror.
     */
    let $form  = $( '.codebox__form' ),

        input  = editor( '.codebox__input' ),
        output = editor( '.codebox__output', true );


    /*
     * Setups the CodeMirror elements.
     *
     * Focuses on the input and moves cursor to the third line.
     */
    input.focus();
    input.setCursor( { line: 3, ch: 1 } );



    /**
     * Inits a CodeMirror for the specified element with the predefined settings.
     *
     * @since 1.1.0
     *
     * @param selector Selector of the element to initialize a CodeMirror for.
     * @param readOnly Whether the editor is read-only.
     *
     * @return {*} A CodeMirror instance.
     */
    function editor( selector, readOnly = false ) {
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
        }) ;
    }


    /**
     * Sends an AJAX with the form content to the the server for the execution, and displays the result.
     *
     * @since 1.1.0
     *
     * @listens $form:submit
     */
    $form.submit( event => {
        event.preventDefault();

        let data = {
            'action':     'codebox_execute',
            'nonceToken':  codebox.nonceToken,

            'code': input.getValue()
        };


        $.post( {
            url: ajaxurl,
            data: data,
            error: jqXHR => {
                output.setValue( jqXHR.responseText );

                $( '.CodeMirror' ).addClass( 'codebox__is-error' );
            }
        } )
            .done( result => {
                output.setValue( result );

                $( '.CodeMirror' ).removeClass( 'codebox__is-error' );
            });
    });


    /**
     * Keyboard handlers.
     *
     * Submit the form if "Ctrl + Enter" are pressed.
     *
     * @since 1.1.0
     *
     * @listens document:keyup
     */
    function keyUpHandler( event ) {
        if ( event.ctrlKey && 13 === event.keyCode ) { // Ctrl + Enter
            $form.submit();
        }
    }
    document.addEventListener( 'keyup', keyUpHandler, false );
});
