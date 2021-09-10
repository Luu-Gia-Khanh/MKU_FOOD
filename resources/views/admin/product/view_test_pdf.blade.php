<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'iskpota';
            src: url('{{public_path()}}/fonts/your-font.ttf') format('truetype')
        }
        body{
            font-family: 'your-font', sans-serif;
        }
    </style>
</head>
<body>
    @foreach ($data as $d)
        <p>{{ $d->product_name }}</p>
    @endforeach
</body>
</html>
