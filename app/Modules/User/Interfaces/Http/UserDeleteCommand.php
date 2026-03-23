<?php

declare(strict_types=1);

namespace App\Modules\User\Interfaces\Http;

use App\Modules\User\Application\Commands\UserDeleteCommand as DeleteUserCommand;
use App\Shared\Infrastructure\Bus\CommandBus;
use Illuminate\Http\RedirectResponse;
use Throwable;

final readonly class UserDeleteCommand
{
    public function __construct(
        private CommandBus $commandBus
    ) {}

    public function __invoke(
        int $id
    ): RedirectResponse {

        try {

            $this->commandBus->dispatch(
                new DeleteUserCommand($id)
            );

            $status = 'success';
            $msg = __('User deleted successfully');

        } catch (Throwable $th) {
            $status = 'error';
            $msg = $th->getMessage();
        }

        return redirect()->route('users.index')
            ->with('status', $status)
            ->with('msg', $msg);
    }
}
