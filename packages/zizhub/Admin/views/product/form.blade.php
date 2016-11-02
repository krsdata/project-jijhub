<fieldset>
<div class="row">
    <div class="form-group{{ $errors->first('pname', ' has-error') }}">
        {!! Form::label('pname', 'Product Name:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::text('pname',null, ['class'=>'form-control', 'placeholder'=>'Product Name']) !!}
            <span class="label label-danger">{{ $errors->first('pname', ':message') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group{{ $errors->first('pname', ' has-error') }}">
        {!! Form::label('product_order', 'Product Order:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::text('product_order',null, ['class'=>'form-control', 'placeholder'=>'Product Order']) !!}
            <span class="label label-danger">{{ $errors->first('product_order', ':message') }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group{{ $errors->first('product_img', ' has-error') }}">
        {!! Form::label('product_img', 'Product Image:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::file('product_img',array('class'=>"filestyle","data-buttonName"=>"btn-primary")) !!}                    
            <span class="label label-danger">{{ $errors->first('product_img', ':message') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10" style="margin-top: 10px;">
            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}        
        </div>
    </div>
</div>
</fieldset>