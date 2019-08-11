<table class="highlight">
    <thead>
        <tr>
            <th>USER ID</th>
            <th>NAME</th>
            <th>DATE</th>
            <th>AMOUNT</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($savings as $active)
        <tr>
            <td>{{$active->user_id}}</td>
            <td>{{$active->user->first_name}} {{$active->user->last_name}}</td>
            <td>{{now()->toDateString()}}</td>
            <td>{{$active->current_amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>