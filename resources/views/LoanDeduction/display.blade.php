<table class="highlight">
    <thead>
        <tr>
            <th>NAME</th>
            <th>PRODUCT</th>
            <th>AMOUNT</th>
            <th>DUE</th>
            <th>HISTORY</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loanSub as $active)
        <tr>
            <td>
                <a href="/user/page/{{$active->user_id}}">{{$active->user->first_name}} {{$active->user->last_name}}</a>
            </td>
            <td>{{$active->product->name}}</td>
            <td>{{number_format($active->monthly_deduction,2,'.',',')}}</td>
            <td>
                {{$active->loan_end_date->toFormattedDateString()}}

            </td>
            <td><a href="/loanDeduction/history/{{$active->id}}">History</a></td>
        </tr>
        @endforeach
    </tbody>
</table>