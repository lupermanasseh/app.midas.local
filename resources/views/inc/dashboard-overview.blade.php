<div class="overview">
    <h6 class="overview__heading">
        <a href="/Dashboard/user/savings" class="overview__savings">Closing {{number_format($totalSaving,2,'.',',')}}</a>
    </h6>
    <span><svg class="overview__icon-star">
            <use xlink:href="{{asset('images/sprite.svg#icon-chevron-with-circle-left')}}"></use>
        </svg>
    </span>
    <h6 class="overview__heading overview__push">{{now()->toFormattedDateString()}}</h6>

    {{--
        <div class="overview__stars">
            <svg class="overview__icon-star">
                <use xlink:href="{{asset('images/sprite.svg#icon-pin')}}"></use>
    </svg>
    <svg class="overview__icon-star">
        <use xlink:href="{{asset('images/sprite.svg#icon-pin')}}"></use>
    </svg>
    <svg class="overview__icon-star">
        <use xlink:href="{{asset('images/sprite.svg#icon-pin')}}"></use>
    </svg>
    <svg class="overview__icon-star">
        <use xlink:href="{{asset('images/sprite.svg#icon-pin')}}"></use>
    </svg>
    <svg class="overview__icon-star">
        <use xlink:href="{{asset('images/sprite.svg#icon-pin')}}"></use>
    </svg>
</div> --}} {{-- NO LONGER IN USE --}} {{--
        <div class="overview__location">
            <svg class="overview__icon-location">
                <use xlink:href="{{asset('images/sprite.svg#icon-location-pin')}}"></use>

</svg>
<button class="btn-inline">link me to somewhere</button>
</div> --}}

<div class="overview__rating">
    <div class="overview__rating-average"><a href="" class="overview__link">N
            {{number_format($liability,2,'.',',')}}
    </a>
</div>
<div class="overview__rating-count">Liability</div>
<div class="overview__rating-count">{{now()->toDateString()}}</div>
</div>
</div>
