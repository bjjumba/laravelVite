<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <link rel="stylesheet" href="{{  asset('./css/app.css') }}"/>
</head>
<body>
    <h1 class="text-3xl p-2 font-bold">Hello There</h1>
    <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
        @csrf
    <input type="file" name="excel_file"/>
    <button type="submit">
       Submit File
    </button>         
    </form>
</body>
</html>
