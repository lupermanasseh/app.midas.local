<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="<?php echo e(asset('fontawesome-assets/css/fontawesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('fontawesome-assets/css/brands.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('fontawesome-assets/css/solid.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/midas-styles.css')); ?>"> 
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    

    <title>MIDAS- <?php echo e($title); ?></title>
</head>

<body class="grey lighten-5">
    <?php echo $__env->make('inc.admin-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('inc.admin-top-section', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <section class="section section-content-details">
        
        <div class="row">
            <div class="col s12 m10 l10 user-profiles">
                <div class="white">
                    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->yieldContent('main-content'); ?>
                </div>
            </div>
            <?php echo $__env->make('inc.admin-side-section', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </section>
    


    <footer class="page-footer grey darken-3 section">
        <div class="container">
            <div class="row">
                <div class="col s12 m4 l4 grey-text text-lighten-3">
                    

                    

                </div>
                

            </div>
        </div>
        <div class="footer-copyright grey darken-2">
            <div class="container">
                &copy; MIDAS TOUCH 
            </div>
        </div>
    </footer>

    
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="material-icons">add</i>
        </a>
        <ul>
            

            
            
            <li>
                <a href="/New" class="modal-trigger btn-floating red accent-1 tooltipped" data-position="left"
                    data-tooltip="New User">
                    <i class="material-icons">supervisor_account</i>
                </a>
            </li>

            <li>
                <a href="/saving/statement" class="modal-trigger btn-floating red accent-3 tooltipped"
                    data-position="left" data-tooltip="Statement of Account">
                    <i class="material-icons">folder</i>
                </a>
            </li>

        </ul>
    </div>

    

    

     

    <script src="https://code.jquery.com/jquery-3.3.1.min.js "
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin=" anonymous "></script>
    <script src="<?php echo e(asset( 'js/app.js')); ?> "></script>
    <script src="<?php echo e(asset( 'js/toastr.min.js')); ?> "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js "></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo e(asset( 'js/echarts.min.js')); ?> "></script>
    <script>
        //HIDE ALL SECTIONS
    //$('.section').hide();

        //set time out
    // setTimeout(function(){

$(document).ready(function(){

// //SHOW SECTIONS
$('.section').fadeIn();
// //HIDE LOADER
$('.loader').fadeOut();
//INIT Side Nav
$('.sidenav').sidenav();

//INIT dropdown menu
$(".dropdown-trigger ").dropdown({
coverTrigger:false,
hover:true
});

//INIT SELECT
$('select').formSelect();

//INIT COUNTER TEXTAREA
$('textarea#notes').characterCounter();

//INIT TOOLTIP
$('.tooltipped').tooltip();

//INIT Carousel
$('.carousel.carousel-slider').carousel({
fullWidth: true
});

//INIT MATERIAL BOX IMAGE
$('.materialboxed').materialbox();

//INIT DATEPICKER
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
}
);

//COUNTER SNIPPET
$('.count').each(function() {
$(this).prop('Counter',0).animate({
Counter: $(this).text()
},
{
duration: 1000,
easing:'swing',
step: function(now){
    $(this).text(Math.ceil(now));
}
});
});

//INIT MODAL
$('.modal').modal();

//INIT FLOATING BUTTON
$('.fixed-action-btn').floatingActionButton();

//INIT TOAST ON  CLICK OF BUTTON APPROVE
$('.approve').click(function(e){
    e.preventDefault();
    M.toast({html: 'Comment Approved',
    displayLength: 3000})
})

//INIT TOAST ON  CLICK OF BUTTON DENY
$('.deny').click(function(e){
    e.preventDefault();
    M.toast({html: 'Comment Denied',
    displayLength: 3000})
})

});

    // },
    // 1000);
    </script>

    <script>
        //MOVE TO THE DOCUMENT READY FUNCTION NOT WORKING FOR NOW REFACTOR
        $(document).on("click", "#delete", function(e){
         e.preventDefault();
         var link = $(this).attr("href");
         swal({
             title: "Are you sure you want to delete?",
             text: "Once deleted this will be permanent",
             icon: "warning",
             buttons:true,
             dangerMode:true,
         }).then((willDelete)=>{
             if(willDelete){
                 window.location.href=link;
             }else{
                 swal("Safe Data");
             }
         })
     })
    </script>
    <script src="<?php echo e(asset( 'js/custom.js')); ?> "></script>
    <?php if(isset($chart)): ?>
    <?php echo $chart->script(); ?>

    <?php endif; ?>

    <?php if(isset($item)): ?>
    <?php echo $item->script(); ?>

    <?php endif; ?>
</body>
<?php echo app('toastr')->render(); ?>

</html>