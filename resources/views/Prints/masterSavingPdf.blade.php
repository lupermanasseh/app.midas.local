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
    <div class="midas-container">

        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>
                        <td style="width:20%; border:0;"><img src="images/logo2.png" alt="" class="logo">
                        </td>
                        <td style="text-align:left; margin-left:1em; width:16%; border:0;">

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
                        <td style="text-align:left; margin-left:1em; border:0;">
                            <span class="profile-name">PERIOD</span><br />
                            {{-- <span>From: {{$from}}</span><br /> --}}
                            <span>Closing: {{$to}}</span><br />
                            <span>Date Printed: {{now()->toFormattedDateString()}}</span><br />
                        </td>
                    </tr>

                </tbody>
            </table>
        </section>

        <section>
            <h4 class="statement-title">MIDAS SAVINGS LIABILITY</h4>
        </section>

        <section class="print-area">

        </section>

        <section class="print-area">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>REG NO</th>
                        <th>NAME</th>
                        <th>IPPIS NO</th>
                        <th>MEMBER TYPE</th>
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
                        <td>{{$listing->userAggregateAt($savingsCollection,$listing->user_id)}}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="5">TOTAL</th>
                        <th>{{number_format($saving->savingAggregateAt($to),2,'.',',')}}</th>
                    </tr>
                </tbody>
            </table>
        </section>

    </div>
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
</body>

</html>