<div class="col-sm-10">
    {!! Html::Input(6, 'text', "username", __("Username"), $model->username ?? null) !!}
    {!! Html::Input(6, 'text', "email", __("Email"), $model->email ?? null) !!}
    {!! Html::Input(6, 'password', "password", __("Password"), null) !!}
    {!! Html::Input(6, 'password', "password_confirmation", __("Confirm Password"), null) !!}
</div>

<div class="col-10">
    {!! Html::Button(6, "submit","save", __("Save"), ['class' => 'btn btn-outline-primary']) !!}
</div>

