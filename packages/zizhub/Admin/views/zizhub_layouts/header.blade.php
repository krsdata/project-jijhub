<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Zizhub | {{   isset($page_title)?$page_title:'Order' }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <!-- jQuery 2.1.4 -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <!--zizhub css-->
        <link rel="stylesheet" type="text/css" href="{{ url('zizhub/zizhub_css/bootstrap.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ url('zizhub/zizhub_css/font.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ url('zizhub/zizhub_css/font-awesome.css')}}" />        
        <link rel="stylesheet" type="text/css" href="{{ url('zizhub/zizhub_css/style.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ url('zizhub/zizhub_css/responsive.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ url('zizhub/zizhub_css/responsive.css')}}" />
        <link href="{{ url('zizhub/zizhub_css/owl.carousel.css')}}" rel="stylesheet">        
        <!--zizhub end css-->
        <!--zizhub js-->
        <script src="{{ url('zizhub/zizhub_js/jquery.min.js')}}"></script>        
        <script src="{{ url('zizhub/zizhub_js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ url('zizhub/zizhub_js/owl.carousel.js')}}"></script>
        
        <!--zizhub end js-->      
        @if(isset($lang) && $lang=='he')

        <style type="text/css">
            .inptSec label{ right:auto; left:364px; text-align:left; }
            .payment{ float:right;}
            .payInfo span{ float:right; }
            .payInfo span.itemPrice{ text-align:left;  width:43%;}
            .payInfo span { float: right; width: 57%;}
            .billing h4{ margin-left:0; margin-right:20px; }
            .codeInputSec input{ padding-left: 0px;  padding-right: 10px; text-align:right; }
            .codeInputSec input[type="submit"]{ right:auto; left:0; text-align:center; }
            #zizpic_item {
                float: right;
                margin-right: -5px;
                padding-left: 5px;
                text-align: right;
                width: auto;
            }
            .logo {
                right: 30px !important;
            }
        </style>
        <link href="{{ url('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />

        <script type="text/javascript">
        var currency = "₪";
        var language = "he";
        var package_1 = @if (!empty($prices_details['package_1'])){{ $prices_details['package_1'] }}@endif;
        var package_3 = @if (!empty($prices_details['package_3'])){{ $prices_details['package_3'] }}@endif;
        var shipment = @if (!empty($prices_details['shippment'])){{ $prices_details['shippment'] }}@endif;
        var gift = '{{ Lang::get('zizpic - lang.gift') }}';
        var free = '{{ Lang::get('zizpic - lang.free') }}';</script>
        @else
        <script type="text/javascript">
                    var currency = "$";
                    var language = "en";
                    var package_1 = @if (!empty($prices_details['package_1'])){{ $prices_details['package_1'] }}@endif;
                    var package_3 = @if (!empty($prices_details['package_3'])){{ $prices_details['package_3'] }}@endif;
                    var shipment = @if (!empty($prices_details['shippment'])){{ $prices_details['shippment'] }}@endif;
                    var gift = "{{ Lang::get('zizpic-lang.gift') }}";
                    var free = "{{ Lang::get('zizpic-lang.free') }}";

        </script>
        @endif

    </head>

