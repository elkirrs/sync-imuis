@extends('layout')

@section('title')
    {{ __(key: 'Create Connection') }}
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10">
            <h2 class="pb-2">{{ __("Create Connection") }}</h2>
        </div>


        <div class="py-5">
            <form
                action="{{ route("connections.store") }}"
                method="POST">
                @csrf
                @include('connection.form')
            </form>
        </div>

    </div>

@endsection

@section('scripts')
@endsection
