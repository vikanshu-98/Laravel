<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ url('/exportUser') }}">
        @csrf
        <button style="padding:8px 5px;background-color: beige;">Exports</button>
    </form>
</body>
</html>