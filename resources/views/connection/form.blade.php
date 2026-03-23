@php use App\Shared\Enums\ImuisDataTableEnum; @endphp

<div class="col-sm-10">
    {!! Html::Input(6, 'text', "name", "Name", $connection->name ?? null) !!}
    {!! Html::Input(6, 'text', "administration_code", "Administration Code", $connection?->options?->administrationCode ?? null) !!}
    {!! Html::Input(6, 'text', "partner_key", "Partner Key", $connection?->options?->partnerKey ?? null) !!}
    {!! Html::Input(6, 'text', "auth_code", "Auth Code", $connection?->options?->authCode ?? null) !!}
    {!! Html::Input(6, 'text', "url", "Url", $connection?->options?->url ?? config('external.imuis.url')) !!}
    {!! Html::SelectMulti(6, 'tables', 'Tables', ImuisDataTableEnum::List(), $connection?->options?->tables ?? []) !!}
    {!! Html::Input(6, 'text', "description", "Description", $connection?->description ?? null) !!}
    {!! Html::Checkbox("is_active", "Active", 1, $connection?->isActive ?? true, true) !!}
</div>

<div class="col-10">
    {!! Html::Button(6, "submit","save", "Save", ['class' => 'btn btn-outline-success']) !!}
</div>

