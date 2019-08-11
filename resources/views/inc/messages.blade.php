<div class="row">

    <div class="col s12 m8 offset-m2 l6 offset-l3">
        @if(count($errors)>0) @foreach ($errors->all() as $error)
        <p class="red-text darken-3">{{$error}}</p>
        @endforeach @endif
    </div>
    {{-- @if (session('success'))
    <div class="col s12 green">{{session('success')}}</div>
    @endif --}} {{-- @if (session('error'))
    <div class="col s12 red lighten-3">
        {{session('error')}}
    </div>
    @endif --}}
</div>

{{-- @if ($flash = session('message'))
<div class="row">

    <div class="col s12 m8 offset-m2 l6 offset-l3">
        <p class="green-text accent-3">{{$flash}}</p>
    </div>


    {{--
    <div id='f-message'>
        <p class="green accent-3">{{$flash}}</p>
    </div> --}} {{-- </div>

@endif --}}