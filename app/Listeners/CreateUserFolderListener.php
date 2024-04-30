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

        $folder = File::create([
            'name' => $user->id,
            'is_folder' => true,
        ]);

        $folder->makeRoot()
            ->save();
    }
}
