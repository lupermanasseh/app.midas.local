<figure class="review">
    <h5 class="review__heading">[ <a href='/Dashboard/myPendingLoans/{{auth()->id()}}'>{{$myPendingApp->count()}}</a> ]
        Pending
        Application(s)</h5>
    <blockquote class="review__text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, architecto.
    </blockquote>
    <figcaption class="review__user">
        <img src="{{asset('images/ternenge.jpg')}}" alt="review photo" class="review__photo">
        <div class="review__user-box">
            <p class="review__user-name">Ternenge Torough</p>
            <p class="review__user-date">Feb 23rd, 2019</p>
        </div>
        <div class="review__rating">
            7.9
        </div>
    </figcaption>
</figure>

<figure class="review">
    <h5 class="review__heading">All Paid <a href='/Dashboard/myPaidLoans/{{auth()->id()}}'>{{$paid->count()}}</a></h5>
    <blockquote class="review__text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, architecto.
    </blockquote>
    <figcaption class="review__user">
        <img src="{{asset('images/andy.jpg')}}" alt="review photo" class="review__photo">
        <div class="review__user-box">
            <p class="review__user-name">Shimakaa Iorlumun</p>
            <p class="review__user-date">Feb 23rd, 2019</p>
        </div>
        <div class="review__rating">
            9.9
        </div>
    </figcaption>
</figure>
{{-- <figure class="review">
    <h5 class="review__heading">All Paid <a href='/myPaidLoans/{{auth()->id()}}'>{{$paid->count()}}</a></h5>
<blockquote class="review__text">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, architecto.
</blockquote>
<figcaption class="review__user">
    <img src="{{asset('images/andy.jpg')}}" alt="review photo" class="review__photo">
    <div class="review__user-box">
        <p class="review__user-name">Shimakaa Iorlumun</p>
        <p class="review__user-date">Feb 23rd, 2019</p>
    </div>
    <div class="review__rating">
        9.9
    </div>
</figcaption>
</figure>

<button class="btn-inline">
    Show All <span>&rarr;</span>
</button> --}}