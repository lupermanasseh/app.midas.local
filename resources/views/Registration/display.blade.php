<table class="highlight">
    <thead>
        <tr>
            <th>NAME</th>
            <th>SEX</th>
            <th>REG NO</th>
            <th>STAFF NO</th>
            <th>PHONE</th>
            <th>DEPT</th>
            <th>CADRE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $active)
        <tr>
            <td>
                <a href="/user/page/{{$active->id}}">{{$active->first_name}} {{$active->last_name}}</a>
            </td>
            <td>{{$active->sex}}</td>
            <td>{{$active->membership_type}}/{{$active->id}}</td>
            <td>{{$active->staff_no}}</td>
            <td>{{$active->phone}}</td>
            <td>{{$active->dept}}</td>
            <td>{{$active->job_cadre}}</td>
        </tr>
        @endforeach
    </tbody>
</table>