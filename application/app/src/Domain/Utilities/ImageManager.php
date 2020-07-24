<?php


namespace App\src\Domain\Utilities;


class ImageManager
{
    public function imageStorage($image)
    {
        $fileFullName = $image->getClientOriginalName();
        $filename = pathinfo($fileFullName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $file = time() . '_' . $filename . '.' . $extension;
        $image->storeAs('public/articles/', $file);

        return $file;
    }

}
