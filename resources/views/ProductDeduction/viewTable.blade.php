<table class="highlight">
    <thead>
        <tr>

            <th>Name</th>
            <th>User ID</th>
            <th>Product</th>
            <th>Product ID</th>
            <th>Units</th>
            <th>Sub ID</th>
            <th>Monthly RePay</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allProductSub as $active)
        <tr>
            <td>{{$active->user->first_name}} {{$active->user->last_name}}</td>
            <td>{{$active->user_id}}</td>
            <td>{{$active->product->name}}</td>
            <td>{{$active->product->id}}</td>
            <td>{{$active->units}}</td>
            <td>{{$active->id}}</td>
            <td>{{number_format($active->monthly_repayment,2,'.',',')}}</td>
            <td><a href="/product-subDetail/{{$active->id}}">More</a></td>
        </tr>
        @endforeach
    </tbody>
</table>