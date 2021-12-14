@extends('layouts.app')

@section('title', $project->name)

@section('content')
  @include('partials.project', ['project' => $project])
@endsection
