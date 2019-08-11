 
<?php $__env->startSection('content'); ?>
<div class="">
    <div class="row">

        <div class="carousel carousel-slider">
            <a class="carousel-item" href="#">
            <img src="<?php echo e(asset('images/agm1.jpg')); ?>" class="responsive-img">
        </a>
            <a class="carousel-item" href="#">
            <img src="<?php echo e(asset('images/agm2.jpg')); ?>" class="responsive-img">
        </a>
            <a class="carousel-item" href="#">
            <img src="<?php echo e(asset('images/agm3.jpg')); ?>" class="responsive-img">
        </a>
        </div> 
    </div>
    </section>

    

</div>

<div class="container">
    <div class="row">
        <div class="col s6 offset-s3">
            <img src="<?php echo e(asset('images/Mission_Vision.png')); ?>" class="responsive-img" />
        </div>

    </div>
</div>

<div class="container">
    <h1 class="center-align">Our Products</h1>

    <div class="row center-align">
        <div class="col s12 m4 l4">
            <h2 class="center-align"><i class="large material-icons center-align">blur_on</i></h2>

            <h4 class="grey-text">
                Loans
            </h4>
            <p>
                We have loan products that are flexible, sustainable and painless that can help all members to access various financial services
                when eligible. Our loan catalogue is made of long term, short term and emergency loans at various rates

            </p>

        </div>
        <div class="col s12 m4 l4">
            <h2 class="center-align"><i class="large material-icons center-align">blur_off</i></h2>
            <h4 class="grey-text">Target Savings</h4>
            <p>
                This is a targeted saving product designed to allow members of the cooperative save money towards recurrent expenditures
                like school fees during new academic sessions. The saving is not specifically for school fees but can also
                be applied to other areas of need.

            </p>

        </div>
        <div class="col s12 m4 l4">
            <h2 class="center-align"><i class="large material-icons center-align">blur_circular</i></h2>
            <h4 class="grey-text">Fixed Deposits</h4>
            <p>This is a product that is designed for a WIN-WIN situtation for us and depositors. Members are free to fixed
                their monies with us for a period of at least six (6) months at a pecentage flat rate that is determined
                by the exco at intervals .
            </p>

        </div>
    </div>

    <div class="row center-align">
        <div class="col s12">
            <a href="/products" class=" teal acccent-4 btn-large waves-effect waves-light"><i class="large material-icons left">label</i>Learn
            More

            </a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m5 l5">
            <h1>Built with Elegance</h1>
            <h3 class="grey-text">...built for you and your lifestyle</h3>
            <p>
                At the heart of our products and services lies a deep understanding of our customers and cooperators' behaviour, their demographics
                and changing social lifestyle. That is why we follow you wherever your lifestyle may take you, now is the
                time for the big idea whose time has come.
            </p>
        </div>
        <div class="col s12 m7  l7">
            <img src="<?php echo e(asset('images/responsive.png')); ?>" class="responsive-img" />
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>