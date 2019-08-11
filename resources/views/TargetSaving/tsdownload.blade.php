<table class="highlight">
    <thead>
        <tr>
            <th>S/NO</th>
            <th>SERVICE ID</th>
            <th>NAME</th>
            <th>USER ID</th>
            <th>AMOUNT</th>
            <th>DATE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ts as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->id}}</td>
            <td>{{$item->user->first_name}} {{$item->user->last_name}}</td>
            <td>{{$item->user_id}}</td>
            <td>{{$item->monthly_saving}}</td>
            <td>{{now()->toDateString()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>