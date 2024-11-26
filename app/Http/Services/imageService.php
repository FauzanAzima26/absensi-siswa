<?php

namespace App\Http\Services;

use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class imageService
{
    public function storeImage(array $data, string $oldImage = null)
    {
        $file = $data['image'];
        $image_name = uniqid() . '.' . 'webp';
        $path = storage_path(). '/app/public/images/';

        // make folder
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // create new manager instance with desired driver
        $intervention = new ImageManager(new Driver());

        // generate image
        $intervention->read($file)->scale(width: 900)->toWebp(100)->save($path . $image_name);

        if ($oldImage) {
            if (file_exists($path . $oldImage)) {
                unlink($path . $oldImage);
            }
        }

        return $image_name;
    }

    public function deleteImage(string $image, string $path)
    {
        return Storage::disk('public')->delete($path .'/'. $image);
    }
}