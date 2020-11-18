@extends('Layouts.user')
@section('admin')
<p>LOAN DETAILS</p>
<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">PRODUCT DETAILS</p>
            <span>Product Name: {{$userLoan->product->name}}</span>
            <span>Tenor: {{$userLoan->product->tenor}} [ {{$userLoan->custom_tenor}} ]</span>
            <span>Amount Applied: {{number_format($userLoan->amount_applied,2,'.',',')}}</span>
            <span>Amount Approved: {{number_format($userLoan->amount_approved,2,'.',',')}}</span>
        </div>
    </div>
</div>

<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">PAYMENT SUMMARY</p>
            <span>Total Deductions: {{number_format($userLoan->totalLoanDeductions($userLoan->id),2,'.',',')}}</span>
            <span>Balance:
                {{number_format($userLoan->amount_approved-$userLoan->totalLoanDeductions($userLoan->id),2,'.',',')}}</span>

            <span>Repayment:
                {{number_format($userLoan->monthly_deduction,2,'.',',')}}</span>

        </div>
    </div>
</div>

<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">STATUS DETAILS</p>
            <span>Status: {{$userLoan->loan_status}}</span>
            <span>Due Date:
                {{$userLoan->loan_start_date->diffForHumans($userLoan->loan_end_date->toFormattedDateString())}}</span>
            <span>End Date:
                {{$userLoan->loan_end_date->toFormattedDateString()}}</span>
        </div>
    </div>
</div>

<div class="user-profiles">

    <div class="profile-detail">

        <div>
            <p class="review__rating">Loan Guarantors</p>
            <table>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>Payment#</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$userLoan->user->userInstance($userLoan->guarantor_id)->first_name}}
                            {{$userLoan->user->userInstance($userLoan->guarantor_id)->last_name}}
                        </td>
                        <td>{{$userLoan->user->userInstance($userLoan->guarantor_id)->payment_number}}
                        </td>
                        <td>{{$userLoan->user->userInstance($userLoan->guarantor_id)->phone}}
                        </td>
                    </tr>
                    <tr>
                        <td>{{$userLoan->user->userInstance($userLoan->guarantor_id2)->first_name}}
                            {{$userLoan->user->userInstance($userLoan->guarantor_id2)->last_name}}
                        </td>
                        <td>{{$userLoan->user->userInstance($userLoan->guarantor_id2)->payment_number}}
                        </td>
                        <td>{{$userLoan->user->userInstance($userLoan->guarantor_id2)->phone}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
