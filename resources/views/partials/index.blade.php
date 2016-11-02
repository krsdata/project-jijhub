@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    @include('partials.sectionhead')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">                        
                        @if (!empty($routes['create']) and empty($specifie_route))
                        <a href="{{route($routes['create'])}}" data-toggle="tooltip" class="create-btn pull-right" data-original-title="Create Item">
                            <div class="btn btn-primary pull-right"  >
                                <i class="fa fa-plus"></i>
                            </div>
                        </a>
                        @elseif (!empty($routes['create']) and !empty($specifie_route))
                        <a href="{{route($routes['create'])}}" data-toggle="tooltip" class="create-btn pull-right" data-original-title="Create Item">
                            <div class="btn btn-primary pull-right"  >
                                <i class="fa fa-plus"></i>
                            </div>
                        </a>    
                        @endif
                        @include('partials.grid')
                    </div>
                </div>
            </div>
    </section>
</div>
@stop



