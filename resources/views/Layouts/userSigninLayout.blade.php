<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?famaily=Open+Sans:300,400,600">
    <link rel="stylesheet" href="{{asset('css/portal.css')}}">
    <title>{{$title}}</title>
</head>

<body>
    <div class="midas-container">
        {{-- Inlcude header section --}}
        @include('inc.usersignin-header')
        {{-- midas main content container --}}
        <div class="midas-content">

            <main class="midas-view">


                <div class="detail">
                    {{-- description section --}}
                    <div class="description">
                        {{-- dynamic content here --}}
                        @yield('user-signin')

                    </div>


                </div>

            </main>

        </div>
    </div>

    {{-- @yield('admin') --}}
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>