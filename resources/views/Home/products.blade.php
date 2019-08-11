@extends('Layouts.app') 
@section('content')
<div class="container">
    <h1>Products</h1>

    <div class="row">
        <div class="col s12 m12 l3">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h5>Emergency Loan</h5>
                </li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="7.5%"></span>Interest Rate</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="10%"></span>Default Charge</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="Nil"></span>Equity Savings Required</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="N 1,000"></span>Loan Processing Fee</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="N 50, 000"></span>Minimum Loan Amount</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="N 1.5 Million"></span>Maximum Loan Amount</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="6 Months"></span>Maximum Loan Tenor</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="1 Month"></span>Membership Duration</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="Yes"></span>Payslip Required</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="Yes"></span>Loan Payment Subject To Availability of Funds</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="No"></span>2 Guarantors</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="Yes"></span>Loan Processing Fee Non-Refundable</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="No"></span>Loan Subject To Queuing</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="Yes"></span>Payment Based on First Come, First Served</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="Yes"></span>Contract Staff Eligible</li>
                <li class="collection-item"><span class="new badge red" data-badge-caption="No"></span>Grace Period</li>
            </ul>
            <a href="#" class="btn red">Apply Now</a>
        </div>

        <div class="col s12 m12 l3">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h5>Short Term Loan</h5>
                </li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="7.5%"></span>Interest Rate</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="10%"></span>Default Charge</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="Nil"></span>Equity Savings Required</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="N 500"></span>Loan Processing Fee</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="N 100, 000"></span>Minimum Loan Amount</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="N 5 Million"></span>Maximum Loan Amount</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="12 Months"></span>Maximum Loan Tenor</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="1 Month"></span>Membership Duration</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="Yes"></span>Payslip Required</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="Yes"></span>Loan Payment Subject To Availability of Funds</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="No"></span>2 Guarantors</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="Yes"></span>Loan Processing Fee Non-Refundable</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="No"></span>Loan Subject To Queuing</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="Yes"></span>Payment Based on First Come, First Served</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="Yes"></span>Contract Staff Eligible</li>
                <li class="collection-item"><span class="new badge blue" data-badge-caption="No"></span>Grace Period</li>
            </ul>
            <a href="#" class="btn blue">Apply Now</a>
        </div>


        <div class="col s12 m12 l3">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h5>Medium Term Loan</h5>
                </li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="10%"></span>Interest Rate</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="10%"></span>Default Charge</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="30%"></span>Equity Savings Required</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="N 500"></span>Loan Processing Fee</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="N 200, 000"></span>Minimum Loan Amount</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="N 5 Million"></span>Maximum Loan Amount</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="24 Months"></span>Maximum Loan Tenor</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="4 Month"></span>Membership Duration</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="Yes"></span>Payslip Required</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="Yes"></span>Loan Payment Subject To Availability
                    of Funds</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="No"></span>2 Guarantors</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="Yes"></span>Loan Processing Fee Non-Refundable</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="No"></span>Loan Subject To Queuing</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="Yes"></span>Payment Based on First Come, First
                    Served
                </li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="Yes"></span>Contract Staff Eligible</li>
                <li class="collection-item"><span class="new badge yellow darken-4" data-badge-caption="No"></span>Grace Period</li>
            </ul>
            <a href="#" class="btn yellow darken-4">Apply Now</a>
        </div>


        <div class="col s12 m12 l3">
            <ul class="collection with-header">
                <li class="collection-header">
                    <h5>Long Term Loan</h5>
                </li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="15%"></span>Interest Rate</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="10%"></span>Default Charge</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="30%"></span>Equity Savings Required</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="N 500"></span>Loan Processing Fee</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="N 500, 000"></span>Minimum Loan Amount</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="N 5 Million"></span>Maximum Loan Amount</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="60 Months"></span>Maximum Loan Tenor</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="4 Month"></span>Membership Duration</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="Yes"></span>Payslip Required</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="Yes"></span>Loan Payment Subject To Availability
                    of Funds
                </li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="No"></span>2 Guarantors</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="Yes"></span>Loan Processing Fee Non-Refundable</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="No"></span>Loan Subject To Queuing</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="Yes"></span>Payment Based on First Come, First
                    Served
                </li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="Yes"></span>Contract Staff Eligible</li>
                <li class="collection-item"><span class="new badge green darken-4" data-badge-caption="No"></span>Grace Period</li>
            </ul>
            <a href="#" class="btn green darken-4">Apply Now</a>
        </div>

    </div>


    {{--
    <div class="row">




    </div>

    <div class="col-sm-12 col-md-3 col-lg-3">

        <div class="card">
            <img class="card-img-top" src="{{asset('images/midas-product-warning.png')}}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Long Term Loan</h3>
                <h6 class="text-muted">Features</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Interest Rate <span class="badge badge-warning">15%</span> </li>
                <li class="list-group-item">Default <span class="badge badge-warning">10%</span></li>
                <li class="list-group-item">Equity Savings Required <span class="badge badge-warning">30%</span></li>
                <li class="list-group-item">Loan Processing Fee <span class="badge badge-warning">N 500</span></li>
                <li class="list-group-item">Minimum Loan Amount <span class="badge badge-warning">N 500, 000</span></li>
                <li class="list-group-item">Maximum Loan Amount <span class="badge badge-warning">N 5 Million</span></li>
                <li class="list-group-item">Maximum Loan Tenor <span class="badge badge-warning">60 Months</span></li>
                <li class="list-group-item">Membership Duration <span class="badge badge-warning">4 Months</span></li>
                <li class="list-group-item">Payslip Required <span class="badge badge-warning">Yes</span></li>
                <li class="list-group-item">Loan Payment Subject To Availability of Funds <span class="badge badge-warning">Yes</span></li>
                <li class="list-group-item">2 Guarantors <span class="badge badge-warning">Yes</span></li>
                <li class="list-group-item">Loan Processing Fee Non-Refundable <span class="badge badge-warning">Yes</span></li>
                <li class="list-group-item">Loan Subject To Queuing <span class="badge badge-warning">Yes</span></li>
                <li class="list-group-item">Payment Based on First Come, First Served <span class="badge badge-warning">Yes</span></li>
                <li class="list-group-item">Contract Staff Eligible <span class="badge badge-warning">No</span></li>
                <li class="list-group-item">Grace Period <span class="badge badge-warning">No</span></li>
            </ul>
            <div class="card-body">
                <a href="#" class="btn btn-sm btn-warning">Apply Now</a>
            </div>
        </div>

    </div>


</div> --}}
</div>
@endsection