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
                            
                            <span>Date Printed: <?php echo e(now()->toFormattedDateString()); ?></span><br />
                        </td>
                    </tr>

                </tbody>
            </table>
        </section>

        <section>
            <h4 class="statement-title">LOAN PAYMENT SCHEDULE</h4>
        </section>

        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:16%; border:0;">

                            <span>
                                <br />
                                Name: <?php echo e($userObj->first_name); ?> <?php echo e($userObj->last_name); ?>

                                <br />
                                Membership No: <?php echo e($userObj->id); ?><br />
                                Membership Type: <?php echo e($userObj->membership_type); ?><br>
                                Address: <?php echo e($userObj->home_add); ?><br>
                            </span>
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
        </section>
        <section class="print-area">
            <table>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>REPYMT</th>
                        <th>AMNT</th>
                        <th>BAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e(1); ?></td>
                        <td><?php echo e($loan->loan_start_date->toFormattedDateString()); ?></td>
                        <td><?php echo e($loan->user->first_name); ?> <?php echo e($loan->user->last_name); ?></td>
                        <td><?php echo e($loan->product->name); ?></td>
                        <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($loan->amount_approved - $loan->monthly_deduction,2,'.',',')); ?>

                        </td>
                    </tr>
                    <?php for($i=2; $i<=$loan->custom_tenor; $i++): ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($loan->loan_start_date->addMonths($i-1)->toFormattedDateString()); ?>

                            </td>
                            <td><?php echo e($loan->user->first_name); ?> <?php echo e($loan->user->last_name); ?></td>
                            <td><?php echo e($loan->product->name); ?></td>
                            <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                            <td><?php echo e(number_format($loan->monthly_deduction*$i,2,'.',',')); ?></td>
                            <td><?php echo e(number_format($loan->amount_approved-$loan->monthly_deduction*$i,2,'.',',')); ?>

                            </td>
                        </tr>
                        <?php endfor; ?>
                </tbody>
            </table>
        </section>

    </div>
    
</body>

</html>