<table class="highlight">
    <thead>
        <tr>
            {{-- <th>S/NO</th> --}}
            <th>IPPIS NO</th>
            <th>NAME</th>
            <th>SAVING</th>
            <th>TS</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($savings as $active)
        <tr>
            {{-- <td>{{$loop->iteration}}</td> --}}
            <td>{{$active->user->payment_number}}</td>
            <td>{{$active->user->first_name}} {{$active->user->last_name}}</td>
            <td>{{number_format($active->current_amount,2,'.',',')}}</td>
            <td>{{number_format($active->tsActiveAmount($active->user_id,$ts),2,'.',',')}}</td>
            <td>{{number_format($active->ippisSavingSum($active->current_amount,$active->tsActiveAmount      ($active->user_id,$ts)),2,'.',',')}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>