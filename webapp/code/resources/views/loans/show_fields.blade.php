<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $loan->id !!}</p>
</div>

<!-- Id Item Field -->
<div class="form-group">
    {!! Form::label('id_item', 'Id Item:') !!}
    <p>{!! $loan->id_item !!}</p>
</div>

<!-- Id User Field -->
<div class="form-group">
    {!! Form::label('id_user', 'Id User:') !!}
    <p>{!! $loan->id_user !!}</p>
</div>

<!-- Start Field -->
<div class="form-group">
    {!! Form::label('start', 'Start:') !!}
    <p>{!! $loan->start !!}</p>
</div>

<!-- End Field -->
<div class="form-group">
    {!! Form::label('end', 'End:') !!}
    <p>{!! $loan->end !!}</p>
</div>

