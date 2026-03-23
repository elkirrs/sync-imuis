@extends('layout')

@section('title')
{{ __("Connections") }}
@endsection

@section('content')
<div class="row">

    @include('alert')

    <div class="col-sm-10">
        <h2 class="pb-2">{{ __(key: "Connections") }}</h2>
    </div>

    <div class="col-sm-2 position-relative">
        <div class="position-absolute top-0 end-0">
            {!! Html::Link(route('connections.create'), "Create new", ['class' => "btn btn-outline-success"]) !!}
        </div>
    </div>
</div>


<div class="py-5">
    {!! $dataTable->table() !!}
</div>

@include('delete-form')

@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
