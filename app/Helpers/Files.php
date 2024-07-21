<?php

namespace App\Helpers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yoeunes\Toastr\Toastr;

class Files {
    const UPLOAD_FOLDER = 'uploads';

    public static function upload($image, string $dir): string
    {
        // To upload files to local server
        config(['filesystems.default' => 'local']);

        $uploadedFile = $image;
        $folder = $dir . '/';

        self::validateUploadedFile($uploadedFile);

        $newName = self::generateNewFileName($uploadedFile->getClientOriginalName());

        $tempPath = public_path(self::UPLOAD_FOLDER . '/temp/' . $newName);

        /** Check if folder exits or not. If not then create the folder */
        self::createDirectoryIfNotExist($folder);

        $newPath = $folder . '/' . $newName;

        $uploadedFile->storeAs('temp', $newName);

        Storage::put($newPath, File::get($tempPath), ['public']);

        // Deleting temp file
        File::delete($tempPath);


        return $newName;
    }

    public static function validateUploadedFile($uploadedFile): bool|Toastr
    {
        if (!$uploadedFile->isValid()) {
            return toastr()->error('File was not uploaded correctly');
        }

        if ($uploadedFile->getClientOriginalExtension() === 'php' || $uploadedFile->getMimeType() === 'text/x-php') {
            return toastr()->error('You are not allowed to upload the php file on server');
        }

        if ($uploadedFile->getClientOriginalExtension() === 'sh' || $uploadedFile->getMimeType() === 'text/x-shellscript') {
            return toastr()->error('You are not allowed to upload the shell script file on server');
        }

        if ($uploadedFile->getClientOriginalExtension() === 'htaccess') {
            return toastr()->error('You are not allowed to upload the htaccess file on server');
        }

        if ($uploadedFile->getClientOriginalExtension() === 'xml') {
            return toastr()->error('You are not allowed to upload the xml file on server');
        }

        if ($uploadedFile->getSize() <= 10) {
            return toastr()->error('File size is too small');
        }
        return true;
    }

    public static function generateNewFileName($currentFileName): string
    {
        $ext = strtolower(File::extension($currentFileName));
        $newName = md5(microtime());

        return ($ext === '') ? $newName : $newName . '.' . $ext;
    }

    public static function createDirectoryIfNotExist($folder): void
    {
        /** Check if folder exits or not. If not then create the folder */
        if (!File::exists(public_path(self::UPLOAD_FOLDER . '/' . $folder))) {
            File::makeDirectory(public_path(self::UPLOAD_FOLDER . '/' . $folder), 0775, true);
        }
    }
}
