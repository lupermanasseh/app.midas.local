<table class="highlight">
    <thead>
        <tr>
            <th colspan="6">MIDAS TOUCH MULTIPURPOSE COOPERATIVE SOCIETY LTD</th>
        </tr>
        <tr>
            <th colspan="6">FEDERAL MEDICAL CENTER, MAKURDI</th>
        </tr>
        <tr>
            <th colspan="6">LOAN LIABILITY REPORT AS AT {{$to}}</th>
        </tr>
        <tr>
          <th>REG NO</th>
          <th>NAME</th>
          <th>IPPIS NO</th>
          <th>CLOSING DATE</th>
          <th>BALANCE</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($uniqueDebtors as $listing)
      <tr>
          <td>{{substr($listing->user->membership_type,0,1)}}/{{$listing->user_id}}</td>
          <td>{{$listing->user->first_name}} {{$listing->user->last_name}}</td>
          <td>{{$listing->user->payment_number}}</td>
          <td>{{$to}}</td>
          <td>{{$listing->allLoanBalancesByDate($loanDeductionCollection,$listing->user_id)}}
          </td>
      </tr>
      @endforeach
      @if (count($uniqueDebtors)>=1)
      <tr>
          <th colspan="4">Total</th>
          <th>{{number_format($subObj->loanBalanceAggregateAt($loanDeductionCollection),2,'.',',')}}</th>
      </tr>
      @else
      @endif
    </tbody>
</table>
