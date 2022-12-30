<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <livewire:styles/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <livewire:scripts/>
</body>
    
</head>
<body>
    <div class="flex w-full justify-center">
        <div class="flex w-full justify-between px-4 bg-purple-900 text-white">
            <a class="mx-3 py-4" href="{{route("index")}}">Home</a>
            @if(!auth()->check())
                <livewire:logout/>
            @else
                <div class="py-4">
                    <a class="mx-3 py-4" href="{{route("login")}}">Login</a>
                    <a class="mx-3 py-4" href="{{route("register")}}">Register</a>
                </div>
            @endif
            
        </div>
    </div>
    <div class="flex justify-center">
        @yield('content')
    </div>
</body>
</html>