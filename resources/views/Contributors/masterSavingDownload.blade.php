<table class="highlight">
    <thead>
        <tr>
            <th>REG NO</th>
            <th>NAME</th>
            <th>IPPIS NO</th>
            <th>MEMBER TYPE</th>
            <th>CLOSING DATE</th>
            <th>BALANCE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($uniqueContributors as $listing)
        <tr>
            <td>{{$listing->user_id}}</td>
            <td>{{$listing->user->first_name}} {{$listing->user->last_name}}</td>
            <td>{{$listing->user->payment_number}}</td>
            <td>{{$listing->user->membership_type}}</td>
            <td>{{$to}}</td>
            <td>{{$listing->userAggregateAt($savingsCollection,$listing->user_id)}}
            </td>
        </tr>
        @endforeach
        <tr>
            <th colspan="5">Summary</th>
            <th>{{number_format($saving->savingAggregateAt($to),2,'.',',')}}</th>
        </tr>
    </tbody>
</table>