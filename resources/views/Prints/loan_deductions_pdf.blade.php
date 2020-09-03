<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?famaily=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/printpdf.css">
    <title></title>
</head>

<body>
    <div class="midas-container">
        {{-- <header class="header">
            <section class="midas-item-container">
                <img src="images/logo2.png" alt="" class="logo">
                <div class="midas-item-wrapper">
                    <p class="profile-item">1 Hospital Road, Mission Ward</p>
                    <p class="profile-item">Makurdi, Benue State</p>
                    <p class="profile-item">mindastouch@gmail.com</p>
                    <p class="profile-item">www.midastouchonline.co</p>
                    <p class="profile-item">+234 81-1890-1411</p>
                </div>
            </section>
            <section class="statement-notification">
                <span class="profile-name">Period</span>
                {{-- <span class="profile-item">From: {{$from}}</span>
        <span class="profile-item">To: {{$to}}</span>
        </section>
        </header> --}}
        <section class="print-area">

            <table style=" border:0;">
                <tbody>
                    <tr>
                        <td style="width:20%; border:0;"><img src="images/logo2.png" alt="" class="logo">
                        </td>
                        <td align="left" style="width:16%; border:0;">

                            <span>
                                <br />
                                1 Hospital Road, Mission Ward<br />
                                Makurdi, Benue State<br />
                                mindastouch@gmail.com<br>
                                www.midastouchonline.co<br>
                                +234 81-1890-1411<br>
                            </span>
                        </td>
                        <td style=" border:0;">

                        </td>
                        <td style=" border:0;"></td>
                        <td align="left" style=" border:0;">
                            {{-- <span class="profile-name">PERIOD</span><br />
                            <span>From: {{$from}}</span><br />
                            <span>To: {{$to}}</span><br /> --}}
                            <span>Date Printed: {{now()->toFormattedDateString()}}</span><br />
                        </td>
                    </tr>

                </tbody>
            </table>
        </section>

        <section>
            <h4 class="statement-title">LOAN DEDUCTION HISTORY</h4>
        </section>


        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:40%; border:0;">

                            <span>
                                <br />
                                Name: {{$loan->user->first_name}} {{$loan->user->last_name}}
                                <br />
                                Reg No: {{$loan->user->membership_type}}/{{$loan->user->id}}<br />
                                Loan Type: {{$loan->product->name}}<br>
                                Interest Rate: {{$loan->product->interest*100}}%<br>
                                Interest:
                                {{number_format($loan->product->interest*$loan->amount_approved,2,'.',',')}}<br>
                                <br />

                            </span>
                        </td>
                        <td style=" border:0;">

                        </td>
                        <td style=" border:0;"></td>
                        <td align="right" style="border:0;">

                        </td>
                        <td align="right" style="border:0;">
                            <span><br />
                                Loan Amount: {{number_format($loan->amount_approved,2,'.',',')}}<br />
                                Tenor: {{$loan->custom_tenor}} Mnth(s)<br />
                                Monthly Repymnt: {{number_format($loan->monthly_deduction,2,'.',',')}}<br />
                                start Date: {{$loan->loan_start_date->toFormattedDateString()}}<br />
                                End Date: {{$loan->loan_end_date->toFormattedDateString()}}
                                <br />
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </section>
        <section class="print-area">
            <table>
                <thead>
                    <tr>
                        {{-- <th>S/N</th> --}}
                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>BAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- <td>{{1}}</td> --}}
                        <td>@if($loan->disbursement_date)
                        {{$loan->disbursement_date->toFormattedDateString()}}
                        @else
                        NOT AVAILABLE
                        @endif
                      </td>
                        <td>Normal Loan Disbursement</td>
                        <td style="text-align:right; margin-right:1em;">{{number_format($loan->amount_approved,2,'.',',')}}</td>
                        <td>-</td>
                        <td style="text-align:right; margin-right:1em;">{{number_format($loan->amount_approved,2,'.',',')}}
                        </td>
                    </tr>
                    @if (count($loanHistory)>=1)
                    @foreach($loanHistory as $myItem)
                    <tr>
                        {{-- <td>{{$i}}</td> --}}
                        <td>{{$myItem->entry_month->toFormattedDateString()}}</td>
                        <td>{{$myItem->notes}}</td>
                        {{-- <td><a href="/user/page/{{$myItem->user_id}}">{{$myItem->user->first_name}}</a></td> --}}
                        <td style="text-align:right; margin-right:1em;">
                          @if($myItem->amount_debited)
                          {{number_format($myItem->amount_debited,2,'.',',')}}
                          @else
                          -
                          @endif
                        </td>
                        <td style="text-align:right; margin-right:1em;">
                        @if($myItem->amount_deducted)
                        {{number_format($myItem->amount_deducted,2,'.',',')}}
                        @else
                        -
                        @endif</td>
                        <td style="text-align:right; margin-right:1em;">{{number_format($loan->amount_approved-$myItem->balances,2,'.',',')}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <th colspan="5">No deduction(s) for this facility yet</th>
                    </tr>
                    @endif
                </tbody>
            </table>
        </section>

    </div>
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
</body>

</html>
