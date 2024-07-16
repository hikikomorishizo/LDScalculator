<?php

/**
 * Plugin Name: LDS Calculator
 * Description: Calculate the price from the distance
 * Plugin URI:  ldsolutions.pl
 * Author URI:  ldsolutions.pl
 * Author:      LDSolutions
 * Version:     V1.0
 */
 



// ADM ASSETS
 function add_assets_adm() {
    wp_register_style('add_assets_adm', plugins_url('assets/lds_calc_adm.css',__FILE__ ));
    wp_enqueue_style('add_assets_adm');
    // wp_register_script( 'add_assets_adm', plugins_url('assets/lds_calc_adm.js',__FILE__ ));
    // wp_enqueue_script('add_assets_adm');
}

add_action( 'admin_init','add_assets_adm');

// ASSETS
function add_assets() {
	
    wp_enqueue_style( 'add_assets', plugins_url( 'assets/lds_calc.css' , __FILE__ ) );
    
}

add_action( 'wp_enqueue_scripts','add_assets');

function add_assets_footer() {
	
	wp_register_script( 'add_assets_footer', plugins_url('assets/lds_calc.js',__FILE__ ));
	wp_enqueue_script('add_assets_footer');
}
add_action( 'wp_footer','add_assets_footer');




// ADM PAge

add_action( 'admin_menu', 'lds_calculator_page__adm', 25 );
 
function lds_calculator_page__adm(){


    add_menu_page('LDScalculator', 'LDScalculator', 'manage_options', __FILE__, 'lds_calculator_page_callback', 'dashicons-editor-expand', 20);
}
 
function lds_calculator_page_callback(){

// ----------------------------------------------

    add_option('lds_calc__option', '26-600');
    $lds_calc__meta = get_option('lds_calc__option');

    add_option('lds_calc__cenakm', '3');
    $lds_calc__km = get_option('lds_calc__cenakm');

    add_option('lds_calc__cenakmif', '200');
    $lds_calc__kmif = get_option('lds_calc__cenakmif');

    add_option('lds_calc__cenakmmin', '5');
    $lds_calc__kmmin = get_option('lds_calc__cenakmmin');

    add_option('lds_calc__cenakmz', '250');
    $lds_calc__kmz = get_option('lds_calc__cenakmz');

    add_option('lds_cbox_mail', 'mailmeta');
    $lds_calc__cbox_mail = get_option('lds_cbox_mail');

    add_option('lds_mail', 'ex@m.com');
    $lds_calc__mail = get_option('lds_mail');

    add_option('lds_cbox_tel', 'telmeta');
    $lds_calc__cbox_tel = get_option('lds_cbox_tel');

    add_option('lds_tel', '');
    $lds_calc__tel = get_option('lds_tel');

    add_option('lds_tel_user', '');
    $lds_calc__tel_user = get_option('lds_tel_user');
    
    add_option('lds_tel_api', ''); //d27f074212b12eb09630c543e9481ced
    $lds_calc__tel_api = get_option('lds_tel_api');

    add_option('lds_tel_sender', '');
    $lds_calc__tel_sender = get_option('lds_tel_sender');

    add_option('main_color', '#14c5fd');
    $lds_calc__main_color = get_option('main_color');

    add_option('hover_color', '#007ba0');
    $lds_calc__hover_color = get_option('hover_color');


// ----------------------------------------------

    if ( isset($_POST['submit']) )
    {  
       if ( function_exists('current_user_can') &&
            !current_user_can('manage_options') )
                die ( _e('Hacker?', 'lds_calc') );

        if (function_exists ('check_admin_referer') )
        {
            check_admin_referer('lds_calc_form');
        }

// ----------------------------------------------

        $lds_calc__meta = $_POST['lds_calc__option'];
        update_option('lds_calc__option', $lds_calc__meta);

        $lds_calc__km = $_POST['lds_calc__cenakm'];
        update_option('lds_calc__cenakm', $lds_calc__km);

        $lds_calc__kmif = $_POST['lds_calc__cenakmif'];
        update_option('lds_calc__cenakmif', $lds_calc__kmif);

        $lds_calc__kmmin = $_POST['lds_calc__cenakmmin'];
        update_option('lds_calc__cenakmmin', $lds_calc__kmmin);

        $lds_calc__kmz = $_POST['lds_calc__cenakmz'];
        update_option('lds_calc__cenakmz', $lds_calc__kmz);

        $lds_calc__cbox_mail = $_POST['lds_cbox_mail'];
        update_option('lds_cbox_mail', $lds_calc__cbox_mail);

        $lds_calc__mail = $_POST['lds_mail'];
        update_option('lds_mail', $lds_calc__mail);

        $lds_calc__cbox_tel = $_POST['lds_cbox_tel'];
        update_option('lds_cbox_tel', $lds_calc__cbox_tel);

        $lds_calc__tel = $_POST['lds_tel'];
        update_option('lds_tel', $lds_calc__tel);

        $lds_calc__tel_user = $_POST['lds_tel_user'];
        update_option('lds_tel_user', $lds_calc__tel_user);

        $lds_calc__tel_api = $_POST['lds_tel_api'];
        update_option('lds_tel_api', $lds_calc__tel_api);

        $lds_calc__tel_sender = $_POST['lds_tel_sender'];
        update_option('lds_tel_sender', $lds_calc__tel_sender);

        $lds_calc__main_color = $_POST['main_color'];
        update_option('main_color', $lds_calc__main_color);

        $lds_calc__hover_color = $_POST['hover_color'];
        update_option('hover_color', $lds_calc__hover_color);


// ----------------------------------------------

    }
    ?>
    <div class='wrap'>
        <h2 style="text-align: center;"><?php _e('LDS calculator settings', 'lds_calc'); ?></h2>
        <a class="lds_mainlink" href="http://ldsolutions.pl">Strony internetowe, Sklepy internetowe, Aplikacje internetowe</a>

        <form class="lds_calc__form" name="lds_calc" method="post">

            <?php
                if (function_exists ('wp_nonce_field') )
                {
                    wp_nonce_field('lds_calc_form');
                }
            ?>

<!-- ---------------------------------------------- -->

            <div class="lds_form__cont">

            
                <label for="lds_calc__meta"><?php _e('Kod Pocztowy:', 'lds_calc'); ?></label>
                <input type="text" id="lds_calc__meta" name="lds_calc__option" placeholder="Kod Pocztowy.." size="80" value="<?php echo $lds_calc__meta; ?>" />

                <label for="lds_calc__km"><?php _e('Cena z/km :', 'lds_calc'); ?></label>
                <input type="number" id="lds_calc__km" name="lds_calc__cenakm" placeholder="Cena" size="80" value="<?php echo $lds_calc__km; ?>" />

                <label for="lds_calc__kmif"><?php _e('Minimalna odległość dla zmiany ceny :', 'lds_calc'); ?></label>
                <input type="number" id="lds_calc__kmif" name="lds_calc__cenakmif" placeholder="Minimalna odległość" size="80" value="<?php echo $lds_calc__kmif; ?>" />

                <label for="lds_calc__kmmin"><?php _e('Nowa cena z/km jeśli odległość jest większa:', 'lds_calc'); ?></label>
                <input type="number" id="lds_calc__kmmin" name="lds_calc__cenakmmin" placeholder="Cena" size="80" value="<?php echo $lds_calc__kmmin; ?>" />

                <label for="lds_calc__kmz"><?php _e('Cena jeśli odległość 0:', 'lds_calc'); ?></label>
                <input type="number" id="lds_calc__kmz" name="lds_calc__cenakmz" placeholder="Cena" size="80" value="<?php echo $lds_calc__kmz; ?>" />

                <label style="margin: 10px 0;" class="checkbox style-f">
                    <input type="checkbox" id="lds_cbox__adm_mail"  name="lds_cbox_mail" value="mailmeta" <?php if($lds_calc__cbox_mail == "mailmeta") {echo 'checked';} ?> />
                    <div class="checkbox__checkmark"></div>
                    <div class="checkbox__body">Wysyłanie wiadomości na E-mail</div>

                    <input type="text" id="lds_calc__mail" name="lds_mail" placeholder="E-mail.." size="80" value="<?php echo $lds_calc__mail; ?>" />
                </label><br>

                <label style="margin: 10px 0;" class="checkbox style-f">
                    <input type="checkbox" id="lds_cbox__adm_tel"  name="lds_cbox_tel" value="telmeta" <?php if($lds_calc__cbox_tel == "telmeta") {echo 'checked';} ?> />
                    <div class="checkbox__checkmark"></div>
                    <div class="checkbox__body">Wysyłanie wiadomości na telefon</div>

                    <input type="text" id="lds_calc__tel" name="lds_tel" placeholder="Numer telefonu.." size="80" value="<?php echo $lds_calc__tel; ?>" />
                    <input type="text" id="lds_calc__tel_user" name="lds_tel_user" placeholder="User" size="80" value="<?php echo $lds_calc__tel_user; ?>" />
                    <input type="text" id="lds_calc__tel_api" name="lds_tel_api" placeholder="Api" size="80" value="<?php echo $lds_calc__tel_api; ?>" />
                    <input type="text" id="lds_calc__tel_sender" name="lds_tel_sender" placeholder="Pola nadawcy" size="80" value="<?php echo $lds_calc__tel_sender; ?>" />
                </label><br>

                <label for="lds_calc__main_color"><?php _e('Main color:', 'lds_calc'); ?></label>
                <input type="text" id="lds_calc__main_color" name="main_color" placeholder="Main color.." size="80" value="<?php echo $lds_calc__main_color; ?>" />

                <label for="lds_calc__hover_color"><?php _e('Hover color:', 'lds_calc'); ?></label>
                <input type="text" id="lds_calc__hover_color" name="hover_color" placeholder="Hover color.." size="80" value="<?php echo $lds_calc__hover_color; ?>" />


            </div>

            <input type="hidden" name="action" value="update" />

            <input type="hidden" name="page_options"
                value="lds_calc__option,lds_calc__cenakm,lds_calc__cenakmz,lds_calc__cenakmif,lds_calc__cenakmmin,lds_cbox_mail,lds_mail,lds_cbox_tel,lds_tel,lds_tel_user,lds_tel_api,lds_tel_sender,main_color,hover_color" />

            <p class="submit">
            <input type="submit" name="submit" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
    </div>

    <?php

}





// WOO Hooks
add_action (  'woocommerce_before_single_product' , 'remove_woo__hook'  ) ;

function remove_woo__hook() {
	// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}


function ld_calc() {
    // echo get_option( "lds_calc__option" );
    global $product; 
    $prodName = $product->get_title();


    $ld_html = '
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script>
            var ld_opt = "'. get_option( "lds_calc__option" ) .'";
            var ld_cena = "'. get_option( "lds_calc__cenakm" ) .'";
            var ld_cenaif = "'. get_option( "lds_calc__cenakmif" ) .'";
            var ld_cenamin = "'. get_option( "lds_calc__cenakmmin" ) .'";
            var ld_cenaz = '. get_option( "lds_calc__cenakmz" ) .';
            var ld_cbox__mail_ajax = "'. get_option( "lds_cbox_mail" ) .'";
            var ld_mail__ajax = "'. get_option( "lds_mail" ) .'";
            var ld_cbox__tel_ajax = "'. get_option( "lds_cbox_tel" ) .'";
            var ld_tel__ajax = "'. get_option( "lds_tel" ) .'";
            var ld_tel__user_ajax = "'. get_option( "lds_tel_user" ) .'";
            var ld_tel__api_ajax = "'. get_option( "lds_tel_api" ) .'";
            var ld_tel__sender_ajax = "'. get_option( "lds_tel_sender" ) .'";

            var prodName = "'. $prodName .'";
        </script>

        <style>
            :root {
                --main-color: '. get_option( "main_color" ) .';
                --main-color-hover: '. get_option( "hover_color" ) .';
            }
        </style>
        


        <div class="ld_form__cont">
            <form id="ld_form">
			Imię<br/>
                <input id="lds_i__name" type="text" name="u-name" placeholder="Twoje imię" pattern=".{1,}" required />
			Kod pocztowy	<br/>
                <input id="lds_kodp" type="text" name="kodp" placeholder="Kod pocztowy" pattern=".{1,}" required />
			Telefon	<br/>
                <input id="lds_tel" type="tel" name="tel" placeholder="Telefon" pattern=".{1,}" required />
			Preferowana data dostawy<br/>
                <input type="date" name="date" placeholder="Data" required />
                <label class="checkbox style-f">
                    <input id="lds_cbox" type="checkbox"/>
                    <div class="checkbox__checkmark"></div>
                    <div class="checkbox__body">Zgadzam się z polityką prywatności strony</div>
                </label>

                <span class="lds_err__input">Należy wypełnić wszystkie pola</span>
                <input class="lds_non__active" id="ld_submit" disabled type="submit" value="Pokaż cenę" />
            </form>
        </div>
        <div id="ajax_result_form"></div>
    ';

    
    print_r($ld_html);
}

add_action (  'woocommerce_before_single_product' , 'add_woo__hook'  ) ;

function add_woo__hook() {
	add_action( 'woocommerce_single_product_summary', 'ld_calc', 40 );
}