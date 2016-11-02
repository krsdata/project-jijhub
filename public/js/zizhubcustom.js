function setupLabel() {
        if ($('.label_check input').length) {
            $('.label_check').each(function(){ 
                $(this).removeClass('c_on');
            });
            $('.label_check input:checked').each(function(){ 
                $(this).parent('label').addClass('c_on');
            });                
        };
        if ($('.label_radio input').length) {
            $('.label_radio').each(function(){ 
                $(this).removeClass('r_on');
            });
            $('.label_radio input:checked').each(function(){ 
                $(this).parent('label').addClass('r_on');
            });
        };
    };
    $(document).ready(function(){
        $('.label_check, .label_radio').click(function(){
            setupLabel();
        });
        setupLabel();
        var currency=$("#currency").val();
            if(currency=="ILS"){
                var cur="₪";
            }
            else
            {
                var cur="$";
            }
        $( ".select_radio" ).click(function() {            
            
            if (this.value==1) {                                  
                var discount_price=$("#discount_price").val();
                var price=$("#zizpic_1").val();                
                if(!discount_price)
                {
                    discount_price=0;
                }
                $("#zizhub_radio").val('1')                      
                $('.itemNm').text("1 ziz art");
                $('#itemPrice').text(price+" "+cur);                
                $('#itemTotal_price').text(price-discount_price+" "+cur);
               // $('#itne_no').val('1');
                $('#total').val(price-discount_price);
                $("#zizhub_first").addClass('single_zizhub');
                $("#2").hide();
                $("#3").hide();
            }
            else
            {
                var discount_price=$("#discount_price").val();
                if(!discount_price)
                {
                    discount_price=0;
                }
                var price=$("#zizpic_3").val();                               
                $("#zizhub_radio").val('3');
                $('.itemNm').text("3 ziz art");
                $('#itemPrice').text(price+" "+cur); 
                $('#itemTotal_price').text(price-discount_price+" "+cur);
               // $('#itne_no').val('3');
                $('#total').val(price-discount_price);
                $("#zizhub_first").removeClass('single_zizhub');
                $("#2").show();
                $("#3").show();
            }
        });
        
        /*********save value***********/
        var product_arr=[];
        var chk_pro=[];
        var i=0;
        $( ".add_val" ).click(function() {           
            product_arr.push($(this).attr("data_value"));                       
            if($.inArray($(this).attr("data_disble"),chk_pro)>=0)
            {
                //alert("Already selected.");
                return false;
            }
            chk_pro.push($(this).attr("data_disble"));
            if($(this).attr("data_disble")=="owl-demo_01")
            {
                $(".disable-owl-swipe1").on("touchstart mousedown", function(e) {
                // Prevent carousel swipe
                e.stopPropagation();                
                })
                $("#pro1").hide();
                $("#product1").val(1);                
            }
            if($(this).attr("data_disble")=="owl-demo_03")
            {
                $(".disable-owl-swipe2").on("touchstart mousedown", function(e) {
                // Prevent carousel swipe                
                e.stopPropagation();                
                })
                $("#pro2").hide();
                $("#product2").val(1);
            }
            if($(this).attr("data_disble")=="owl-demo_04")
            {
                $(".disable-owl-swipe3").on("touchstart mousedown", function(e) {
                // Prevent carousel swipe                
                e.stopPropagation();                
                })               
                $("#pro3").hide();
                $("#product3").val(1);
            }
            //console.log(chk_pro);           
            $("#products").val(product_arr);
            $(".pick_"+$(this).attr("data")).hide();
            $(".rem_"+$(this).attr("data")).show();            
            var id=$(this).attr("data_disble");            
            
            $('#'+id).find('.owl-next').css({"opacity": "0.3", "pointer-events": "none"});
            $('#'+id).find('.owl-prev').css({"opacity": "0.3", "pointer-events": "none"});                                       
        });
        
        $(".pop_val").click(function(){                                
            var index1=(product_arr.indexOf($(this).attr("data_value")));
            
            product_arr.splice(index1,1);
            var index=(chk_pro.indexOf($(this).attr("data_enable")));
            chk_pro.splice(index,1);
            if($(this).attr("data_enable")=="owl-demo_01")
            {
                $("div").removeClass("disable-owl-swipe1");
                $("#product1").val("");

            }
            if($(this).attr("data_enable")=="owl-demo_03")
            {
                $("#product2").val("");
            }
            if($(this).attr("data_enable")=="owl-demo_04")
            {
                $("#product3").val("");
            }
            $(".pick_"+$(this).attr("data")).show();
            $(".rem_"+$(this).attr("data")).hide();
            var remid=$(this).attr("data_enable");
            // $('#'+remid).find('.owl-next').css("display","block");
            // $('#'+remid).find('.owl-prev').css("display","block");  
            $('#'+remid).find('.owl-next').css({"opacity": "1", "pointer-events": "auto"});
            $('#'+remid).find('.owl-prev').css({"opacity": "1", "pointer-events": "auto"});                                       
            $("#products").val(product_arr);              
            console.log(chk_pro);
        });
        
        $(".owl-controls clickable").click(function(){
           
        });
        /**********end save value****************/
        /****************ziz*************/
        $("#submit").click(function(e){
            e.preventDefault();
            var ziz_code=$("#ziz_code").val();
            //var ziz_package=$(".select_radio").val();
            var ziz_package=$("#zizhub_radio").val();                    
            $.ajax({
                type: "POST",
                url: url,
                data: {ziz_code: ziz_code, packages: ziz_package,_token: token},
                success: function( discount_price ) {
                    discount_price=jQuery.parseJSON(discount_price);                    
                    discount_price=discount_price.amount;
                    if(discount_price!=0)
                    {
                        $("#discount").show();
                        $("#discount_price").val(ziz_code);
                        $("#show_discount").text("-"+discount_price);
                        var discount=($("#total").val())-discount_price;
                        $("#discount_price").val(discount_price);
                        $("#zizcode").val(ziz_code);
                        $('#itemTotal_price').text(discount);
                        $("#total").val(discount);
                        $(".codeInputSec").hide();
                        $(".showcode").text(ziz_code);
                        $(".showcode").css("top","10px");
                        $(".coupon-msg").text("");  
                        $(".coupon-msg").css("color","");     

                    }
                    else{
                        $(".coupon-msg").text("Not valid number");  
                        $(".coupon-msg").css("color","red");    
                        $("#zizcode").val("");              
                    }                         
                }
            });       
        });
        /**************end ziz**************/
        /**************submit form***************/
        $("#by_paypal_payment, #form_submit").click(function(){
            var email=$("#email").val();
            var full_name=$("#full_name").val();
            var address=$("#address").val();
            var city=$("#city").val();
            var state=$("#state").val();
            var zip=$("#zip").val();
            var country=$("#country").val();
            var phone=$("#phone").val();
            var validate_chk=0;
            if(!email)
            {
                validate_chk=1;
                $("#email").addClass( "mandotary" );                  
            }
            else if( !validateEmail(email))
            {
                validate_chk=1;
                $("#email").addClass( "mandotary" );                  
            }
            else
            {
                $("#email").removeClass( "mandotary" );                  
            }
            if(!full_name)
            {
                validate_chk=1;
                $("#full_name").addClass( "mandotary" );                  
            }
            else
            {
                $("#full_name").removeClass( "mandotary" );                  
            }
            if(!address)
            {
                validate_chk=1;
                $("#address").addClass( "mandotary" );                  
            }
            else
            {
                $("#address").removeClass( "mandotary" );                  
            }
            if(!city)
            {
                validate_chk=1;
                $("#city").addClass( "mandotary" );                  
            }
            else
            {
                $("#city").removeClass( "mandotary" );                  
            }
            if(!state)
            {
                validate_chk=1;
                $("#state").addClass( "mandotary" );                  
            }
            else
            {
                $("#state").removeClass( "mandotary" );                  
            }
            if(!zip)
            {
                validate_chk=1;
                $("#zip").addClass( "mandotary" );                  
            }
            else
            {
                $("#zip").removeClass( "mandotary" );                  
            }
            if(!country)
            {
                validate_chk=1;
                $("#country").addClass( "mandotary" );                  
            }
            else
            {
                $("#country").removeClass( "mandotary" );                  
            }
            if(!phone)
            {
                validate_chk=1;
                $("#phone").addClass( "mandotary" );                  
            }
            else
            {
                $("#phone").removeClass( "mandotary" );                  
            }          
            if($(this).val()){
                var form_submit=$("#form_submit").val();
                var phone_order=$(".phone_order ").val();  
                
                if(form_submit && !phone_order)
                {               
                    validate_chk=1;
                    $(".phone_order").addClass( "error" );                  
                }
                else
                {
                    $("#phone_order").removeClass( "error" );                  
                }
            }
            else
            {
                $("#payment_method").val( "paypal" );
            }
                var pro1=$("#product1").val();
                var pro2=$("#product2").val();
                var pro3=$("#product3").val();
                var zizhub=$("#zizhub_radio").val();            
            if(!pro1 && (zizhub==3 || zizhub==1))
            {
                validate_chk=1;
                $("#pro1").show();
                $("#pro1").css("color",'red');                    
            }
            else{
                $("#pro1").hide();
                $("#pro1").css("color",'');
            }
            if(!pro2 && (zizhub==3))
            {
                validate_chk=1;
                $("#pro2").show();
                $("#pro2").css("color",'red');                
            }
            else{
                $("#pro2").hide();
                $("#pro2").css("color",'');
            }
            if(!pro3 && (zizhub==3))
            {
                validate_chk=1;
                $("#pro3").show();
                $("#pro3").css("color",'red');                               
            }
            else{
                $("#pro3").hide();
                $("#pro3").css("color",'');
            }

            if(validate_chk)
            {                
                $("#show_err").show();
                $("#show_err").css("color",'red');                               
                $("html, body").animate({ scrollTop: 550 }, 600); 
                return false;
            }
            else
            {
                $("#show_err").hide();
                $("#show_err").css("color",'');  
               // $("#payment_method").val( "paypal" );                   
            }

        });


        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
        }

        $("#by_phone").click(function(){
            $("#by-phone").show();
            $("#payment_method").val('phone');
        });

        /************end of submit form***************/        
    });      