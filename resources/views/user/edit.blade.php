@extends('layout')

@section('title')
    {{ __(key: 'Update User') }}
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10">
            <h2 class="pb-2">{{ __("Update User") }}</h2>
        </div>


    </div>
    <div class="py-5">
        <form
            action="{{ route("users.update", ['id' => $model->id]) }}"
            method="POST">
            @csrf
            @method('PUT')
            @include('user.form')
        </form>
    </div>

    <div>
    </div>

@endsection

@section('scripts')
@endsection
