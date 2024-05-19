<?php

namespace App\Listeners;

use App\Models\File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserFolderListener
{

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;

        $folder = new File();
        $folder->name = $user->email;
        $folder->is_folder = true;

        $folder->makeRoot()
            ->save();
    }
}
