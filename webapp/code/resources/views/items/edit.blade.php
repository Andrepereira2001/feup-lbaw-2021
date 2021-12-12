@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Item
        </h1>
   </section>
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($item, ['route' => ['items.update', $item->id], 'method' => 'patch']) !!}

                        @include('items.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
   {!! Form::open(['route' => 'items.store']) !!}

@include('items.fields')

{!! Form::close() !!}
@endsection