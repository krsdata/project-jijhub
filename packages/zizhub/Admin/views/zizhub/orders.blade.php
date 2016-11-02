@extends('layouts.master')
@section('content')
<style>
table { border: 2px single black }
td { border: thin single black collapse }
</style>
<div class="content-wrapper">
@include('partials.sectionhead')
<section class="content">            
    <h3>Order Information</h3>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
            <th>Order Id</th>
            <th>Payment Method</th>
            <th>Order Status</th>
            <th>Package</th>
            <th>Price</th>
            <th>Currency</th>
            <th>Change Status</th>
            </tr>
        </thead>
        <tbody>
         <tr>
            <td style="border:5">{{  (!empty( $shiping_address[0][ 'id' ] ) ) ? $shiping_address[0][ 'id' ] : 'N/A' }}</td>
            <td style="border:5">{{  (!empty( $shiping_address[0][ 'payment_method' ] ) ) ? $shiping_address[0][ 'payment_method' ] : 'N/A' }}</td>
            <td  id="status">{{  (!empty( $shiping_address[0][ 'status' ] ) ) ? $shiping_address[0][ 'status' ] : 'N/A' }}</td>
            <td>{{  (!empty( $shiping_address[0][ 'package' ] ) ) ? $shiping_address[0][ 'package' ] : 'N/A' }}</td>
            <td>{{  (!empty( $shiping_address[0][ 'order_price' ] ) ) ? $shiping_address[0][ 'order_price' ] : 'N/A' }}</td>
            <td>{{  (!empty( $shiping_address[0][ 'currency' ] ) ) ? $shiping_address[0][ 'currency' ] : 'N/A' }}</td>
            <td>
                @foreach ( $results as $result )
                <div class="btn-group">
                    <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-expanded="false">Change status <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)" onclick="changezizhubStatus('Pending payment',{{ $result['id'] }})" >Pending payment</a></li>
                        <li><a href="javascript:void(0)" onclick="changezizhubStatus('Payment complete',{{ $result['id'] }})" >Payment complete</a></li>
                        <li><a href="javascript:void(0)" onclick="changezizhubStatus('Graphics',{{ $result['id'] }})" >Graphics</a></li>
                        <li><a href="javascript:void(0)" onclick="changezizhubStatus('Shipped',{{ $result['id'] }})" >Shipped</a></li>

                        <li class="divider"></li>

                    </ul>
                </div>
                @endforeach
            </td>
        </tr>            
        </tbody>
        </table>
        @if(( $shiping_address[0][ 'payment_method' ]!="phone" ))
        <p>Paypal Transaction Information</p>
        <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
            <th>Transaction ID</th>
            <th>Transaction Date</th>
            <th>Paypal Status</th>
            <th>Price</th>
            <th>Currency</th>            
            </tr>
        </thead>
        <tbody>
         <tr>
            <td>{{  (!empty( $results[0][ 'transaction_id' ] ) ) ? $results[0][ 'transaction_id' ] : 'N/A' }}</td>
            <td>{{  (!empty( $results[0][ 'date' ] ) ) ? $results[0][ 'date' ] : 'N/A' }}</td>
            <td>{{  (!empty( $results[0][ 'status' ] ) ) ? $results[0][ 'status' ] : 'N/A' }}</td>
            <td>{{  (!empty( $results[0][ 'amount' ] ) ) ? $results[0][ 'amount' ] : 'N/A' }}</td>
            <td>{{  (!empty( $results[0][ 'currency' ] ) ) ? $results[0][ 'currency' ] : 'N/A' }}</td>           
        </tr>            
        </tbody>
        </table>
        @endif
        <p>Zizhub Uploads</p>
        <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
            @if(!empty($products))                    
                @foreach($products as $pro)
                <div class="col-lg-3">                      
                <div class="form-control"  style="height: auto" >        
                    {!! $pro['name']!!} #{!! 100+(++$count_record) !!}              
                    <a class="thumbnail" href="javascript:void(0);">
                        {!! HTML::image('assets/product_image/'.$pro['image'],'',array('height' => '160px','width'=>'192px')) !!}
                    </a>   
                </div>
                </div>                              
                @endforeach
            @endif    
            </tr>
        </thead>
        </table>
        <div class="col-md-12 content::after buyer">
            <div class="form-control"><b> Buyer & Shipping Address : </b></div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                Full Name
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'full_name' ] ) ) ? $shiping_address[0][ 'full_name' ] : 'N/A' }}

            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                Email
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'email' ] ) ) ? $shiping_address[0][ 'email' ] : 'N/A' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                Phone
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'phone_order' ] ) ) ? $shiping_address[0][ 'phone_order' ] : 'N/A' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                Address
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'address' ] ) ) ? $shiping_address[0][ 'address' ] : 'N/A' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                City
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'city' ] ) ) ? $shiping_address[0][ 'city' ] : 'N/A' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                Zip
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'zip' ] ) ) ? $shiping_address[0][ 'zip' ] : 'N/A' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                State
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'state' ] ) ) ? $shiping_address[0][ 'state' ] : 'N/A' }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" >
                Country
            </div>
            <div class="col-md-2" >
                {{  (!empty( $shiping_address[0][ 'country' ] ) ) ? $shiping_address[0][ 'country' ] : 'N/A' }}
            </div>
        </div>
    </section>
</div>

@stop