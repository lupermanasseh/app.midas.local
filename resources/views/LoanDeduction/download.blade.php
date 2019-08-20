<table class="highlight">
    <thead>
        <tr>

            <th>S/NO</th>
            <th>NAME</th>
            <th>USER ID</th>
            <th>PRODUCT</th>
            <th>PRODUCT ID</th>
            <th>AMOUNT</th>
            <th>SUBSCRIPTION ID</th>
            <th>DATE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loanSub as $active)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$active->user->first_name}} {{$active->user->last_name}}</td>
            <td>{{$active->user_id}}</td>
            <td>{{$active->product->name}}</td>
            <td>{{$active->product_id}}</td>
            <td>{{$active->monthly_deduction}}</td>
            <td>{{$active->id}}</td>
        </tr>
        @endforeach
    </tbody>
</table>