@extends('layout')

@section('title')
    {{ __(key: 'Update Connection') }}
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10">
            <h2 class="pb-2">{{ __("Update Connection") }}</h2>
        </div>

        <div class="py-5">
            <form
                action="{{ route("connections.update", ['id' => $connection->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                @include('connection.form')
            </form>
        </div>

    </div>

@endsection

@section('scripts')
@endsection
