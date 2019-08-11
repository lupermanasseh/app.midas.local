@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ALL CATEGORIES</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/product/category/add"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create Category">playlist_add</i></a></span>

            <span><a href="/product/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create Items">add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($categories)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td><a href="/category/items/{{$category->id}}">{{$category->name}}</a></td>
                        <td>{{$category->description}}</td>
                        <td><a href="/product/category/edit/{{$category->id}}"><i class="material-icons">create</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No product category added yet</p>
            <span><a href="/product/category/add" class="btn red lighten-2"><i class="material-icons">add</i></a></span>
            @endif
        </div>
    </div>
</div>
@endsection