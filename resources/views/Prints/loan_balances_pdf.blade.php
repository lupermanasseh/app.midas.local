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
  {{$title}}
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
            <h4 class="statement-title">LOAN DEDUCTION BALANCES</h4>
        </section>

        <!-- <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:40%; border:0;">


                        </td>
                        <td style=" border:0;">

                        </td>
                        <td style=" border:0;"></td>
                        <td align="right" style="border:0;">

                        </td>
                        <td align="right" style="border:0;">

                        </td>
                    </tr>

                </tbody>
            </table>
        </section> -->
        <section class="print-area">
            <table>
                <thead>
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
                      <td>
                        {{number_format($listing->allLoanBalancesByDate($loanDeductionCollection,$listing->user_id),2,'.',',')}}
                      </td>
                  </tr>
                  @endforeach
                  @if (count($uniqueDebtors)>=1)
                  <tr>
                      <th colspan="4">Total</th>
                      <th>{{number_format($listing->loanBalanceAggregateAt($loanDeductionCollection),2,'.',',')}}</th>
                  </tr>
                  @else
                  @endif
                </tbody>
            </table>
        </section>

    </div>
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
</body>

</html>
