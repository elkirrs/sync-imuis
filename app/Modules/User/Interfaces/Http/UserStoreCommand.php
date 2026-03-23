<?php

declare(strict_types=1);

namespace App\Modules\User\Interfaces\Http;

use App\Http\Requests\Web\User\StoreRequest;
use App\Modules\User\Application\Commands\UserSaveCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Throwable;

final readonly class UserStoreCommand
{
    public function __construct(
        private CommandBus $commandBus
    ) {}

    public function __invoke(
        StoreRequest $request
    ): RedirectResponse {
        $data = $request->all();

        try {

            $this->commandBus->dispatch(
                new UserSaveCommand(
                    0,
                    $data['username'],
                    $data['email'],
                    Hash::make($data['password']),
                    true,
                )
            );

            $status = 'success';
            $msg = __('User created successfully');

        } catch (Throwable $th) {
            $status = 'error';
            $msg = $th->getMessage();
        }

        return redirect()->route('users.index')
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
