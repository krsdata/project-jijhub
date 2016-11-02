@extends('layouts.master')
@section('content')
<style>
table { border: 2px single black }
td { border: thin single black collapse }
</style>
<div class="content-wrapper">
@include('partials.sectionhead')
<section class="content">            
    <p>Order Information</p>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
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
                        <li><a href="javascript:void(0)" onclick="changeStatus('Pending payment',{{ $result['id'] }})" >Pending payment</a></li>
                        <li><a href="javascript:void(0)" onclick="changeStatus('Payment complete',{{ $result['id'] }})" >Payment complete</a></li>
                        <li><a href="javascript:void(0)" onclick="changeStatus('Graphics',{{ $result['id'] }})" >Graphics</a></li>
                        <li><a href="javascript:void(0)" onclick="changeStatus('Shipped',{{ $result['id'] }})" >Shipped</a></li>

                        <li class="divider"></li>

                    </ul>
                </div>
                @endforeach
            </td>
        </tr>            
        </tbody>
        </table>
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
        <?php 
        //echo "<pre>";
        //print_r($shiping_address[0]['name']);
        //die;
        ?>
        
        <p>ZIzpic Artist: {{  (!empty( $shiping_address[0][ 'name' ] ) ) ? $shiping_address[0][ 'name' ] : 'N/A' }}</p>
        <p>Zizpic Uploads</p>
        <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
            @if(!empty( file_exists(ltrim($shiping_address[0][ 'zizpic_1_image' ],'/')) ) )               
                <div class="col-lg-3">                      
                <div class="form-control"  style="height: auto" >  
                zizpic # {!! (100+($count_record+1)) !!}                    
                    <a class="thumbnail" href="javascript:void(0);">
                        <img class="img-responsive" src="{{ $shiping_address[0][ 'zizpic_1_image' ] }}" alt=""  width="100%" height="100%" >
                    </a>   
                </div>
                </div>                                              
            @endif    
            </tr>
             <tr>
            @if(!empty( file_exists(ltrim($shiping_address[0][ 'zizpic_2_image' ],'/')) ) )               
                <div class="col-lg-3">                      
                <div class="form-control"  style="height: auto" > 
                zizpic # {!! (100+($count_record+2)) !!}                           
                    <a class="thumbnail" href="javascript:void(0);">
                        <img class="img-responsive" src="{{ $shiping_address[0][ 'zizpic_2_image' ] }}" alt=""  width="100%" height="100%" >
                    </a>   
                </div>
                </div>                                              
            @endif    
            </tr>
             <tr>
            @if(!empty( file_exists(ltrim($shiping_address[0][ 'zizpic_3_image' ],'/')) ) )               
                <div class="col-lg-3">                      
                <div class="form-control"  style="height: auto" >   
                zizpic # {!! (100+($count_record+3)) !!}                         
                    <a class="thumbnail" href="javascript:void(0);">
                        <img class="img-responsive" src="{{ $shiping_address[0][ 'zizpic_3_image' ] }}" alt=""  width="100%" height="100%" >
                    </a>   
                </div>
                </div>                                              
            @endif    
            </tr>
        </thead>        
        </table>        
        <div class="col-md-12 ">
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