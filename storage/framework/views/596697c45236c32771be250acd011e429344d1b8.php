<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?famaily=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/printpdf.css">
    <title><?php echo e($title); ?></title>
</head>

<body>
  <!-- Define header and footer blocks before your content -->
  <div class="header small-text">
  <!-- Page <span class="pagenum"></span> -->
  <?php echo e($userObj->first_name); ?> <?php echo e($userObj->last_name); ?> | <?php echo e($title); ?>

</div>
<div class="footer">
   <img src="images/logo.png" class="logo_footer_pdf"/> | Page <span class="pagenum"></span>
</div>

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
                                midastouchonline.co<br>
                                +234 81-1890-1411<br>
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
            <h4 class="statement-title">LOAN REPAYMENT SCHEDULE</h4>
        </section>


        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:40%; border:0;">

                            <span>
                                <br />
                                Name: <?php echo e($userObj->first_name); ?> <?php echo e($userObj->last_name); ?>

                                <br />
                                Reg No: <?php echo e($userObj->membership_type); ?>/<?php echo e($userObj->id); ?><br />
                                Loan Type: <?php echo e($loan->product->name); ?><br>
                                Interest Rate: <?php echo e($loan->product->interest*100); ?>%<br>
                                Interest:
                                <?php echo e(number_format($loan->product->interest*$loan->amount_approved,2,'.',',')); ?><br>
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
                                Loan Amount: <?php echo e(number_format($loan->amount_approved,2,'.',',')); ?><br />
                                Tenor: <?php echo e($loan->custom_tenor); ?> Mnth(s)<br />
                                Monthly Repymnt: <?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?><br />
                                Start Date: <?php echo e($loan->loan_start_date->toFormattedDateString()); ?><br />
                                End Date: <?php echo e($loan->loan_end_date->toFormattedDateString()); ?>

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
                        <td><?php echo e(1); ?></td>
                        <td><?php echo e($loan->loan_start_date->endOfMonth()->toFormattedDateString()); ?></td>
                        <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($loan->amount_approved - $loan->monthly_deduction,2,'.',',')); ?>

                        </td>
                    </tr>
                    <?php for($i=2; $i<=$loan->custom_tenor; $i++): ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($loan->loan_start_date->addMonths($i-1)->endOfMonth()->toFormattedDateString()); ?>

                            </td>
                            <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?></td>
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
