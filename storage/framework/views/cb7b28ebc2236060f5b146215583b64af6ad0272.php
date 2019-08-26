<div class="navbar-fixed">
    <nav class="blue-grey darken-2">

        <div class="container">
            <div class="nav-wrapper">
                <ul class="right orange-text darken-4">
                    <?php if(Auth::check()): ?>
                    <li class="right"><?php echo e(auth()->user()->first_name); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="nav-wrapper">
                <a href="/Dashboard" class="brand-logo"><img height="30" src="<?php echo e(asset('images/logo2.svg')); ?>"
                        alt="logo"></a>

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


<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="<?php echo e(asset('images/logo2.svg')); ?>">
            </div>
            <?php if(Auth::check()): ?><a href="#"><img class="circle"
                    src="<?php echo e(url('storage/photos/'.auth()->user()->photo)); ?>"></a>
            <?php endif; ?>
            <a href="#"><span class="grey-text darken-3 name"><?php if(Auth::check()): ?>
                    <?php echo e(auth()->user()->first_name); ?>, <?php echo e(auth()->user()->last_name); ?><?php endif; ?>
                </span></a>
            <a href="#"><span
                    class="grey-text darken-3 email"><?php if(Auth::check()): ?><?php echo e(auth()->user()->email); ?><?php endif; ?></span></a>
        </div>
    </li>

    <li><a class="subheader">Users</a></li>
    <li><a href="/New"><i class="fas fa-plus"></i> New User</a></li>
    <li><a href="/user/all"><i class="fas fa-ellipsis-v"></i> List Users</a></li>
    <li><a href="/filter/users"><i class="fas fa-sort "></i>Filter Members</a></li>
    <li><a href="/users/upload"><i class="fas fa-cloud-upload-alt"></i>Member Bulk Uploads</a></li>
    <li><a href="/nok/upload"><i class="fas fa-cloud-upload-alt"></i>NOK Bulk Uploads</a></li>
    <li><a href="/bank-bulk/upload"><i class="fas fa-cloud-upload-alt"></i>Bank Bulk Uploads</a></li>
    <li><a href="/saving-reg"><i class="fas fa-cloud-upload-alt"></i>Bulk Saving Registration</a></li>
    <li><a href="/ts-reg"><i class="fas fa-cloud-upload-alt"></i>Bulk TS Registration</a></li>
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
    <li><a class="subheader">IPPIS Downloads</a></li>
    <li><a href="/ippis/savings"><i class="fas fa-coins "></i> Savings</a></li>
    <li><a href="/ippis/loans"><i class="fas fa-arrow-alt-circle-down "></i>Loans</a></li>
    <li><a href="/loan/filter"><i class="fas fa-sort "></i>Filter Loans</a></li>
    <li><a href="/ippis-analysis"><i class="fas fa-arrow-alt-circle-up "></i>Upload IPPIS Analysis</a></li>

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

    
</ul>



<ul id='dropdown1' class='dropdown-content'>


    <li><a href="/New" class="orange-text darken-4">New</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/user/all" class="orange-text darken-4">All</a></li>
    <li class="divider" tabindex="-1"></li>
    
</ul>



<ul id='dropdown2' class='dropdown-content'>
    <li><a href="/saving-deductions" class="orange-text darken-4">Deductions</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/saving/create" class="orange-text darken-4">Upload</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/saving/search" class="orange-text darken-4">Search</a></li>
    <li class="divider" tabindex="-1"></li>
</ul>


<ul id='dropdown3' class='dropdown-content'>
    <li><a href="/loan/deductions" class="orange-text darken-4">Deductions</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/loan/uploadForm" class="orange-text darken-4">Upload</a></li>
    <li class="divider" tabindex="-1"></li>
</ul>



<ul id='dropdown4' class='dropdown-content'>
    <li><a href="/ippis/savings" class="orange-text darken-4">Savings</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/ippis/loans" class="orange-text darken-4">Loans</a></li>
    <li class="divider" tabindex="-1"></li>
    <li><a href="/loan/filter" class="orange-text darken-4">Filter</a></li>
</ul>