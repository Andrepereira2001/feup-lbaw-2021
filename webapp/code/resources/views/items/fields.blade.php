<!-- Id Work Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_work', 'Id Work:') !!}
    {!! Form::number('id_work', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_location', 'Id Location:') !!}
    {!! Form::number('id_location', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::number('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('items.index') !!}" class="btn btn-default">Cancel</a>
</div>
