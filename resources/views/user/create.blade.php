@extends('layout')

@section('title')
    {{ __(key: 'Create User') }}
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10">
            <h2 class="pb-2">{{ __("Create User") }}</h2>
        </div>


        <div class="py-5">
            <form
                action="{{ route("users.store") }}"
                method="POST">
                @csrf
                @include('user.form')
            </form>
        </div>
    </div>


    <div>
    </div>

@endsection

@section('scripts')
@endsection
