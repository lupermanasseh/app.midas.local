<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?famaily=Open+Sans:300,400,600">
    <link rel="stylesheet" href="{{asset('css/portal.css')}}">
    <title>MIDAS- User Dashboard:: {{$title}}</title>
</head>

<body>
    <div class="midas-container">
        {{-- Inlcude header section --}}
        @include('inc.dashboard-header')
        {{-- midas main content container --}}
        <div class="midas-content">
            {{-- sidebar conatiner --}}
            @include('inc.dashboard-sidebar')
            {{-- main content area --}}
            <main class="midas-view">
                {{-- overview panel --}}
                @include('inc.dashboard-overview')
                @include('inc.dashboard-search')
                {{-- detail content --}}
                <div class="detail">
                    {{-- description section --}}
                    <div class="description">
                        {{-- dynamic content here --}}
                        @yield('admin')

                        <div class="recommend">
                            {{-- @include('inc.dashboard-recommend') --}}
                        </div>
                    </div>
                    {{-- user rieview section --}}
                    {{-- <div class="user-reviews">
                        @include('inc.dashboard-userreviews')
                    </div> --}}

                </div>
                {{-- cta section --}}
                <div class="cta">
                    @include('inc.dashboard-cta')
                </div>
            </main>

        </div>
    </div>

    {{-- @yield('admin') --}}
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset( 'js/echarts.min.js')}} "></script>
    {{-- @isset($footPrints)
    {!! $footPrints->script() !!}
    @endisset --}}

</body>

</html>