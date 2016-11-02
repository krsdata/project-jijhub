<div class="row">
    <div class="form-group{{ $errors->first('name', ' has-error') }}">
        {!! Form::label('name', 'Name:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::hidden('hid', $data->id) !!}
            {!! Form::text('name',$data->name, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
            <span class="label label-danger">{{ $errors->first('name', ':message') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group{{ $errors->first('exp_date', ' has-error') }}">
        {!! Form::label('exp_date', 'Expiration Date:',['class'=>'col-sm-2 control-label','readonly'=>'readonly']) !!}
        <div class="col-md-4">
            {!! Form::text('exp_date',$data->exp_date, ['class'=>'form-control', 'placeholder'=>'Expiration date','id'=>'exp_date','readonly'=>'readonly']) !!}
            <span class="label label-danger">{{ $errors->first('exp_date', ':message') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group{{ $errors->first('used_limit', ' has-error') }}">
        {!! Form::label('usage_limit', 'Usage limit:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::text('used_limit', $data->used_limit, ['class'=>'form-control', 'placeholder'=>'Usage limit']) !!}
            <span class="label label-danger">{{ $errors->first('used_limit', ':message') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group{{ $errors->first('amount_usd', ' has-error') }}">
        {!! Form::label('amount_usd', 'Amount usd:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::text('amount_usd',  $data->amount_usd, ['class'=>'form-control', 'placeholder'=>'Amount usd']) !!}
            <span class="label label-danger">{{ $errors->first('amount_usd', ':message') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group{{ $errors->first('amount_nis', ' has-error') }}">
        {!! Form::label('amount_nis', 'Amount nis:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::text('amount_nis',$data->amount_nis, ['class'=>'form-control', 'placeholder'=>'Amount nis']) !!}
            <span class="label label-danger">{{ $errors->first('amount_nis', ':message') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group{{ $errors->first('package', ' has-error') }}">
        {!! Form::label('package', 'Package:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-md-4">
            {!! Form::select('package',  $package,$data->package, ['class'=>'form-control']) !!}
            <span class="label label-danger">{{ $errors->first('category_name', ':message') }}</span>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
        <input type="button" class="btn btn-primary" value="Back" onclick="return window.history.back();">
    </div>
</div>
