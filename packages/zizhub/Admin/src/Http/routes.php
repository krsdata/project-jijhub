<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

// Get our languages (previously described in this post)
// Get the first segment of our route, which should be our locale.. 
$locale = Request::segment( 1 );


Route::group( [ 'prefix' => $locale ] , function () {
    
    Route::get('zizhub/product', array('as' => 'zizhub/product', 'uses' => 'Zizhub\Admin\Http\Controllers\ProductController@index'));
    Route::post('zizhub/store', array('as' =>  'zizhub/store', 'uses' => 'Zizhub\Admin\Http\Controllers\ProductController@store_product'));//
    Route::get('zizhub/productlist', array('as' => 'zizhub/productlist', 'uses' => 'Zizhub\Admin\Http\Controllers\ProductController@productlist'));
    Route::get('zizhub/edit/{id}', array('as' => 'edit/{id}', 'uses' => 'Zizhub\Admin\Http\Controllers\ProductController@productEdit'));
    Route::post('zizhub/update', array('as' =>  'zizhub/update', 'uses' => 'Zizhub\Admin\Http\Controllers\ProductController@updateProduct'));//        
    
    Route::post('zizhuborders/zizcode', array('as' =>  'zizhub/zizcode', 'uses' => 'Zizhub\Admin\Http\Controllers\ZizhubController@coupon'));//    
    Route::get( 'zizhub/changeOrderStatus' , 'Zizhub\Admin\Http\Controllers\ZizhubTransactionController@changeOrderStatus' );
    /************zizhub order***********/    
    Route::bind( 'ZizhubOrder' , function($value , $route) {
        return Zizhub\Admin\Models\ZizhubOrder::find( $value );
    } );

    Route::resource( 'zizhuborders' , 'Zizhub\Admin\Http\Controllers\ZizhubController' , [
        'names' => [            
            'store'   => 'zizhuborders.store' , 
            'index'   => 'zizhuborders' ,
            
        ]
            ]
    );


    Route::bind( 'zizhubtransactions' , function($value , $route) {        
        return Zizhub\Admin\Models\ZizhubOrder::find( $value );
    } );

    Route::resource( 'zizhub/zizhubtransactions' , 'Zizhub\Admin\Http\Controllers\ZizhubTransactionController' , [
        'names' => [
            'edit'    => 'zizhubtransactions.edit' ,
            'show'    => 'zizhubtransactions.show' ,
            'destroy' => 'zizhubtransactions.destroy' ,
            'update'  => 'zizhubtransactions.update' ,
            'store'   => 'zizhubtransactions.store' ,
            'index'   => 'zizhubtransactions' ,
            'create'  => 'zizhubtransactions.create' ,
        ]
            ]
    );


/*********coupon**********/
   
    Route::bind( 'coupons' , function($value , $route) {        
        return Zizhub\Admin\Models\Coupon::find( $value );
    } );
    
    Route::resource( 'zizhub/coupons' , 'Zizhub\Admin\Http\Controllers\CopounsController' , [
        'names' => [
            'edit'    => 'coupons.edit' ,
            'show'    => 'coupons.show' ,
            'destroy' => 'coupons.destroy' ,
            'update'  => 'coupons.update' ,
            'store'   => 'coupons.store' ,
            'index'   => 'coupons.index' ,
            'create'  => 'coupons.create' ,
        ]
            ]
    );

/*********end coupon***************/





Route::get( 'zizhub/payment' , array(
        'as'   => 'payment' ,
        'uses' => 'Zizhub\Admin\Http\Controllers\ZizhubController@postPayment' ,
    ) );

// this is after make the payment, PayPal redirect back to your site
    Route::get( 'payment/zizhubstatus' , array(
        'as'   => 'payment.status' ,
        'uses' => 'Zizhub\Admin\Http\Controllers\ZizhubController@getPaymentStatus' ,
    ) );



} );
