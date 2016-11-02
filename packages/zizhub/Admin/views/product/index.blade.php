@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    @include('partials.sectionhead')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <!--{!! Form::model(['route' => ['zizhub/store'],'class'=>'form-horizontal']) !!}-->
                        {!! Form::open(array('url'=>"$lang/zizhub/store",'role'=>"form",'class'=>'form-signin','enctype'=>'multipart/form-data')) !!}
                            @include('packages::product.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    </section>
</div>
@stop
