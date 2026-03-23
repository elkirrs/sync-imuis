@extends('layout')

@section('title')
    {{ __('Sync Jobs') }}
@endsection

@section('content')
    <div class="row">

        @include('alert')

        <div class="col-sm-10">
            <h2 class="pb-2">{{ __("Sync Jobs") }}</h2>
        </div>

        <div class="col-sm-2 position-relative">
            @if($isAdmin ?? false)
                <div class="position-absolute top-0 end-0">
                    {!! Html::Link(
                    route('sync.run'),
                    "Sync All",
                    [
                        'class' => "btn btn-outline-success",
                        'onclick' => 'return confirm(\'Are you sure you want to start the full sync process?\');'
                    ]
                ) !!}

{{--                    {!! Html::Button(12, 'button', 'syncOne', 'Sync One', [--}}
{{--                        'class' => 'btn btn-outline-success',--}}
{{--                        'onclick' => 'genModal(this)'--}}
{{--                        ]) !!}--}}

                </div>
            @endif
        </div>
    </div>


    <div>
        {!! $dataTable->table() !!}
    </div>

@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection
