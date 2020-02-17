<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drawing lesson</title>
</head>
<body style="margin: 0">

    <canvas id="canvas" style="display: block">
        Hello world
    </canvas>

    <div class="hotkeys" style="top: 10px;right: 5px;position: absolute;">
        <div>Hotkeys:</div>
        <div>S - Save</div>
        <div>C - Clear</div>
        <div>R - Redraw last from saved</div>
    </div>

    <div class="panel" style="margin: 10px; text-align: center">
        @foreach($colors as $color)
            <a class="color-a" href="?color={{ $color }}" style="height: 25px;width: 25px;background-color: {{ $color }};display: inline-block;"></a>
        @endforeach
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>
        var color = localStorage.getItem('color') ? localStorage.getItem('color') : 'black';

        let
            canvas = $('#canvas').get(0),
            ctx = canvas.getContext('2d'),
            isMouseDown = false,
            coords = [];

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight - 50;

        ctx.lineWidth = 5;

        $("a[class='color-a']").click((e) => {
            e.preventDefault();

            window.history.pushState(e.target.href, 'Drawing lesson', e.target.href);

            localStorage.setItem('color', new URLSearchParams(window.location.search).get('color'));
        });

        function getColor()
        {
            return localStorage.getItem('color');
        }

        $(window).mouseup(() => {
            coords.push('keyup');

            ctx.beginPath();
            isMouseDown = false;
        });

        $(window).mousedown(() => {
            isMouseDown = true;
        });

        $(window).mousemove((e) => {
            if (isMouseDown) {
                coords.push([e.clientX, e.clientY, localStorage.getItem('color')]);

                draw(e);
            }
        });

        $(window).keydown((e) => {
            // c
            if (67 === e.keyCode) {
                clear();
            }

            // s
            if (83 === e.keyCode) {
                save();
            }

            // r
            if (82 === e.keyCode) {
                redraw();
            }
        });

        function draw(e, color = null) {
            ctx.fillStyle = color ? color : getColor();
            ctx.strokeStyle = color ? color : getColor();

            ctx.lineTo(e.clientX, e.clientY);
            ctx.stroke();

            ctx.beginPath();
            ctx.arc(e.clientX, e.clientY, 2.5, 0, Math.PI * 2);
            ctx.fill();

            ctx.beginPath();
            ctx.moveTo(e.clientX, e.clientY);
        }

        function clear() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function save() {
            localStorage.removeItem('coords');
            localStorage.setItem('coords', JSON.stringify(coords));
        }

        function redraw() {
            coords = JSON.parse(localStorage.getItem('coords'));

            let timer = setInterval(() => {
                if (! coords.length) {
                    clearInterval(timer);
                    ctx.beginPath();

                    return;
                }

                var crd = coords.shift(),
                    e = {
                        clientX: crd["0"],
                        clientY: crd["1"]
                    },
                    color = crd["2"];

                draw(e, color);
            }, 30);
        }
    </script>

</body>
</html>
