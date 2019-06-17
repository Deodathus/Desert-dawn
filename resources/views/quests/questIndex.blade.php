
@extends('layouts.head')

@section('content')

    <div class="row">
        @foreach($quests as $quest)
            <div class="col-lg-12">
                {{ $quest->name }}
            </div>
        @endforeach
    </div>

@endsection
