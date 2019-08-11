<nav class="blue darken-4">

    <div class="container">
        <div class="nav-wrapper">
            <ul class="right">
                @if (Auth::check())
                <li class="right">{{auth()->user()->first_name}}</li>
                @endif
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="nav-wrapper">
            <a href="/Dashboard" class="brand-logo"><img height="30" src="{{asset('images/logo2.svg')}}" alt="logo"></a>

            <a href="#" data-target="slide-out" class="sidenav-trigger right show-on-large"><i
                    class="material-icons">menu</i></a>

            <ul class="right hide-on-med-and-down">

                <li><a class="dropdown-trigger" href="/" data-target='dropdown1'><i
                            class="material-icons left">group</i></a></li>
                <li><a class="dropdown-trigger" href="/about" data-target='dropdown2'><i
                            class="material-icons left">bubble_chart</i></a></li>
                <li><a class="dropdown-trigger" href="/about" data-target='dropdown3'><i
                            class="material-icons left">style</i></a></li>
                <li><a class="dropdown-trigger" href="/about" data-target='dropdown4'><i
                            class="material-icons left">person</i></a></li>
                {{-- <li><a class="dropdown-trigger" href="/about" data-target='dropdown5'><i
                            class="material-icons left">dashboard</i></a></li> --}}
            </ul>

        </div>
    </div>


</nav>

{{-- SIDE NAV CODE --}}
<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="{{asset('images/logo2.svg')}}">
            </div>
            @if(Auth::check())<a href="#"><img class="circle"
                    src="{{url('storage/photos/'.auth()->user()->photo)}}"></a>
            @endif
            <a href="#"><span class="grey-text darken-3 name">@if(Auth::check())
                    {{auth()->user()->first_name}}, {{auth()->user()->last_name}}@endif
                </span></a>
            <a href="#"><span
                    class="grey-text darken-3 email">@if(Auth::check()){{auth()->user()->email}}@endif</span></a>
        </div>
    </li>

    <li><a class="subheader">Users</a></li>
    <li><a href="/New"><i class="fas fa-plus"></i> New User</a></li>
    <li><a href="/user/all"><i class="fas fa-ellipsis-v"></i> List Users</a></li>
    <li><a href="/change/password"><i class="fas fa-cogs"></i> Change Password</a></li>

    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Contributions</a></li>
    <li><a href="/saving-deductions"><i class="fas fa-coins "></i> Deductions</a></li>
    <li><a href="/saving/create"><i class="fas fa-arrow-alt-circle-up "></i>MIDAS Upload</a></li>
    <li><a href="/saving/search"><i class="fab fa-searchengin "></i>Search</a></li>


    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">IPPIS Downloads</a></li>
    <li><a href="/ippis/savings"><i class="fas fa-coins "></i> Savings</a></li>
    <li><a href="/ippis/loans"><i class="fas fa-arrow-alt-circle-down "></i>Loans</a></li>
    <li><a href="/loan/filter"><i class="fas fa-sort "></i>Filter Loans</a></li>
    {{-- <li><a href="/saving/search"><i class="fab fa-searchengin red-text darken-1"></i>Search</a></li>
    <li> --}}<i class=""></i>

    <div class="divider"></div>
    </li>

    <li><a class="subheader">MIDAS Loan Deductions </a></li>
    <li><a href="/loan/deductions"> <i class="fas fa-file-invoice "></i>Template</a></li>
    <li><a href="/loan/uploadForm"><i class="fas fa-cloud-upload-alt"></i>Upload</a></li>
    <li><a href="/product/create"><i class="material-icons">create</i>Add Product</a></li>
    <li><a href="/products"><i class="material-icons">view_list</i>All Products</a></li>

    <div class="divider"></div>
    </li>

    <li><a class="subheader">Product Category</a></li>
    <li><a href="/product/category/add"><i class="fas fa-plus"></i> New Category</a></li>
    <li><a href="/product/category"><i class="fas fa-ellipsis-v"></i> All Categories</a></li>
    <li><a href="/product/create"><i class="fas fa-plus"></i> Add Product</a></li>
    <li><a href="/products"><i class="fas fa-ellipsis-v"></i> All Products</a></li>

    <li>
        <div class="divider"></div>
    </li>

    <li><a class="subheader">Subscriptions</a></li>
    <li><a href="/loanSub/create"><i class="fas fa-plus"></i> New Subscription</a></li>
    <li><a href="/loan-subscriptions"><i class="fas fa-ellipsis-v"></i> All Subscriptions</a></li>
    <li><a href="/pendingLoans"><i class="fas fa-plug"></i> Pending Loans</a></li>
    <li><a href="/audited/loans"><i class="fas fa-wrench"></i> Audited Loans</a></li>
    <li><a href="/approved/loans"><i class="fas fa-check"></i> Approved Loans</a></li>

    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Target Savings</a></li>
    <li><a href="/targetsaving-deductions"><i class="fas fa-database "></i>TS Deductions</a></li>
    <li><a href="/targetsaving/create"><i class="fas fa-arrow-alt-circle-up "></i>Upload</a></li>
    <li><a href="/ts/search"><i class="fab fa-searchengin "></i>Search TS</a></li>

    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Composite Documents</a></li>
    <li><a href="/saving/statement"><i class="material-icons">book</i>Statement</a></li>
    <li><a href="#!"><i class="material-icons">view_list</i>Master Savings</a></li>
    <li>
        <div class="divider"></div>
    </li>
    <li><a href="/logout"><i class="fas fa-sign-in-alt"></i> Log Out</a></li>

    {{--
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li> --}}
</ul>

{{-- DROP DOWN MENU 1 --}}

<ul id='dropdown1' class='dropdown-content'>


    <li><a href="/New"><i class="material-icons">add</i>New User</a></li>

    <li><a href="/user/all"><i class="material-icons">view_list</i>All Users</a></li>


    <li class="divider" tabindex="-1"></li>
    {{--
    <li><a href="#!"></a></li>
    <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
    <li><a href="#!"><i class="material-icons">cloud</i>five</a></li> --}}
</ul>

{{-- DROP DOWN MENU 2 --}}

<ul id='dropdown2' class='dropdown-content'>
    <li><a href="#!"><i class="material-icons">create</i>New Savings</a></li>
    <li><a href="#!"><i class="material-icons">add</i>New Template</a></li>
    <li class="divider" tabindex="-1"></li>
    {{--
    <li><a href="#!">three</a></li> --}}
    <li><a href="#!"><i class="material-icons">cloud_upload</i>Upload Deductions</a></li>
    {{--
    <li><a href="#!"><i class="material-icons">cloud</i>five</a></li> --}}
</ul>

{{-- DROP DOWN MENU 3 --}}
<ul id='dropdown3' class='dropdown-content'>
    <li><a href="/product/category/add"><i class="material-icons">create</i>New Category</a></li>
    <li><a href="/product/category"><i class="material-icons">view_list</i>All Categories</a></li>
    <li><a href="/product/create"><i class="material-icons">create</i>New Product</a></li>
    <li><a href="/products"><i class="material-icons">view_list</i>All Products</a></li>
    <li class="divider" tabindex="-1"></li>
    {{--
    <li><a href="#!">three</a></li> --}} {{--
    <li><a href="#!"><i class="material-icons">cloud_upload</i>Upload Deductions</a></li> --}} {{--
    <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
     --}}
</ul>

{{-- DROP DOWN MENU 4 --}}

<ul id='dropdown4' class='dropdown-content'>
    <li><a href="#!"><i class="material-icons">create</i>New Target Saving</a></li>
    <li><a href="#!"><i class="material-icons">cloud_download</i>New Template</a></li>
    <li class="divider" tabindex="-1"></li>
    {{--
    <li><a href="#!">three</a></li> --}}
    <li><a href="#!"><i class="material-icons">cloud_upload</i>Upload Target Saving</a></li>
    {{--
    <li><a href="#!"><i class="material-icons">cloud</i>five</a></li> --}}
</ul>

{{-- DROP DOWN MENU 4 --}}

{{-- <ul id='dropdown5' class='dropdown-content'>
    <li><a href="#!"><i class="material-icons">create</i>New Staff</a></li>
    <li><a href="#!"><i class="material-icons">view_list</i>Staff List</a></li>
    <li class="divider" tabindex="-1"></li> --}}
{{--
    <li><a href="#!">three</a></li> --}} {{--
    <li><a href="#!"><i class="material-icons">cloud_upload</i>Upload Deductions</a></li> --}} {{--
    <li><a href="#!"><i class="material-icons">cloud</i>five</a></li> --}}
{{-- </ul> --}}