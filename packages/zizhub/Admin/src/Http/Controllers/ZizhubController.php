<?php

namespace Zizhub\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\View;
use Input;
use Validator;
use Auth;
use Paginate;
use Grids;
use HTML;
use Form;
use Mail;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;  
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TotalsRow;
use Nayjest\Grids\DbalDataProvider;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use App\Http\Controllers\Controller;
use Zizhub\Admin\Models\ProductCode;
use Zizhub\Admin\Models\CouponCode;  
use Zizhub\Admin\Models\Coupon;
use Zizhub\Admin\Models\ZizhubOrder;
use Zizhub\Admin\Http\Requests\ZizhubProductRequest;
use Zizhub\Admin\Http\Requests\ZizhubProductUpdateRequest; 
use Zizhub\Admin\Http\Requests\ZizhubCouponsRequest;
use Zizhub\Admin\Http\Requests\ZizhubOrderRequest;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper as Helper;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;

//use Inventory\Admin\Http\Requests\MetricRequest;

/**
 * Class MetricController
 */
class ZizhubController extends Controller {

     public function __construct( Request $request ) {
        //  $this->middleware( 'auth' );
        parent::__construct();

        $ln = $request->segment( 1 );
        $this->ln = $ln;
    }

    


    public function index( ZizhubOrder $zizhuborders ,Request $request ) {           
        $page_title = 'Create Zizhub';
        $prices = [
            'en' => [
                'package_1' => 22 ,
                'package_3' => 45 ,
                'shippment' => 5 ,
                'currency'  => 'USD' ] ,
            'he' => [
                'package_1' => 85 ,
                'package_3' => 180 ,
                'shippment' => 5 ,
                'currency'  => 'ILS' ] ,
        ];
        $lang = $this->ln;//$request->segment( 1 );
        $prices_details = $prices[ $request->segment( 1 ) ];

        Session::put( 'updated_price' , $prices_details[ 'package_3' ] );
        if ( $request->ajax() ) {
            Session::put( 'updated_price' , $prices_details[ 'package_3' ] );
            Session::put( 'updated_crrency' , $prices_details[ 'currency' ] );
            return Session::get( 'updated_price' );
        }

        $zizpic_price[ 'zizhub_order_1' ] = Config::get( 'app.zizhub_order_1' );
        $zizpic_price[ 'zizhub_order_3' ] = Config::get( 'app.zizhub_order_3' );
        $zizpic_price[ 'zizhub_delivery' ] = Config::get( 'app.zizhub_delivery' );
        $zizpic_price[ 'total_amount' ] = Config::get( 'app.zizpic_order_1' ) - Config::get( 'app.zizpic_delivery' );
        $zizhubproduct = ProductCode::orderBy( 'product_order' , 'asc' )->get();       
        return view( 'packages::zizhub.index', compact( 'zizhuborders' ,'zizhubproduct', 'lang' , 'page_title' , 'zizpic_price' , 'package' , 'prices_details' ) );
    }
    
    /*public function store()
    {        
        echo "Test";
        die;
    }*/
    
    public function store( ZizhubOrderRequest $request , ZizhubOrder $zizpicOrder ) {        
        $zizpicOrder->fill( Input::all() );
        $zizpicOrder->product_id = Input::get( 'products' );
        $zizpicOrder->package = Input::get( 'zizhubpackage' );
        $zizpicOrder->phone_order = Input::get( 'phone_order' );
        $zizpicOrder->order_price = Input::get( 'total' );
        $zizpicOrder->currency = Input::get( 'currency' );
        $zizpicOrder->package = 'Package-' . Input::get( 'zizhubpackage' );
        $zizpicOrder->status = "Pending payment";
        $zizpicOrder->payment_method = $request->get( 'payment_method' );
        $zizpicOrder->save();
        $input = Input::except( 'zizpic_1_image' , 'zizpic_2_image' , 'zizpic_3_image' );
        $zizcode = Input::get( 'zizcode' );

        if ( !empty( $zizcode ) ) {

            $code_used = ZizhubOrder::where( 'zizcode' , $zizcode )->groupBy( 'zizcode' )->count();
            $zizcodeObj = CouponCode::where( 'code' , $zizcode )->get();
            $total_code = CouponCode::where( 'copoun_id' , $zizcodeObj[ 0 ][ 'copoun_id' ] )->count();
            $CouponObj = Coupon::find( $zizcodeObj[ 0 ][ 'copoun_id' ] );
            $CouponObj->usage = $code_used . '/' . $total_code;
            $CouponObj->save();
        }
        
        if ( $request->get( 'payment_method' ) == 'phone' ) {           
            /********notification to admin*********/             
            $admin_email=Config::get( 'app.admin_email' );
            $user_name="Admin";                                
            Mail::send('packages::zizhub.mail', array('user'=>$user_name,'pkg'=>$zizpicOrder->package,'amount'=>Input::get( 'total' )),
                function($message) use ($admin_email,$user_name) {                   
                $message->to($admin_email , $user_name)->subject('Zizhub Order Notification');
            });
            /**********end code for admin notification**************/
        }
        if ( $request->get( 'payment_method' ) == 'paypal' ) {

            $amount = Input::get( 'amount' );

            $data = $this->postPayment( $input , $zizpicOrder->id );
            if ( intval( $amount ) < 0 ) {
                $msg = $data;
                return view( 'packages::zizhub.success' , compact( 'msg' ) );
            }
        }

        $msg = Lang::get( 'zizpic-lang.store_zizpic_msg' );
        return view( 'packages::zizhub.success' , compact( 'msg' ) );
    }
    /**
     * Displays the form for editing the specified metric.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function coupon( Request $request ) {

        $lang = $request->segment( 1 );

        $code = Input::get( 'ziz_code' );
        $pacakge_id = Input::get( 'package' );
        $status = 0;
        $current_date = date( 'Y-m-d' );
        $coupon_code = CouponCode::with( 'couponRelation' )->where( 'code' , $code )->get();

        if ( count( $coupon_code ) == 0 ) {
            return json_encode( array( 'amount' => 0 , 'status' => $status ) );
        }

        $used_limit = $coupon_code[ 0 ]->couponRelation[ 'used_limit' ];
        $amount_usd = $coupon_code[ 0 ]->couponRelation[ 'amount_nis' ];
        if ( $lang == 'en' ) {
            $amount_usd = $coupon_code[ 0 ]->couponRelation[ 'amount_usd' ];
        }

        $exp_date = $coupon_code[ 0 ]->couponRelation[ 'exp_date' ];
        $amount_nis = $coupon_code[ 0 ]->couponRelation[ 'amount_nis' ];
        $package = $coupon_code[ 0 ]->couponRelation[ 'package ' ];
        $coupon_id = $coupon_code[ 0 ]->couponRelation[ 'id' ];

        $coupon_used = "";
        if ( !empty( $exp_date ) ) {

            $package_check = Coupon::where( 'package' , '=' , "package-" . $pacakge_id )->where( 'exp_date' , '>=' , $current_date )->where( 'id' , $coupon_id )->get();

            if ( count( $package_check ) > 0 ) {
                $coupon_used = ZizhubOrder ::where( 'zizcode' , $coupon_code[ 0 ][ 'id' ] )->get();
            }
            else {
                $package_check = Coupon::where( 'exp_date' , '>=' , $current_date )->where( 'package' , '=' , "for_all_package" )->where( 'id' , $coupon_id )->get();
                if ( count( $package_check ) > 0 ) {
                    $coupon_used = ZizhubOrder ::where( 'zizcode' , $coupon_code[ 0 ][ 'id' ] )->get();
                }
            }
        }
        else {

            $package_check = Coupon ::where( 'package' , '=' , "package-" . $pacakge_id )->where( 'id' , $coupon_id )->get();
            if ( count( $package_check ) > 0 ) {
                $coupon_used = ZizhubOrder ::where( 'zizcode' , $coupon_code[ 0 ][ 'id' ] )->get();
            }
            else {
                $package_check = Coupon ::where( 'package' , '=' , "for_all_package" )->where( 'id' , $coupon_id )->get();
                if ( count( $package_check ) > 0 ) {
                    $coupon_used = ZizhubOrder ::where( 'zizcode' , $coupon_code[ 0 ][ 'id' ] )->get();
                }
            }
        }

        if ( count( $package_check ) > 0 ) {
            if ( $used_limit > count( $coupon_used ) ) {
                $status = $coupon_code[ 0 ][ 'code' ];
            }
        }

        return json_encode( array( 'amount' => $amount_usd , 'status' => $status ) );
    }
    public function postPayment( $input , $last_id ) {
        $params = array(
            'cancelUrl'   => url( $this->ln . '/payment/zizhubstatus' ) ,
            'returnUrl'   => url( $this->ln . '/payment/zizhubstatus' ) ,
            'name'        => 'package ' . $input[ 'zizhubpackage' ] ,
            'description' => 'zizhub order' , //
            'amount'      => number_format( $input[ 'total' ] , 2 ) , //
            'currency'    => $input[ 'currency' ] , //Input::get( 'currency' )
        );
        // echo "<pre>";
        // print_r($params);
        // die;

        Session::put( 'params' , $params );
        Session::save();
        Session::put( 'last_id' , $last_id );
        Session::save();
        // Input::replace( ['zizpic_1_image' => 'image_path' ] );
        // Input::replace( ['zizpic_2_image' => 'image_path' ] );
        // Input::replace( ['zizpic_3_image' => 'image_path' ] );

       // unset( $_FILES[ 'zizpic_1_image' ] , $_FILES[ 'zizpic_2_image' ] , $_FILES[ 'zizpic_3_image' ] );

        $gateway = Omnipay::create( 'PayPal_Express' );
        $gateway->setUsername( 'kundan.r-facilitator_api1.cisinlabs.com' );
        $gateway->setPassword( 'GRTW2DKMQKS82NAH' );
        $gateway->setSignature( 'AQTCtiLIx.MW.mJ18plFkwl5U3.5A4d51EVsgVhiEbZ7u3nf0PsZ430r' );
        $gateway->setTestMode( true );

        $response = $gateway->purchase( $params )->send();

        if ( $response->isSuccessful() ) {
            return $response;
        }
        elseif ( $response->isRedirect() ) {
            $response->redirect();
        }
        else {
            return $response->getMessage();
        }
    }

    public function getPaymentStatus() {

        $gateway = Omnipay::create( 'PayPal_Express' );
        $gateway->setUsername( 'kundan.r-facilitator_api1.cisinlabs.com' );
        $gateway->setPassword( 'GRTW2DKMQKS82NAH' );
        $gateway->setSignature( 'AQTCtiLIx.MW.mJ18plFkwl5U3.5A4d51EVsgVhiEbZ7u3nf0PsZ430r' );
        $gateway->setTestMode( true );
        $params = Session::get( 'params' );
        $response = $gateway->completePurchase( $params )->send();
        $paypalResponse = $response->getData(); // this is the raw response ob
        // storage/app/paypalEvent
        $last_id = Session::get( 'last_id' );
        Storage::append( 'paypalEvent.log' , 'order_id_' . $last_id . ':' . json_encode( $paypalResponse ) );
        Storage::disk( 'local' )->put( 'order_id_' . $last_id . 'log' , json_encode( $paypalResponse ) );


        $msg = Lang::get( 'zizpic-lang.success_msg_paypal' );        
        if ( isset( $paypalResponse[ 'ACK' ] ) && $paypalResponse[ 'ACK' ] == 'Success' ) {
            $orderObj = ZizhubOrder::find( $last_id );
            $orderObj->data = serialize( $paypalResponse );
            $orderObj->payment_method = 'paypal';
            $orderObj->save();
            /********notification to admin*********/
            $admin_email=Config::get( 'app.admin_email' );
            $user_name="Admin";                                
            Mail::send('packages::zizhub.mail', array('user'=>$user_name,'pkg'=>$params['name'],'amount'=>$params['amount']),
                function($message) use ($admin_email,$user_name) {                   
                $message->to($admin_email , $user_name)->subject('Zizhub Order Notification');
            });
            /**********end code for admin notification**************/            
            return view( 'packages::zizhub.success' , compact( 'msg' ) );
        }
        if ( isset( $paypalResponse[ 'ACK' ] ) && $paypalResponse[ 'ACK' ] == 'Failure' ) {
            $msg = 'Error : ' . $paypalResponse[ 'L_LONGMESSAGE0' ];
            $orderObj = ZizhubOrder::find( $last_id );
            $orderObj->payment_method = 'paypal';
            $orderObj->save();
            return view( 'packages::zizhub.success' , compact( 'msg' ) );
        }
        else {
            $msg = Lang::get( 'zizpic-lang.payment_failed_dueTo_connection' );
            return view( 'packages::zizhub.success' , compact( 'msg' ) );
        }
    }












}