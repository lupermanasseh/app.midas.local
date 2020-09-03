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
                                www.midastouchonline.co<br>
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
            <h4 class="statement-title">LOAN DEDUCTION HISTORY</h4>
        </section>


        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:40%; border:0;">

                            <span>
                                <br />
                                Name: <?php echo e($loan->user->first_name); ?> <?php echo e($loan->user->last_name); ?>

                                <br />
                                Reg No: <?php echo e($loan->user->membership_type); ?>/<?php echo e($loan->user->id); ?><br />
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
                                start Date: <?php echo e($loan->loan_start_date->toFormattedDateString()); ?><br />
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
                        
                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>BAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                        <td><?php if($loan->disbursement_date): ?>
                        <?php echo e($loan->disbursement_date->toFormattedDateString()); ?>

                        <?php else: ?>
                        NOT AVAILABLE
                        <?php endif; ?>
                      </td>
                        <td>Normal Loan Disbursement</td>
                        <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?></td>
                        <td>-</td>
                        <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?>

                        </td>
                    </tr>
                    <?php if(count($loanHistory)>=1): ?>
                    <?php $__currentLoopData = $loanHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        
                        <td><?php echo e($myItem->entry_month->toFormattedDateString()); ?></td>
                        <td><?php echo e($myItem->notes); ?></td>
                        
                        <td style="text-align:right; margin-right:1em;">
                          <?php if($myItem->amount_debited): ?>
                          <?php echo e(number_format($myItem->amount_debited,2,'.',',')); ?>

                          <?php else: ?>
                          -
                          <?php endif; ?>
                        </td>
                        <td style="text-align:right; margin-right:1em;">
                        <?php if($myItem->amount_deducted): ?>
                        <?php echo e(number_format($myItem->amount_deducted,2,'.',',')); ?>

                        <?php else: ?>
                        -
                        <?php endif; ?></td>
                        <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($loan->amount_approved-$myItem->balances,2,'.',',')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                        <th colspan="5">No deduction(s) for this facility yet</th>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

    </div>
    
</body>

</html>
