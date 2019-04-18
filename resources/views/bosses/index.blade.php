<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Bosses</title>
</head>
<body>

    <div class="bosses container">
        @foreach($bosses as $boss)
            <div class="boss-block" style="margin-top: 10px;">
                <a href="{{ route('boss.show', $boss->id) }}">{{ $boss->name }}</a>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-4 col-md-4">
                        <p><i class="far fa-heart"></i> {{ $boss->hp }}</p>
                        <p><i class="fas fa-shield-alt"></i> {{ $boss->armor }}</p>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <p><i class="fas fa-coins"></i> {{ $boss->reward_gold }}</p>
                        <p><i class="fas fa-angle-double-up"></i> {{ $boss->reward_exp }}</p>
                    </div>
                    <div class="col-lg-4 col-lg-4">
                        <button class="btn btn-danger" style="margin-top: 5%">Attack!</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>