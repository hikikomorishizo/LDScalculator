jQuery(function ($) {
    $(document).ready ( function(){

        $("#ajax_result_form").fadeOut();
		
		
        $( "#ld_submit" ).on( "click", function(e) {

            var check_prod__flag = $('.woocommerce-variation-price');
            if(check_prod__flag.length) {
                price = $('.woocommerce-variation-price .price bdi').html();
            }else {
                price = $('.summary .price bdi').html();
            }

            
			
			var array = price.split("</span>");
			var price = parseInt(array[1]);  
            

            e.preventDefault();

            var $data;

            $data = $(this).parent('form').serializeArray();




			var kod = $('input[name="kodp"]').val();
            var dodat = $('select[name="attribute_pa_dodatki"]').val();
            var kominek = $('select[name="attribute_pa_kominek"]').val();
			var cena = 0;
			var cena_km = ld_cena;
            var cenazero = 0;

            $.ajax({
            url: 'https://rolnikhandluje.pl/api/distance.php?from='+ld_opt+'&to='+kod+'',
            //url: 'https://panel.aseem.pl/api/test.php', // TEMP API
            type: 'get',
            dataType: 'jsonp',
            CORS: true ,
            contentType:'application/json',
            secure: true,
            headers: {
                'Access-Control-Allow-Origin': '*',
                },
                beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
                },
            data: $data,
            success: function(result) {
                //$('#ajax_result_form').html(result);
				

				if(result.response<ld_cenaif){
					cena_km = ld_cenamin;
                }
				
                if(result.response==0){
                    cenazero = ld_cenaz;
                }

				cena = price + (result.response * cena_km) + cenazero;

				
                $.ajax({
                    url: '../../wp-content/plugins/LDScalculator/assets/ajax_send_form.php?cena='+cena+'&dodat='+dodat+'&kominek='+kominek+'&ld_cbox__tel_ajax='+ld_cbox__tel_ajax+'&prodName='+prodName+'&ld_mail__ajax='+ld_mail__ajax+'&ld_tel__ajax='+ld_tel__ajax+'&ld_tel__user_ajax='+ld_tel__user_ajax+'&ld_tel__api_ajax='+ld_tel__api_ajax+'&ld_tel__sender_ajax='+ld_tel__sender_ajax+'&ld_cbox__mail_ajax='+ld_cbox__mail_ajax,
                    type: 'post',
                    data: $data,
                    success: function(result) {
                        $('#ajax_result_form').html(result);
                        $("#ajax_result_form").fadeIn();
                    }
                    })
            }
            });			
			
            
            
        } );



        //Mask
        $("#lds_tel").mask("999-999-999");
        $("#lds_kodp").mask("99-999");


    });
});



window.onload = function() { 
    var cbox = document.querySelector('#lds_cbox');
    var btn = document.querySelector('#ld_submit');
    cbox.onclick = function(){
        if(btn.classList.contains('lds_non__active')){
            btn.classList.remove("lds_non__active");
            btn.disabled = false;
        } else {
            btn.classList.add("lds_non__active");
            btn.disabled = true;
        }
        
      }
};

//$cena = strip_tags($_GET['cena']);