@extends('admin.layouts.main')

@section('content')
    <b-row>
        <b-col cols="4">
            <data-card text-variant="white" bg-variant="primary" header="Users count">
                <i class="fas fa-user"></i> {{ $usersCount }}
            </data-card>
        </b-col>
        <b-col cols="4">
            <data-card text-variant="white" bg-variant="primary" header="Items count">
                <i class="fas fa-chess-knight"></i> {{ $itemsCount }}
            </data-card>
        </b-col>
        <b-col cols="4">
            <data-card text-variant="white" bg-variant="primary" header="Bosses count">
                <i class="fab fa-optin-monster"></i> {{ $bossesCount }}
            </data-card>
        </b-col>
    </b-row>
@endsection