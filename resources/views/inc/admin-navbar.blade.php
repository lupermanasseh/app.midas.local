<div class="navbar-fixed">
    <nav class="blue-grey darken-2">

        <div class="container">
            <div class="nav-wrapper">
                <ul class="right orange-text darken-4">
                    @if (Auth::check())
                    <li class="right">{{auth()->user()->first_name}}</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="nav-wrapper">
                <a href="/admin" class="brand-logo"><img height="30" src="{{asset('images/logo2.svg')}}" alt="logo"></a>

                <a href="#" data-target="slide-out" class="sidenav-trigger right show-on-large orange-text darken-4"><i
                        class="material-icons">menu</i></a>

                <ul class="right hide-on-med-and-down">

                    <li><a class="dropdown-trigger orange-text darken-4" href="" data-target='dropdown1'><i
                                class="material-icons left orange-text darken-4">group</i>
                            USERS</a></li>
                    <li><a class="dropdown-trigger orange-text darken-4" href="" data-target='dropdown2'><i
                                class="material-icons left orange-text darken-3">bubble_chart</i> SAVINGS</a></li>
                    <li><a class="dropdown-trigger orange-text darken-4" href="" data-target='dropdown3'><i
                                class="material-icons left orange-text darken-4">style</i>
                            LOANS</a></li>

                    <li><a class="dropdown-trigger orange-text darken-4" href="" data-target='dropdown4'><i
                                class="material-icons left orange-text darken-4">cloud</i>IPPIS</a></li>
                </ul>

            </div>
        </div>


    </nav>
</div>

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

    <li><a class="subheader">Staff</a></li>
    <li><a href="/add/user"><i class="fas fa-plus"></i> Add Staff</a></li>
    <li><a href="/user/admin"><i class="fas fa-ellipsis-v"></i> View Staff</a></li>
    <li>
        <div class="divider"></div>
    </li>

    <li><a class="subheader">Users</a></li>
    <li><a href="/New"><i class="fas fa-plus"></i> New User</a></li>
    <li><a href="/user/all"><i class="fas fa-ellipsis-v"></i> List Users</a></li>
    <li><a href="/filter/users"><i class="fas fa-sort "></i>Filter Members</a></li>
    {{-- <li><a href="/users/upload"><i class="fas fa-cloud-upload-alt"></i>Member Bulk Uploads</a></li>
    <li><a href="/nok/upload"><i class="fas fa-cloud-upload-alt"></i>NOK Bulk Uploads</a></li>
    <li><a href="/bank-bulk/upload"><i class="fas fa-cloud-upload-alt"></i>Bank Bulk Uploads</a></li>
    <li><a href="/saving-reg"><i class="fas fa-cloud-upload-alt"></i>Bulk Saving Registration</a></li>
    <li><a href="/ts-reg"><i class="fas fa-cloud-upload-alt"></i>Bulk TS Registration</a></li> --}}
    <li><a href="/change/password"><i class="fas fa-cogs"></i> Change Password</a></li>

    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Contributions</a></li>
    <li><a href="/saving-deductions"><i class="fas fa-coins "></i> Deductions</a></li>
    <li><a href="/saving/create"><i class="fas fa-arrow-alt-circle-up"></i>MIDAS Upload</a></li>
    <li><a href="/saving/search"><i class="fab fa-searchengin "></i>Search</a></li>


    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">IPPIS Inputs Management</a></li>
    <li><a href="/ippis/savings"><i class="fas fa-coins "></i> Savings</a></li>
    <li><a href="/mastersaving/summary"><i class="fas fa-coins "></i> Post Savings</a></li>
    <li><a href="/ippis/loans"><i class="fas fa-arrow-alt-circle-down "></i> Loans</a></li>
    <li><a href="/post/loans"><i class="fas fa-envelope-open "></i> Post Loans</a></li>
    <li><a href="/loan/filter"><i class="fas fa-sort "></i> Filter Loans</a></li>
    <li><a href="/ippis-analysis"><i class="fas fa-upload "></i>Upload Loan Inputs</a></li>
    <li><a href="/saving-master-upload-form"><i class="fas fa-hdd"></i>Upload Saving Inputs</a>
    </li>
    <li><a href="/legacy-loans"><i class="fas fa-pen-nib"></i>Loan Subscriptions</a></li>
    <li><a href="/show/legacysubs"><i class="fas fa-pen-nib"></i>Activate Loan Subs</a></li>

    <li>
        <div class="divider"></div>
    </li>

    <li><a class="subheader">MIDAS Loan Deductions </a></li>
    <li><a href="/loan/deductions"> <i class="fas fa-file-invoice "></i>Template</a></li>
    <li><a href="/loan/uploadForm"><i class="fas fa-cloud-upload-alt"></i>Upload</a></li>
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
    {{-- <li><a class="subheader">Target Savings</a></li>
    <li><a href="/targetsaving-deductions"><i class="fas fa-database "></i>TS Deductions</a></li>
    <li><a href="/targetsaving/create"><i class="fas fa-arrow-alt-circle-up "></i>Upload</a></li>
    <li><a href="/ts/search"><i class="fab fa-searchengin "></i>Search TS</a></li> --}}

    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Reports</a></li>
    <li><a href="/saving/statement"><i class="material-icons">border_inner</i>Statement</a></li>
    <li><a href="/loanbalances/form"><i class="material-icons">border_outer</i>Loan Balances</a></li>
    <li><a href="/consolidatedloanbalances/form"><i class="material-icons">account_balance_wallet</i>Consolidated Loans</a></li>
    <li><a href="/negativebalances"><i class="material-icons">exposure</i>Negative Balances</a></li>
    <li><a href="/verifyBalances"><i class="material-icons">exposure</i>Verify Balances</a></li>
    <li><a href="/savings/liability"><i class="material-icons">view_list</i>Master Savings</a></li>
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


    <li><a href="/New" class="orange-text darken-4">New</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/contributors-list" class="orange-text darken-4">Register</a></li>
    {{-- <li><a href="/user/all" class="orange-text darken-4">All</a></li> --}}
    <li><a href="/add/user" class="orange-text darken-4">New Staff</a></li>
    <li class="divider" tabindex="-1"></li>
    {{--
    <li><a href="#!"></a></li>
    <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
    <li><a href="#!"><i class="material-icons">cloud</i>five</a></li> --}}
</ul>

{{-- DROP DOWN MENU 2 --}}

<ul id='dropdown2' class='dropdown-content'>
    <li><a href="/saving-deductions" class="orange-text darken-4">Deductions</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/saving/create" class="orange-text darken-4">Upload</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/saving/search" class="orange-text darken-4">Search</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/saving/pending" class="orange-text darken-4">Pending</a></li>
</ul>

{{-- DROP DOWN MENU 3 --}}
<ul id='dropdown3' class='dropdown-content'>
    <li><a href="/loan/deductions" class="orange-text darken-4">Deductions</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/loan/uploadForm" class="orange-text darken-4">Upload</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/pendingLoans" class="orange-text darken-4">Pending</a></li>
    <li><a href="/audited/loans" class="orange-text darken-4">Audited</a></li>
    <li><a href="/approved/loans" class="orange-text darken-4">Approved</a></li>
    <li><a href="/activeLoans" class="orange-text darken-4">Active</a></li>
</ul>

{{-- DROP DOWN MENU 4 --}}

<ul id='dropdown4' class='dropdown-content'>
    <li><a href="/ippis/savings" class="orange-text darken-4">Savings</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/ippis/loans" class="orange-text darken-4">Loans</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/loan/filter" class="orange-text darken-4">Filter</a></li>
    <li><a href="/mastersaving/summary" class="orange-text darken-4">Master Saving</a></li>
</ul>
