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
                    <p class="profile-item">+234 80-900-987-090</p>
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
                                +234 80-900-987-090<br>
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
            <h4 class="statement-title">LOAN REPAYMENT SCHEDULE</h4>
        </section>


        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:40%; border:0;">

                            <span>
                                <br />
                                Name: {{$userObj->first_name}} {{$userObj->last_name}}
                                <br />
                                Reg No: {{$userObj->membership_type}}/{{$userObj->id}}<br />
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
                                Start Date: {{$loan->loan_start_date->toFormattedDateString()}}<br />
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
                        <th>S/N</th>
                        <th>DATE</th>
                        <th>PRINCIPAL</th>
                        <th>MONTHLY REPAYMENT</th>
                        <th>CUMM. PAYMENT</th>
                        <th>BAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{1}}</td>
                        <td>{{$loan->loan_start_date->endOfMonth()->toFormattedDateString()}}</td>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                        <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                        <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                        <td>{{number_format($loan->amount_approved - $loan->monthly_deduction,2,'.',',')}}
                        </td>
                    </tr>
                    @for($i=2; $i<=$loan->custom_tenor; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$loan->loan_start_date->addMonths($i-1)->endOfMonth()->toFormattedDateString()}}
                            </td>
                            <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                            <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                            <td>{{number_format($loan->monthly_deduction*$i,2,'.',',')}}</td>
                            <td>{{number_format($loan->amount_approved-$loan->monthly_deduction*$i,2,'.',',')}}
                            </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </section>

    </div>
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
</body>

</html>