@extends('packages::zizhub_layouts.front-end')
@section('content')
@if($lang=='he')
 <body class="he">
@else
 <body class="">
@endif    
 
       
          <div class="container zpForm"><div class="ismeal_header">
               <div class="row">     
                <div class="col-md-12">
               
                        <div class="topHeader">
                              <a href="#" class="logo"><img src="{{url('zizhub/img/LATD_logo.png')}}" alt="" /></a>
                              <h2>{{ Lang::get( 'zizhub-lang.zizhub_order' ) }}</h2>
                         </div></div>
                   </div>     
               </div>
                <div class="row">
                    
                    <div class="desktop_banner"><img src="{{url('zizhub/img/desktop.jpeg')}}"/></div>
                    <div class="mobile_banner"><img src="{{url('zizhub/img/imgo1.jpeg')}}"/></div>                   
                </div>
              {!! Form::model($zizhuborders, ['route' => ['zizhuborders.store'],'class'=>'form-horizontal','role'=>'form','files' => true,'id'=>'zizpic_order_form']) !!}
               <div class="row">
                <div class="col-md-12">
                        <div class="chooseOrder has-js">
                            <span>{{ Lang::get( 'zizhub-lang.order' ) }}:</span>
                                <label class="label_radio" for="radio-01"><input name="zizhubpackage" id="radio-01" class="select_radio" value="1" type="radio">1 {{ Lang::get( 'zizhub-lang.zizhubs') }}</label>
                                <label class="label_radio r_on" for="radio-02"><input name="zizhubpackage" id="radio-02" class="select_radio" value="3" type="radio" checked="">3 {{ Lang::get( 'zizhub-lang.zizhubs') }}</label>
                                <input type="hidden" name="zizhub_radio" id="zizhub_radio" value="3">
                            </div>
                        </div>
               </div>
               <input type="hidden" name="products" id="products" value="">
               <div class="row zizpic3">
                <div class="head_dur">
               <p>{{ Lang::get( 'zizhub-lang.Pick_your_ziz_art' ) }}</p>
                <div class="col-sm-4 col-xs-4" id="zizhub_first">
                              
                        <div class="upImg" id="1">                                                    
                                <div id="owl-demo_01" class="owl-carousel owl-theme">                                 
                                @foreach($zizhubproduct as $prod)                                    
                                    <div class="item  disable-owl-swipe1" dir="ltr">
                                    <div class="upImgHD">{{$prod->pname}}<span>*</span></div>
                                    <div class="prodImg">
                                        {!! HTML::image(Config::get( 'app.image_path' ).'/'.$prod->product_image,'') !!}
                                        <div class="pick rem_product_{{ $prod->id }}"  style="display: none;"><img src="{{url('zizhub/img/picked_badge.png')}}"/><img class="mob" src="{{url('zizhub/img/items_mobile/Badge.png')}}"/></div>
                                    </div>    
                                        <!--  <a href="#">Tune</a><a href="#">Look</a><a href="#">Activate</a>
                                         <p>{{$prod->pname}}</p> -->                                        
                                        <div>
                                            <div class="fileUpload add_val pick_product_{{ $prod->id }}"  data_value="{{ $prod->id }}" data_disble="owl-demo_01" data="product_{{ $prod->id }}" id="pick_{{ $prod->id }}">
                                            <span>                                            
                                                <img src="{{url('zizhub/img/cartrege.png')}}"/>
                                                <img class="mob" src="{{url('zizhub/img/items_mobile/cartrage.png')}}"/>                                               
                                            </span>Pick</div>
                                        </div>
                                        <div style="display:none;" id="rem_0{{ $prod->id }}" class="rem_product_{{ $prod->id }}">
                                            
                                            <div class="fileUpload pop_val" data_enable="owl-demo_01" data_value="{{ $prod->id }}"  data="product_{{ $prod->id }}"><span><img src="{{url('zizhub/img/cartrege_selected.png')}}"/><img class="mob" src="{{url('zizhub/img/items_mobile/cartrage_selected.png')}}"/></span>Remove</div>
                                        </div>
                                    </div>
                                @endforeach                            
                        </div> 
                            <input type="hidden" id="product1">
                            <div id="pro1" style="display:none;text-align:center;">Please Pick A Ziz Art</div>
                         </div>
                    </div>
                    <div class="col-sm-4 col-xs-4 upTmg_mid">
                        <div class="upImg1" id="2">                            
                             <div id="owl-demo_03" class="owl-carousel owl-theme">
                        {{--*/$datas=array();/*--}}
                               @foreach($zizhubproduct as $key=>$prod)
                                    @if($key==1)
                                       {{--*/$datas[0] = $prod;/*--}}
                                    @elseif($key==0)
                                        {{--*/$datas[1] = $prod;/*--}}
                                    @else
                                        {{--*/$datas[$key] = $prod;/*--}}
                                   @endif
                               @endforeach
                               
                               {{--*/ksort($datas);/*--}}
                               
                            @foreach($datas as $prod)                                    
                                    <div class="item  disable-owl-swipe2" dir="ltr">
                                    <div class="upImgHD">{{$prod->pname}}<span>*</span></div>
                                    <div class="prodImg">
                                        {!! HTML::image(Config::get( 'app.image_path' ).'/'.$prod->product_image,'',array('height' => '214px','width'=>'134px')) !!}
                                        <div class="pick rem_product_1{{ $prod->id }}" style="display: none;"><img src="{{url('zizhub/img/picked_badge.png')}}"/><img class="mob" src="{{url('zizhub/img/items_mobile/Badge.png')}}"/></div>
                                    </div>    
                                        <!--  <a href="#">Tune</a><a href="#">Look</a><a href="#">Activate</a>
                                         <p>{{$prod->pname}}</p>   -->                                      
                                        <div>
                                            <div class="fileUpload add_val pick_product_1{{ $prod->id }}"  data_value="{{ $prod->id }}" data_disble="owl-demo_03"  data="product_1{{ $prod->id }}" id="pick_{{ $prod->id }}">
                                            <span>                                            
                                                <img src="{{url('zizhub/img/cartrege.png')}}"/> 
                                                <img class="mob" src="{{url('zizhub/img/items_mobile/cartrage.png')}}"/>                                                
                                            </span>Pick</div>
                                        </div>
                                        <div style="display:none;" id="rem_{{ $prod->id }}" class="rem_product_1{{ $prod->id }}"">
                                            
                                            <div class="fileUpload pop_val" data_enable="owl-demo_03"  data_value="{{ $prod->id }}"  data="product_1{{ $prod->id }}"><span><img src="{{url('zizhub/img/cartrege_selected.png')}}"/><img class="mob" src="{{url('zizhub/img/items_mobile/cartrage_selected.png')}}"/></span>Remove</div>
                                        </div>
                                    </div>
                                @endforeach
                                
                        </div> 
                        <input type="hidden" id="product2">
                        <div id="pro2" style="display:none;text-align:center;">Please Pick A Ziz Art</div>
                         </div>
                    </div>
                    <div class="col-sm-4 col-xs-4 bdr0">
                        <div class="upImg2" id="3">                            
                               <div id="owl-demo_04" class="owl-carousel owl-theme">
                               
                               {{--*/$datas=array();/*--}}
                               @foreach($zizhubproduct as $key=>$prod)
                                    @if($key==2)
                                       {{--*/$datas[0] = $prod;/*--}}
                                    @elseif($key==1)
                                        {{--*/$datas[1] = $prod;/*--}}
                                    @elseif($key==0)
                                        {{--*/$datas[2] = $prod;/*--}}
                                    @else
                                        {{--*/$datas[$key] = $prod;/*--}}
                                   @endif
                               @endforeach                               
                               {{--*/ksort($datas);/*--}}
                                
                               
                              
                          @foreach($datas as $prod)                                    
                                    <div class="item  disable-owl-swipe3" dir="ltr">
                                    <div class="upImgHD">{{$prod->pname}}<span>*</span></div>
                                    <div class="prodImg">
                                        {!! HTML::image(Config::get( 'app.image_path' ).'/'.$prod->product_image,'',array('height' => '214px','width'=>'134px')) !!}
                                        <div class="pick rem_product_2{{ $prod->id }}" style="display: none;"><img src="{{url('zizhub/img/picked_badge.png')}}"/><img class="mob" src="{{url('zizhub/img/items_mobile/Badge.png')}}"/></div>
                                    </div> 
                                        <!--  <a href="#">Tune</a><a href="#">Look</a><a href="#">Activate</a>
                                         <p>{{$prod->pname}}</p>      -->                                   
                                    <div>
                                    <div class="fileUpload add_val pick_product_2{{ $prod->id }}"  data_value="{{ $prod->id }}" data_disble="owl-demo_04"  data="product_2{{ $prod->id }}" id="pick_product_2{{ $prod->id }}">
                                        <span>                                            
                                            <img src="{{url('zizhub/img/cartrege.png')}}"/>
                                            <img class="mob" src="{{url('zizhub/img/items_mobile/cartrage.png')}}"/>                                               
                                        </span>Pick</div>
                                    </div>
                                    <div style="display:none;" id="rem_product_2{{ $prod->id }}" class="rem_product_2{{ $prod->id }}"">
                                        
                                        <div class="fileUpload pop_val" data_enable="owl-demo_04"  data_value="{{ $prod->id }}"  data="product_2{{ $prod->id }}"><span><img src="{{url('zizhub/img/cartrege_selected.png')}}"/><img class="mob" src="{{url('zizhub/img/items_mobile/cartrage_selected.png')}}"/></span>Remove</div>
                                     </div>
                                    </div>
                                @endforeach                   
                        </div> 
                             
                              <input type="hidden" id="product3">
                              <div id="pro3" style="display:none;text-align:center;">Please Pick A Ziz Art</div>
                         </div>
                    </div>
                </div>
               </div>
              
               <div class="row">
                <div class="zizpicArtist shipAddress ">
                    <div class="shiping_address">
                        <h3 class="zizpicArtist1"><span>{{ Lang::get( 'zizhub-lang.shipment_address' ) }}</span></h3>
                        <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.email') }}<span>*</span></label>                            
                            {!! Form::text('email', null, [ 'id' =>'email','class'=>($errors->first('email'))?"error validate-input":"validate-input", 'placeholder'=>Lang::get( 'zizhub-lang.email' )]) !!}
                              <span class="note">* {{ Lang::get( 'zizhub-lang.msg_beneath_email') }}</span>
                         </div>
                         <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.full_name') }}<span>*</span></label>                            
                            {!! Form::text('full_name', null, ['id'=>'full_name','class'=>($errors->first('full_name'))?"error validate-input ":"validate-input", 'placeholder'=>Lang::get( 'zizhub-lang.full_name' )]) !!}
                         </div>
                         <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.address') }} 1 <span>*</span></label>                            
                            {!! Form::text('address', null, ['id'=>'address','class'=>($errors->first('address'))?"error validate-input":"  validate-input", 'placeholder'=>Lang::get( 'zizhub-lang.address_placeholder' )]) !!}
                         </div>
                         <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.city') }}<span>*</span></label>
                            {!! Form::text('city', null, ['id'=>'city','class'=>'', 'placeholder'=>Lang::get( 'zizhub-lang.city' )]) !!}
                         </div>                            
                         <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.state') }}<span>*</span></label>                            
                            {!! Form::text('state', null, ['id'=>'state','class'=>'', 'placeholder'=>Lang::get( 'zizhub-lang.state_placeholder' )]) !!}
                         </div>
                         <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.zip') }}<span>*</span></label>
                            {!! Form::text('zip', null, ['id'=>'zip','class'=>'', 'placeholder'=>Lang::get( 'zizhub-lang.zip' )]) !!}
                         </div>
                         <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.country') }}<span>*</span></label>
                            {!! Form::text('country', null, ['id'=>'country','class'=>'', 'placeholder'=>Lang::get( 'zizhub-lang.country' )]) !!}
                         </div>
                         <div class="inptSec">
                            <label for="nm">{{ Lang::get( 'zizhub-lang.phone') }}#</label>
                            {!! Form::text('phone', null, ['id'=>'phone','class'=>($errors->first('phone'))?"error validate-input ":" validate-input", 'placeholder'=>Lang::get( 'zizhub-lang.phone' )]) !!}
                            <span class="note">* {{ Lang::get( 'zizhub-lang.for_delivery_use_only' ) }}</span>
                         </div>
                     </div>
                         
                         <div class="billing">
                            
                              <div class="billingCode">
                                <h3><span>{{ Lang::get( 'zizhub-lang.billing') }}</span></h3>
                                
                                <p class="footer_01">Ziz Code holders: Please submit your ZC number</p>
                                <img src="{{url('zizhub/images/zc.png')}}" alt="" class="footer_01"/>
                                
                                <img src="{{url('zizhub/img/items_mobile/ZC_Icon.png')}}" alt=""  class="footer_02"/>
                                
                                <p class="footer_02">Ziz Code holders:</p><p class="footer_02">Please submit your ZC number</p>
                                
                               <div class="codeInputSec">
                                    <input type="text" name="coupon_code" value="" id="ziz_code" placeholder="{{Lang::get( 'zizpic-lang.zizcode' )}}"/>                                     
                                    <input class="form-control coupon_id" id="zizcode" name="zizcode" type="hidden">                                    
                                    <input type="submit" id="submit"  value="{{Lang::get( 'zizpic-lang.submit' )}}" class="submit" />                                    
                                    <span class="coupon-msg"></span>
                               </div>
                               <div class="showcode"></div>
                              </div>
                              <div class="payment">
                                <h4>{{ Lang::get( 'zizpic-lang.payment') }}</h4>
                                   <div class="payInfo whiteBG">
                                    <span class="itemNm">3 {{ Lang::get( 'zizhub-lang.zizhubs') }}</span>
                                        <span class="itemPrice" id="itemPrice">{{ $prices_details['package_3'] }}
                                            @if(isset($lang) && $lang=='he') ₪ @endif 
                                            @if(isset($lang) && $lang=='en') $  @endif
                                        </span>                                       
                                        <input type="hidden" id="zizpic_1" value="{{ $prices_details['package_1'] }}">
                                          <input type="hidden" id="zizpic_3" value="{{ $prices_details['package_3'] }}">                                         
                                   </div>
                                   <div class="payInfo delivery">
                                    <span class="itemdeliver">{{ Lang::get( 'zizpic-lang.delivery') }}</span>
                                        <span class="itemPrice">{{ Lang::get( 'zizpic-lang.free') }}</span>

                                   </div>
                                   <div class="payInfo greenBG" id="discount" style="display:none;">
                                    <span class="itemNm">{{ Lang::get( 'zizpic-lang.zc') }}</span>
                                        <span class="itemPrice" id="show_discount"></span>                                        
                                        <input type="hidden" id="discount_price" value="">
                                   </div>
                                   <div class="payInfo total">
                                    <span class="itemTotal">{{ Lang::get( 'zizpic-lang.total') }}</span>
                                        <span class="itemPrice" id="itemTotal_price">{{ $prices_details['package_3'] }}
                                            @if(isset($lang) && $lang=='he') ₪ @endif 
                                            @if(isset($lang) && $lang=='en') $ @endif
                                        </span>
                                        <input type="hidden" name="total" id="total" value="{{ $prices_details['package_3'] }}">
                                        <input type="hidden" name="currency" id="currency" value="{!! $prices_details['currency'] !!}">
                                </div>
                                   
                              </div>
                              
                              
                         </div>
                         
                         <div class="billingType">
                                
                                        <div class="bt">
                                            <ul class="cards">
                                                <li><a href="javascript:void();"><img class="desk" src="{{url('zizhub/images/ax.png')}}" alt="" /><img class="mob" src="{{url('zizhub/img/items_mobile/american_express.png')}}" alt="" /></a></li>
                                                  <li><a href="javascript:void();"><img src="{{url('zizhub/images/master.png')}}" alt="" /></a></li>
                                                  <li><a href="javascript:void();"><img class="desk" src="{{url('zizhub/images/visa.png')}}" alt="" /><img class="mob" src="{{url('zizhub/img/items_mobile/Visa.png')}}" alt="" /></a></li>
                                             </ul>
                                        </div>
                                        <div class="bt">
                                            <a class="pay">                                                
                                                <button id="by_paypal_payment" class="btn btn-paypal by-paypal"></button>                                                
                                            </a>
                                        </div>
                                        <div id="by_phone" class="bt byPhone">
                                            <a href="javascript:void(0);">By Phone</a>
                                        </div>
                                        <div id="show_err" class="lucky"> Cannot proceed to Billing,<br>Please fill in mandatory fields above</div>
                                        <div class="ShowSec" style="margin-top: 22px;"  id="by-phone">
                                            <p class="leave_phn_num">Leave your phone number and we will call you for billing </p>
                                            <ul>
                                                <li>
                                                    {!! Form::text('phone_order', null, ['class'=>'phone_order ', 'placeholder'=>Lang::get( 'zizpic-lang.phone_number' )]) !!}
                                                    {!! Form::hidden('payment_method','',['id'=>'payment_method']) !!}
                                                </li>
                                                <li>
                                                    {!! Form::submit(Lang::get( 'zizpic-lang.submit_order' ), ['class'=>'btn btn-success','id'=>'form_submit']) !!}

                                                </li>
                                            </ul>
                                        </div>
                                   {!! Form::close() !!}
                              </div>
                         
                    </div>
               </div>
               
          </div>
 </div>    
    <script>
    var url="{!! url($lang.'/zizhuborders/zizcode') !!}";
    var token='{{ csrf_token() }}';
</script>

    @stop