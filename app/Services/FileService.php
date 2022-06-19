<?php

namespace Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function upload($file, $path = null)
    {
        if (!is_null($file)) {
            is_null($path) ?? $this->delete($path);

            $path = 'public/uploads/files/' . $this->guard() . '/' . auth()->id() . '/';

            Storage::disk('local')->makeDirectory($path);

            $name = time() . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs($path, $file, $name);

            return substr($path, 7) . $name;
        }

        return $path;
    }

    public function delete($path): bool
    {
        return Storage::delete($path);
    }

    private function guard(): string
    {
        if (auth('admin')->check()) {
            return 'admin';
        }

        return 'user';
    }
}
