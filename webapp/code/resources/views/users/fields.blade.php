<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
</div>

<!-- Obs Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('obs', 'Obs:') !!}
    {!! Form::textarea('obs', null, ['class' => 'form-control', 'rows' => 5]) !!}
    @if ($errors->has('obs'))
                <span class="help-block">
                  <strong>{{ $errors->first('obs') }}</strong>
                </span>
              @endif
</div>

<!-- Img Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('img', 'Img:') !!}
    {!! Form::file('image', array('class' => 'image')) !!}
    @if ($errors->has('image'))
                <span class="help-block">
                  <strong>{{ $errors->first('image') }}</strong>
                </span>
              @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.show', $user) !!}" class="btn btn-default">Cancel</a>
</div>
