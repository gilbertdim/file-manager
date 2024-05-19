<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Support\Facades\Auth;

trait FolderRoot
{
    private function getRoot(): File
    {
        return File::query()
            ->whereIsRoot()
            ->whereCreatedBy(Auth::id())
            ->firstOrFail();
    }
}
