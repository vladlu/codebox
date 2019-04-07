<?php

// Exits if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>


<h1 class="codebox_header">CodeBox</h1>

<form class="codebox__form">
    <div class="codebox__container">
        <textarea class="codebox__input"></textarea>
    </div>

    <div class="codebox__container" data-gramm_editor="false">
        <div class="codebox__column">
            <?php submit_button( 'Execute', [ 'primary', 'codebox__submit' ] ) ?>

            <span class="codebox__submit-shortcut">CTRL + ENTER</span>
        </div>
    </div>
</form>

<div class="codebox__container">
    <textarea class="codebox__output" data-gramm_editor="false"></textarea>
</div>
