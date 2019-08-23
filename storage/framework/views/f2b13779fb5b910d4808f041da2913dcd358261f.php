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
                            <span class="profile-name">PERIOD</span><br />
                            <span>From: <?php echo e($from); ?></span><br />
                            <span>To: <?php echo e($to); ?></span><br />
                            <span>Date Printed: <?php echo e(now()->toFormattedDateString()); ?></span><br />
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
                                Name: <?php echo e($userObj->first_name); ?> <?php echo e($userObj->last_name); ?>

                                <br />
                                Membership No: <?php echo e($userObj->id); ?><br />
                                Membership Type: <?php echo e($userObj->Membership_type); ?><br>
                                Address: <?php echo e($userObj->home_add); ?><br>
                            </span>
                        </td>
                        <td style=" border:0;">

                        </td>
                        <td style=" border:0;"></td>
                        <td align="right" style="border:0;">

                        </td>
                        <td align="right" style="border:0;">
                            <span><br />
                                Total Debit: <?php echo e(number_format($Saving->totalDebit($userObj->id),2,'.',',')); ?><br />
                                Total Credit: <?php echo e(number_format($Saving->mySavings($userObj->id),2,'.',',')); ?><br />
                                Net Saving:
                                <?php echo e(number_format($Saving->netBalance($userObj->id),2,'.',',')); ?><br /></span>
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
                        <td><?php echo e($Saving->openingDate($from)); ?></td>
                        <td>Openning Balance</td>
                        <td>
                        </td>
                        <td></td>
                        <td><?php echo e(number_format($Saving->openingBalance($from,$userObj->id),2,'.',',')); ?></td>
                    </tr>
                    <?php $__currentLoopData = $statementCollection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($statement->entry_date->toFormattedDateString()); ?></td>
                        <td>
                            <?php echo e($statement->notes); ?>

                        </td>
                        <td><?php echo e(number_format($statement->amount_withdrawn,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($statement->amount_saved,2,'.',',')); ?>

                        </td>
                        <td><?php echo e(number_format($Saving->balanceAsAt($statement->amount_saved,$statement->amount_withdrawn,$statement->id,$userObj->id),2,'.',',')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </section>

    </div>
    
</body>

</html>