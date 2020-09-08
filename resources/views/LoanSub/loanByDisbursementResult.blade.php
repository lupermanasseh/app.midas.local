@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN BY DISBURSEMENT DATES</p>
        </div>
    </div>
    @if (count($loanByDate)>=1)
    <!-- <div class="row">
        <div class="col s12 m3 l3">
            <a href="/loanbalance/excel" class="btn">DOWNLOAD EXCEL</a>
        </div>
        <div class="col s12 m3 l3">
            <a href="/loanbalance/pdf/" target="_blank" class="btn">DOWNLOAND PDF</a>
        </div>
    </div> -->
    @else
    @endif
    <div class="row">
        <div class="col s12">
            @if (count($loanByDate)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>REG NO</th>
                        <th>NAME</th>
                        <th>IPPIS NO</th>
                        <th>LOAN AMOUNT</th>
                        <th>DATE</th>
                        <th>ACTION</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($loanByDate as $record)
                    <tr>
                        <td>{{substr($record->user->membership_type,0,1)}}/{{$record->user_id}}</td>
                        <td>{{$record->user->first_name}} {{$record->user->last_name}}</td>
                        <td>{{$record->user->payment_number}}</td>
                        <td>{{number_format($record->amount_approved,2,'.',',')}}</td>
                        <td>
                          @if($record->disbursement_date)
                          {{$record->disbursement_date}}
                          @else
                          Not Available
                          @endif</td>
                        <td>
                          <a class="waves-effect waves-light btn modal-trigger red darken-3 transferid" data-subid="{{$record->id}}" href="#modal1">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
<!-- Modal Structure -->
 <div id="modal1" class="modal">
   <div class="modal-content">
     <h6>EDIT DISBURSEMENT DATE</h6>
     <div class="row">
         <form class="col s12" method="POST" action="/edit/disbursementdate">
             {{ csrf_field() }}
             <div class="row">
               <div class="input-field col s12 m12 l12">
                 <input id="sub_id" name="sub_id" value="" type="hidden">
                   <input id="disbursement_date" name="disbursement_date" type="text" class="validate datepicker" required>
                   <label for="disbursement_date">Disbursement Date</label>
               </div>
             </div>
             <button type="submit" class="btn">Save Date</button>
         </form>
     </div>
   </div>
   <div class="modal-footer">
     <a class="modal-close waves-effect waves-green btn-flat">Close</a>
   </div>
 </div>
@endsection
