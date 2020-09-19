<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?famaily=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/printpdf.css">
    <title>{{$title}}</title>
</head>

<body>
  <!-- Define header and footer blocks before your content -->
  <div class="header small-text">
  <!-- Page <span class="pagenum"></span> -->
  {{$user->first_name}} {{$user->last_name}} | {{$title}}
</div>
<div class="footer">
   <img src="images/logo.png" class="logo_footer_pdf"/> | Page <span class="pagenum"></span>
</div>

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
            <h4 class="statement-title">CONSOLIDATED LOAN DEDUCTION HISTORY</h4>
        </section>


        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:40%; border:0;">

                            <span>
                                <br />
                                Name: {{$user->first_name}} {{$user->last_name}}
                                <br />
                                Reg No: {{$user->membership_type}}/{{$user->id}}<br/>
                                <br />

                            </span>
                        </td>
                        <td style=" border:0;">

                        </td>
                        <td style=" border:0;"></td>
                        <td align="right" style="border:0;">
                        </td>
                        <td align="right" style="width:40%; border:0;">
                            <!-- <span><br />
                                Total Loan Amount:
                                <br />
                                Tenor:  Mnth(s)<br />

                                <br />
                            </span> -->
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

                    @if (count($consolidatedLoans)>=1)
                    @foreach($consolidatedLoans as $myItem)
                    <tr>
                        {{-- <td>{{$i}}</td> --}}
                        <td>{{$myItem->date_entry->toFormattedDateString()}}</td>
                        <td>{{$myItem->description}}</td>
                        <td style="text-align:right; margin-right:1em;">
                          @if($myItem->debit)
                          {{number_format($myItem->debit,2,'.',',')}}
                          @else

                          @endif
                        </td>
                        <td style="text-align:right; margin-right:1em;">
                        @if($myItem->credit)
                        {{number_format($myItem->credit,2,'.',',')}}
                        @else

                        @endif</td>
                        <td style="text-align:right; margin-right:1em;">{{number_format($myItem->balance,2,'.',',')}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Summary</th>
                        <th style="text-align:right; margin-right:1em;">{{number_format($user->consolidatedLoanDebitTotal($user->id),2,'.',',')}}</th>
                        <th style="text-align:right; margin-right:1em;">{{number_format($user->consolidatedLoanCreditTotal($user->id),2,'.',',')}}</th>
                        <th style="text-align:right; margin-right:1em;">{{number_format($user->consolidatedLoanBalance($user->id),2,'.',',')}}</th>
                    </tr>
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
