@extends('Layouts.user')
@section('admin')
<h3>LOANS GUARANTEED</h3>
<table class="highlight">
    <thead>
        <tr>
            <th>REG</th>
            <th>MEMBER</th>
            <TH>PRODUCT</TH>
            <TH>LOAN BAL</TH>
            <TH>LIABILITY</TH>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
      @foreach($firstGuarantor as $firstg)
        <tr>
            <td>{{substr($firstg->user->membership_type,0,1)}}/{{$firstg->user_id}}</td>
            <td>{{$firstg->user->first_name}} {{$firstg->user->last_name}}</td>
            <td>{{$firstg->product->name}}</td>
            <td>{{number_format($firstg->user->singleLoanBalance($firstg->id),2,'.',',')}}</td>
            <td>{{number_format($firstg->user->singleLoanBalance($firstg->id)/2,2,'.',',')}}</td>
            <td>{{$firstg->loan_status}}
            </td>
        </tr>
        @endforeach
        @foreach($secondGuarantor as $secondg)
          <tr>
              <td>{{substr($secondg->user->membership_type,0,1)}}/{{$secondg->user_id}}</td>
              <td>{{$secondg->user->first_name}} {{$secondg->user->last_name}}</td>
              <td>{{$secondg->product->name}}</td>
              <td>{{number_format($secondg->user->singleLoanBalance($secondg->id),2,'.',',')}}</td>
              <td>{{number_format($secondg->user->singleLoanBalance($secondg->id)/2,2,'.',',')}}</td>
              <td>{{$secondg->loan_status}}
              </td>
          </tr>
          @endforeach
          @if(count($firstGuarantor)>=1 OR count($secondGuarantor)>=1 )
          <tr>
              <th colspan="3">Summary</th>

              <th>{{number_format($newSubObj->totalLiability($newUser->id),2,'.',',')}}</th>
              <th>{{number_format($newSubObj->totalLiability($newUser->id)*0.5,2,'.',',')}}</th>
          </tr>
          @else
          @endif
    </tbody>
</table>

@endsection
