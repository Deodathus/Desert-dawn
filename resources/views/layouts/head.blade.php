<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/app.css">
        <title>Desert Dawn</title>
    </head>

    <body>
@if(Auth::user())
    <div class="container-fluid user-bar fixed-top">
        <div class="row user-row-info">
            <div class="col-md-2">
                <i class="fas fa-signature"></i>
                {{ Auth::user()->name }}
            </div>
            <div class="col-md-2">
                <i class="fas fa-fist-raised"></i>
                {{ Auth::user()->level }}
            </div>
            <div class="col-md-2">
                <i class="fas fa-angle-double-up"></i>
                {{ Auth::user()->exp }}
            </div>
            <div class="col-md-2">
                <i class="fas fa-bolt"></i>
                {{ Auth::user()->energy }}
            </div>
            <div class="col-md-2">
                <i class="fas fa-coins"></i>
                {{ Auth::user()->coins }}
                <i class="far fa-gem"></i>
                {{ Auth::user()->gems }}
            </div>
        </div>
    </div>
    @endif

@yield('content')

    </body>

        <div class="footer fixed-bottom text-center">
            <a href="{{ route('user.hero') }}"><i class="fas fa-store-alt fa-3x"></i></a>
            <a href=""><i class="fas fa-store fa-3x"></i></a>
            <a href="{{ route('boss.index') }}"><i class="fas fa-khanda fa-3x"></i></a>
        </div>

</html>
