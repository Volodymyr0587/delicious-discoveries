<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageUploadService
{
    public function upload(?UploadedFile $file): ?string
    {
        if (!$file) {
            return null;
        }

        return $file->store('images', 'public');
    }
}
