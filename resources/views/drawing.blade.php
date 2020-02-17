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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>
        let
            canvas = $('#canvas').get(0),
            ctx = canvas.getContext('2d');
        var
            isMouseDown = false,
            coords = [];

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        ctx.lineWidth = 5;

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
                coords.push([e.clientX, e.clientY]);

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

        function draw(e) {
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
                    };

                draw(e);
            }, 30);
        }
    </script>

</body>
</html>
