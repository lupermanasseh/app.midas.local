@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">SAVING REGISRTAION:: BULK UPLOAD</span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/saving-reg/process" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">

                <div class="file-field input-field col s12 m6 l6">
                    <div class="btn">
                        <span>Browse</span>
                        <input type="file" name="savingreg_import">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Choose xlsx file">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn">Upload SAVING DETAILS</button>
        </form>
    </div>
</div>
@endsection