<section class="section section-stats center">
    <div class="row search_bar">
        <form class="customsearch" method="POST" action="/search/User">
            {{ csrf_field() }}

            <div class="customsearch__item"><input class="custom-input custom-width" type="text" name="search_term"
                    id="search_term" placeholder="Reg Number e.g 75">
            </div>
            <div class="customsearch__item"><button class="custom-input" type="submit">Search</button></div>
        </form>
    </div>
    <div class="row">
        {{-- <div class="col s12 m6 l6">
            <div class="card-panel pink-text center top-side-div">
                <i class="fas fa-user-friends"></i>
                <div><span><a href="/contributors-list">Active Users</a></span></div>
            </div>
        </div>

        <div class="col s12 m6 l6 ">
            <div class="card-panel  pink-text center top-side-div">
                <i class="fas fa-plus-circle"></i>
                <div> <span><a href="/loanSub/create">New Loan</a></span></div>
            </div>
        </div> --}}

        <div class="col s12 m3 l3">
            <div class="card-panel pink-text center top-banner">
                <i class="fas fa-user-friends"></i>
                <div><span><a href="/contributors-list">Register</a></span></div>
            </div>
        </div>

        <div class="col s12 m3 l3">
            <div class="card-panel  pink-text center top-banner">
                <i class="fas fa-calendar-alt"></i>
                <div> <span><a href="/loandisbursement/find">Disbursement Date</a></span></div>
            </div>
        </div>

        <div class="col s12 m2 l2">
            <div class="card-panel  pink-text center top-banner">
                <i class="fas fa-plus-circle"></i>
                <div> <span><a href="/loanSub/create">New Loan</a></span></div>
            </div>
        </div>



        <div class="col s12 m2 l2">
            <div class="card-panel  pink-text center top-banner">
                <i class="fas fa-user-friends"></i>
                <div> <span><a href="/guarantor/dashboard">Guarantors</a></span></div>
            </div>
        </div>
        <div class="col s12 m2 l2">
            <div class="card-panel  pink-text center top-banner">
                <i class="fab fa-cc-mastercard"></i>
                <div> <span><a href="">Over Paid</a></span></div>

                <div> <span><a href="/overpaidLoans/listings"> {{$overPaid->count()}} </a> </span></div>
            </div>
        </div>

    </div>
</section>
