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
                            <span class="profile-name">PERIOD</span><br />
                            <span>From: {{$from}}</span><br />
                            <span>To: {{$to}}</span><br />
                            <span>Date Printed: {{now()->toFormattedDateString()}}</span><br />
                        </td>
                    </tr>

                </tbody>
            </table>
        </section>

        <section>
            <h4 class="statement-title">STATEMENT OF SAVINGS</h4>
        </section>

        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:16%; border:0;">

                            <span>
                                <br />
                                Name: {{$userObj->first_name}} {{$userObj->last_name}}
                                <br />
                                Membership No: {{$userObj->id}}<br />
                                Membership Type: {{$userObj->Membership_type}}<br>
                                Address: {{$userObj->home_add}}<br>
                            </span>
                        </td>
                        <td style=" border:0;">

                        </td>
                        <td style=" border:0;"></td>
                        <td align="right" style="border:0;">

                        </td>
                        <td align="right" style="border:0;">
                            <span><br />
                                Total Debit: {{number_format($Saving->totalDebit($userObj->id),2,'.',',')}}<br />
                                Total Credit: {{number_format($Saving->mySavings($userObj->id),2,'.',',')}}<br />
                                Net Saving:
                                {{number_format($Saving->netBalance($userObj->id),2,'.',',')}}<br /></span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </section>
        <section class="print-area">
            <table>
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$Saving->openingDate($from)}}</td>
                        <td>Openning Balance</td>
                        <td>
                        </td>
                        <td></td>
                        <td>{{number_format($Saving->openingBalance($from,$userObj->id),2,'.',',')}}</td>
                    </tr>
                    @foreach($statementCollection as $statement)
                    <tr>
                        <td>{{$statement->entry_date->toFormattedDateString()}}</td>
                        <td>
                            {{$statement->notes}}
                        </td>
                        <td>{{number_format($statement->amount_withdrawn,2,'.',',')}}</td>
                        <td>{{number_format($statement->amount_saved,2,'.',',')}}
                        </td>
                        <td>{{number_format($Saving->balanceAsAt($statement->amount_saved,$statement->amount_withdrawn,$statement->id,$userObj->id),2,'.',',')}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

    </div>
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
</body>

</html>