<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Document</title>
</head>

<body>
    <div class="flex justify-center items-center mt-10">
        <div class="text-center">
            <img src="{{asset('images/logo.svg')}}" alt="logo" class="mx-auto">
            <a href="{{$emailContent}}" class="cursor-pointer mt-6 block">Clicca qui per eseguire il login</a>
        </div>
    </div>


</body>

</html>