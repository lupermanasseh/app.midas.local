@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Membership Register</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <table class="highlight" id="users-table">
                <thead>
                    <tr>
                        <th>REG ID</th>
                        <th>LAST NAME</th>
                        <th>FIRST NAME</th>
                        <th>MEMBERSHIP TYPE</th>
                        <th>IPPIS</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($activeUsers as $user)
                    <tr>
                        <td><a href="/saving/listings/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
                </td>
                <td>{{$user->status}}</td>
                <td>{{$user->usersavings_count}}</td>
                </tr>
                @endforeach
                </tbody> --}}
            </table>
            {{-- {{$activeUsers->links()}} --}}
            {{-- @else
            <p>No Records Yet</p>
            @endif --}}
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route(/usersData) !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'last_name', name: 'last_name' },
            { data: 'first_name', name: 'first_name' },
            { data: 'membership_type', name: 'membership_type' },
            { data: 'payment_number', name: 'payment_number' },
            { data: 'status', name: 'status' }
        ]
    });
});
</script>
@endpush