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

                  <?php $__currentLoopData = $uniqueDebtors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td><?php echo e(substr($listing->user->membership_type,0,1)); ?>/<?php echo e($listing->user_id); ?></td>
                      <td><?php echo e($listing->user->first_name); ?> <?php echo e($listing->user->last_name); ?></td>
                      <td><?php echo e($listing->user->payment_number); ?></td>
                      <td><?php echo e($to); ?></td>
                      <td>
                        <?php echo e(number_format($listing->allLoanBalancesByDate($loanDeductionCollection,$listing->user_id),2,'.',',')); ?>

                      </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php if(count($uniqueDebtors)>=1): ?>
                  <tr>
                      <th colspan="4">Total</th>
                      <th><?php echo e(number_format($listing->loanBalancegAggregateAt($loanDeductionCollection),2,'.',',')); ?></th>
                  </tr>
                  <?php else: ?>
                  <?php endif; ?>
                </tbody>
            </table>
        </section>

    </div>
    
</body>

</html>
