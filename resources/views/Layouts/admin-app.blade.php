<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{asset('fontawesome-assets/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome-assets/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome-assets/css/solid.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/midas-styles.css')}}"> {{--
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    {{-- install sweet alert css --}}
    <title>MIDAS- {{$title}}</title>
</head>

<body class="grey lighten-5">
    @include('inc.admin-navbar')
    @include('inc.admin-top-section')

    <section class="section section-content-details">
        {{--
    @include('inc.messages') --}}
        <div class="row">
            <div class="col s12 user-profiles">
                <div class="white">
                    @include('inc.messages')
                    @yield('main-content')
                </div>
            </div>
            {{-- @include('inc.admin-side-section') --}}
        </div>
    </section>
    {{-- @yield('admin-content') --}}


    <footer class="page-footer grey darken-3 section">
        <div class="container">
            <div class="row">
                <div class="col s12 m4 l4 grey-text text-lighten-3">
                    {{-- <h5 class="font-weight-bold"><i class="fas fa-map-marker-alt"></i> Contact Us</h5>
                    <hr />
                    <address>
                        <h6>MIDAS Touch Multipurpose Cooperative Society Limited</h6>
                        Federal Medical Centre Makurdi,<br />
                        No 1, Hospital Road, Mission Ward,<br />
                        P.M.B. 102004, Makurdi, Benue State<br />
                        +234 081 189 014 11<br />
                        midastouch@gmail.com<br />
                    </address> --}}

                    {{-- <p>&copy; MIDAS TOUCH</p> --}}

                </div>
                {{-- <div class="col s12 m4 l4 offset-m4 grey-text text-lighten-3">
                    <h5 class="font-weight-bold grey-text text-lighten-3"> <i class="fas fa-share-alt"></i> Social </h5>
                    <hr />
                    <ul class="list-unstyled">
                        <li><span><i class="fab fa-facebook-square"></i></span> Facebook</li>
                        <li><span><i class="fab fa-twitter-square"></i></span> Twitter</li>
                        <li><span><i class="fab fa-whatsapp-square"></i></span> Whatsapp</li>
                    </ul>
                </div> --}}

            </div>
        </div>
        <div class="footer-copyright grey darken-2">
            <div class="container">
                &copy; MIDAS TOUCH {{-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> --}}
            </div>
        </div>
    </footer>

    {{-- fixed action button --}}
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="material-icons">add</i>
        </a>
        <ul>
            {{-- <li>
                <a href="/New" class="modal-trigger btn-floating light-blue accent-1 tooltipped" data-position="left"
                    data-tooltip="Create User">
                    <i class="material-icons">mode_edit</i>
                </a>
            </li> --}}

            {{-- <li>
                <a href="/Nok" class="modal-trigger btn-floating teal darken-3 tooltipped" data-position="left"
                    data-tooltip="Add User NOK">
                    <i class="material-icons">person_pin</i>
                </a>
            </li> --}}
            {{-- <li>
                <a href="/loanSub/create" class="modal-trigger btn-floating cyan darken-3 tooltipped" data-position="left"
                    data-tooltip="New Loan">
                    <i class="material-icons">attach_money</i>
                </a>
            </li> --}}
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

    {{-- POST MODAL --}}

    {{-- <div id=post-modal class="modal ">
        <div class="modal-content ">
            <h4>Post</h4>
            <form action="">
                <div class="row">
                    <div class="input-field col s6 m6 l4">
                        <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s6 m6 l8">
                        <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                        <label for="first_name">First Name</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer ">
            <a href="#! " class="modal-close waves-effect waves-green btn-flat ">Agree</a>
        </div>
    </div> --}}

    {{--Below is loader --}} {{--
    <div class="loader preloader-wrapper big active ">
        <div class="spinner-layer spinner-blue ">
            <div class="circle-clipper left ">
                <div class="circle "></div>
            </div>
            <div class="gap-patch ">
                <div class="circle "></div>
            </div>
            <div class="circle-clipper right ">
                <div class="circle "></div>
            </div>
        </div>
    </div> --}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js "
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin=" anonymous "></script>
    <script src="{{asset( 'js/app.js')}} "></script>
    <script src="{{asset( 'js/toastr.min.js')}} "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js "></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset( 'js/echarts.min.js')}} "></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    @stack('scripts')
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
    <script src="{{asset( 'js/custom.js')}} "></script>
    @isset($chart)
    {!! $chart->script() !!}
    @endisset

    @isset($item)
    {!! $item->script() !!}
    @endisset
</body>
@toastr_render

</html>