@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Work
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'works.store']) !!}

                        @include('works.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
