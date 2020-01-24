<table class="highlight">
    <thead>
        <tr>
            {{-- <th>S/NO</th> --}}
            <th>IPPIS NO</th>
            <th>NAME</th>
            <th>SAVING</th>
            <th>TS</th>
            <th>DATE</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($savings as $active)
        <tr>
            {{-- <td>{{$loop->iteration}}</td> --}}
            <td>{{$active->user->payment_number}}</td>
            <td>{{$active->user->last_name}} {{$active->user->first_name}}</td>
            <td>{{$active->current_amount}}</td>
            <td>{{$active->tsActiveAmount($active->user_id)}}</td>
            <td>{{now()->toDateString()}}</td>
            <td>{{$active->current_amount + $active->tsActiveAmount($active->user_id)}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>