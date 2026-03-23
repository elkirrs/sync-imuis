@extends('layout')

@section('title')
    {{ __('Users') }}
@endsection

@section('content')
    <div class="row">

        @include('alert')

        <div class="col-sm-10">
            <h2 class="pb-2">{{ __("Users") }}</h2>
        </div>

        <div class="col-sm-2 position-relative">
            @if($isAdmin)
                <div class="position-absolute top-0 end-0">
                    {!! Html::Link(route('users.create'), "Create new", ['class' => "btn btn-outline-success"]) !!}
                </div>
            @endif
        </div>
    </div>


    <div>
        {!! $dataTable->table() !!}
    </div>

    @include('delete-form')

@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection
