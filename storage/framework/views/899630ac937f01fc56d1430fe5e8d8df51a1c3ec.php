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
            <h4 class="statement-title">CONSOLIDATED LOAN DEDUCTION HISTORY</h4>
        </section>


        <section class="print-area">
            <table style=" border:0;">
                <tbody>
                    <tr>

                        <td align="left" style="width:40%; border:0;">

                            <span>
                                <br />
                                Name: <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                <br />
                                Reg No: <?php echo e($user->membership_type); ?>/<?php echo e($user->id); ?><br/>
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
                        
                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>BAL</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if(count($consolidatedLoans)>=1): ?>
                    <?php $__currentLoopData = $consolidatedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        
                        <td><?php echo e($myItem->date_entry->toFormattedDateString()); ?></td>
                        <td><?php echo e($myItem->description); ?></td>
                        <td style="text-align:right; margin-right:1em;">
                          <?php if($myItem->debit): ?>
                          <?php echo e(number_format($myItem->debit,2,'.',',')); ?>

                          <?php else: ?>

                          <?php endif; ?>
                        </td>
                        <td style="text-align:right; margin-right:1em;">
                        <?php if($myItem->credit): ?>
                        <?php echo e(number_format($myItem->credit,2,'.',',')); ?>

                        <?php else: ?>

                        <?php endif; ?></td>
                        <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($myItem->balance,2,'.',',')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th colspan="2">Summary</th>
                        <th style="text-align:right; margin-right:1em;"><?php echo e(number_format($user->consolidatedLoanDebitTotal($user->id),2,'.',',')); ?></th>
                        <th style="text-align:right; margin-right:1em;"><?php echo e(number_format($user->consolidatedLoanCreditTotal($user->id),2,'.',',')); ?></th>
                        <th style="text-align:right; margin-right:1em;"><?php echo e(number_format($user->consolidatedLoanBalance($user->id),2,'.',',')); ?></th>
                    </tr>
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
