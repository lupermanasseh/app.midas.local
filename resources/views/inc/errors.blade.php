@if(count($errors))
<div>
    <ul>
        @foreach ($error->all() as $error)
        <li>
            {{$error}}
        </li>

        @endforeach
    </ul>
</div>