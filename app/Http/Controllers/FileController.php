<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Models\File;
use App\Traits\FolderRoot;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FileController extends Controller
{
    use FolderRoot;

    public function index()
    {
        $folder = $this->getRoot();

        return $this->render($folder);
    }

    public function folder(string $folder)
    {
        $folder = File::query()
            ->whereCreatedBy(Auth::id())
            ->wherePath($folder)
            ->firstOrFail();

        return $this->render($folder);
    }

    public function shared()
    {
        return Inertia::render('Dashboard');
    }

    public function trash()
    {
        return Inertia::render('Dashboard');
    }

    protected function render(File $folder)
    {
        $files = File::query()
            ->whereParentId($folder->id)
            ->whereCreatedBy(Auth::id())
            ->orderByDesc('is_folder')
            ->orderByDesc('created_at')
            ->paginate(10);

        $files = FileResource::collection($files);

        $ancestors = FileResource::collection([...$folder->ancestors, $folder]);

        $folder = new FileResource($folder);

        return Inertia::render('Profile/Files', compact('ancestors', 'folder', 'files'));
    }
}
