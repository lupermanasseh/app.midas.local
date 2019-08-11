<header class="header">
    {{-- logo --}}
    <img src="{{asset('images/logo.png')}}" alt="" class="logo"> {{-- search box --}}
    <form action="#" class="search">
        <input type="text" class="search__input" placeholder="Search User">
        <button class="search__button">
            <svg class="search__icon">
                <use xlink:href="{{asset('images/sprite.svg#icon-magnifying-glass')}}"></use>
            </svg>
        </button>
    </form>
    {{-- user nav --}}
    <nav class="user-nav">
        <div class="user-nav__icon-box">
            <svg class="user-nav__icon">
                <use xlink:href="{{asset('images/sprite.svg#icon-bookmark')}}"></use>
            </svg>
            <span class="user-nav__notification">7</span>
        </div>
        <div class="user-nav__icon-box">
            <svg class="user-nav__icon">
                <use xlink:href="{{asset('images/sprite.svg#icon-chat')}}"></use>
            </svg>
            <span class="user-nav__notification">13</span>
        </div>
        <div class="user-nav__user">
            <img src="{{asset('images/boy.png')}}" alt="user photo" class="user-nav__user-photo">
            <span class="user-nav__user-name">@if (Auth::check()){{auth()->user()->first_name}}@endif</span>


        </div>
    </nav>
</header>