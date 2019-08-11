<table class="highlight">
    <thead>
        <tr>

            <th>S/NO</th>
            <th>IPPIS NUMBER</th>
            <th>NAME</th>
            <th>AMOUNT</th>
            <th>END DATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loanSub as $active)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$active->user->payment_number}}</td>
            <td><a href="/user/page/{{$active->user_id}}">{{$active->user->first_name}} {{$active->user->last_name}}</a>
            </td>
            <td>{{number_format($active->totalIppisDeductions($active->user_id,$activeLoans),2,'.',',')}}</td>
            {{-- <td>{{now()->addMonths(1)->toDateString()}}</td> --}}
            <td>{{$active->loanEndDate($active->user_id)->toFormattedDateString()}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>