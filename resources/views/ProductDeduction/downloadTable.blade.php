<table class="highlight">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Product</th>
            <th>Product ID</th>
            <th>Units</th>
            <th>Subscription ID</th>
            <th>Notes</th>
            <th>Monthly RePay</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allProductSub as $active)
        <tr>
            <td>{{$active->user_id}}</td>
            <td>{{$active->user->first_name}} {{$active->user->last_name}}</td>
            <td>{{$active->product->name}}</td>
            <td>{{$active->product->id}}</td>
            <td>{{$active->units}}</td>
            <td>{{$active->id}}</td>
            <td>{{$active->notes}}</td>
            <td>{{$active->monthly_repayment}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>