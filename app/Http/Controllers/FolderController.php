<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolderRequest;
use App\Models\File;
use App\Traits\FolderRoot;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FolderController extends Controller
{
    use FolderRoot;

    public function create(CreateFolderRequest $request)
    {
        $data = $request->validated();
        $parent = $request->parent;

        if (! $parent) {
            $parent = $this->getRoot();
        }

        $folder = new File([
            'name' => $data['name'],
            'is_folder' => true,
        ]);

        $parent->appendNode($folder);
    }
}
