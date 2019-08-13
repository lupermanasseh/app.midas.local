@extends('Layouts.admin-app')
@section('main-content') {{-- Detail content container --}}
<h5>MIDAS TOUCH MULTIPURPOSE COOPERATIVE SOCIETY DASHBOARD</h5>
<div class="row">


    <div class="col s12 m6 l6">
        <div class="card-panel pink-text center">
            <i class="fas fa-user-friends"></i>
            <div>
                <h6>Membership Spread</h6>
                {!! $chart->container() !!}
            </div>
        </div>
    </div>

    <div class="col s12 m6 l6">
        <div class="card-panel  pink-text center">
            <i class="fas fa-plus-circle"></i>
            <div>
                <h6>Loan Status</h6>
                {!! $item->container() !!}
            </div>
        </div>
    </div>

    {{-- <div class="col s12 m6 l6">
        <div class="card-panel pink-text center">
            <i class="fas fa-user-friends"></i>
            <div>
                <h6>Charts</h6>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo ipsam vitae quis unde exercitationem
                    iste facilis qui nesciunt enim deleniti doloribus labore corrupti, quasi aspernatur sint. Quis nemo
                    veniam iusto?</p>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col s12 m6 l6">
        <div class="card-panel  pink-text center">
            <i class="fas fa-plus-circle"></i>
            <div>
                <h6>Charts</h6>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo ipsam vitae quis unde exercitationem
                    iste facilis qui nesciunt enim deleniti doloribus labore corrupti, quasi aspernatur sint. Quis nemo
                    veniam iusto?</p>
            </div>
        </div>
    </div> --}}
</div>
@endsection