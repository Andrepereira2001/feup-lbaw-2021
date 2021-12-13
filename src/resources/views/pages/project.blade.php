@extends('layouts.app')

@section('title', $project->name)

@section('project')
  @include('partials.project', ['project' => $project])
@endsection
