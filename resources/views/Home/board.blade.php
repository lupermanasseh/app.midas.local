@extends('Layouts.app') 
@section('content')

<div class="container">
    <h1>Steering Committee</h1>
    <div class="row">

        <div class="col s12 m6 offset-m3">
            <div class="card horizontal">
                <div class="card-image">
                    <img src="{{asset('images/peteru.jpg')}}" class="responsive-img midas-cards">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <h5 class="header">Dr. Peteru Inunduh</h5>
                        <span class="grey-text">Chairman</span>
                        <p>Medical Director</p>
                    </div>
                    {{--
                    <div class="card-action teal accent-3">
                        <p><small class="pink-text darken-4"><i class="material-icons left">email</i> ashimakaa@gmail.com</small></p>
                        <p><small class="pink-text darken-4"><i class="material-icons left">call</i> +234 08063899921</small></p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
</div>


<div class="row">

    <div class="col s12 m3 l3">
        <div class="card">
            <div class="card-image">
                <img src="{{asset('images/orpin.jpg')}}" class="responsive-img midas-cards">

            </div>
            <div class="card-content">
                <span class="card-title">Mr. Manasseh Orpin</span>
                <h5 class="">Member</h5>
                <p>Director Finance
                </p>
            </div>
            {{--
            <div class="card-action">
                <p class="pink-text darken-4"><i class="material-icons left">email</i> sesden2003@gmail.com
                </p>
                <p class="pink-text darken-4"><i class="material-icons left">call</i> +234 08069401427</p>
            </div> --}}
        </div>
    </div>


    <div class="col s12 m3 l3">
        <div class="card">
            <div class="card-image">
                <img src="{{asset('images/joe.jpg')}}" class="responsive-img midas-cards">

            </div>
            <div class="card-content">
                <span class="card-title">Joseph Iorumbur, Igbawua, Ph.D</span>
                <h5>Member</h5>
                <p>Director Administration</p>
            </div>
            {{--
            <div class="card-action">
                <p class="pink-text darken-4"><i class="material-icons left">email</i> edigahfelicia@gmail.com
                </p>
                <p class="pink-text darken-4"><i class="material-icons left">call</i> +234 07035389822</p>
            </div> --}}
        </div>

    </div>
</div>


<div class="col s12 m3 l3">
    <div class="card">
        <div class="card-image">
            <img src="{{asset('images/mfe.jpg')}}" class="responsive-img midas-cards">

        </div>
        <div class="card-content">
            <span class="card-title">Mr. Mfe Inga</span>
            <h5>Member</h5>
        </div>
        {{--
        <div class="card-action">
            <p class="pink-text darken-4"><i class="material-icons left">email</i> ter4humanity@gmail.com
            </p>
            <p class="pink-text darken-4"><i class="material-icons left">call</i> +234 08065310831</p>
        </div> --}}
    </div>

    <div class="col s12 m3 l3">
        <div class="card">
            <div class="card-image">
                <img src="{{asset('images/enonche.jpg')}}" class="responsive-img">

            </div>
            <div class="card-content">
                <span class="card-title">Mrs. Patricia E. Enonche</span>
                <h5>Member</h5>

            </div>
            {{--
            <div class="card-action">
                <p class="pink-text darken-4"><i class="material-icons left">email</i>eronininneoma7@gmail.com
                </p>
                <p class="pink-text darken-4"><i class="material-icons left">call</i> +234 07067415598</p>
            </div> --}}
        </div>

    </div>
</div>

</div>
@endsection