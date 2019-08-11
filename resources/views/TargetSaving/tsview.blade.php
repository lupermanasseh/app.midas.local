<table class="highlight">
    <thead>
        <tr>
            <th>SERVICE ID</th>
            <th>NAME</th>
            <th>USER ID</th>
            <th>AMOUNT</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ts as $item)
        <tr>
            {{-- <td>{{$loop->iteration}}</td> --}}
            <td>{{$item->id}}</td>
            <td>{{$item->user->first_name}} {{$item->user->lastname_name}}</td>
            <td>{{$item->user_id}}</td>
            <td>{{number_format($item->monthly_saving,2,'.',',')}}</td>
            <td>{{now()->toDateString()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>