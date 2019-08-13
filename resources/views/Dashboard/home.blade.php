@extends('Layouts.user')
@section('admin')


<p class="paragraph">MY ACTIVITY</p>
<div>
    {!! $footPrints->container() !!}
</div>
{{-- <p class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, velit nemo! Aperiam cum
    reprehenderit
    unde velit dolorum minima? Cum repellat enim assumenda eaque quasi eveniet nulla mollitia accusamus
    libero similique?
</p>

<ul class="list">
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
    <li class="list__item">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
</ul> --}}
@endsection