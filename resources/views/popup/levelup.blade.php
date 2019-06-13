
@extends('layouts.head')

@section('content')

    <div class="level-up-section text-center">
        <h1>{{ Auth::user()->level }} Level Up!</h1>
        <a href="{{ route('boss.index') }}" class="btn btn-primary">Boss Page</a>
    </div>

@endsection
