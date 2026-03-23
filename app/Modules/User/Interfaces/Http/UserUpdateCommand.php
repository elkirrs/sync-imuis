<?php

declare(strict_types=1);

namespace App\Modules\User\Interfaces\Http;

use app\Http\Requests\Web\User\UpdateRequest;
use App\Modules\User\Application\Commands\UserSaveCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Http\RedirectResponse;
use Throwable;

final readonly class UserUpdateCommand
{
    public function __construct(
        protected CommandBus $commandBus,
    ) {}

    public function __invoke(
        UpdateRequest $request,
        int $id
    ): RedirectResponse {

        $data = $request->all();

        try {

            $this->commandBus->dispatch(
                new UserSaveCommand(
                    $id,
                    $data['username'],
                    $data['email'],
                    $data['password'],
                    $data['is_active'] ?? true
                )
            );

            $status = 'success';
            $msg = __('User was successfully updated.');

        } catch (Throwable $th) {
            $status = 'error';
            $msg = $th->getMessage();
        }

        return redirect()->route('users.index')
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
