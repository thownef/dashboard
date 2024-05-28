<?php
namespace App\Libraries;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileResponseLibraries
{
    public static $mimetype = [
        'bmp' => 'image/bmp',
        'fif' => 'image/fif',
        'gif' => 'image/gif',
        'ifm' => 'image/gif',
        'ief' => 'image/ief',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'svg' => 'image/svg+xml',
        'tif' => 'image/tiff',
        'tiff' => 'image/tiff',
        'mcf' => 'image/vasa',
        'rp' => 'image/vnd.rn-realpix',
        'wbmp' => 'image/vnd.wap.wbmp',
        'ras' => 'image/x-cmu-raster',
        'fh' => 'image/x-freehand',
        'fh4' => 'image/x-freehand',
        'fh5' => 'image/x-freehand',
        'fh7' => 'image/x-freehand',
        'fhc' => 'image/x-freehand',
        'ico' => 'image/x-icon',
        'jps' => 'image/x-jps',
        'pnm' => 'image/x-portable-anymap',
        'pbm' => 'image/x-portable-bitmap',
        'pgm' => 'image/x-portable-graymap',
        'ppm' => 'image/x-portable-pixmap',
        'rgb' => 'image/x-rgb',
        'xbm' => 'image/x-xbitmap',
        'xpm' => 'image/x-xpixmap',
        'swx' => 'image/x-xres',
        'xwd' => 'image/x-xwindowdump',
        'webp' => 'image/webp',
        'pdf' => 'application/pdf',
    ];

    public $image;
    public $file;
    public $mime_type;

    public static function mimeTypeFromPath(string $path)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (!isset(self::$mimetype[$extension])) {
            return null;
        }
        return self::$mimetype[$extension];
    }
    public static function storage()
    {
        $disk = config('filesystems.default');
        return Storage::disk($disk);
    }
    public static function getImage(Request $request): FileResponseLibraries
    {
        $obj = new self();

        $storage = self::storage();

        $image_path = (!app()->isLocal()) ? $request->path : "/" . $request->path;
        $mimeType = self::mimeTypeFromPath($image_path);

        if (empty($mimeType)) {
            Log::error('Image display error' . __CLASS__ . '::' . __METHOD__ . ' line:' . __LINE__ . ' mimetype acquisition error:' . $image_path);
            abort(404);
        }

        $image = "";
        try {
            $image = $storage->get($image_path);
        } catch (Exception $e) {
            Log::error('Image display error' . __CLASS__ . '::' . __METHOD__ . ' line:' . __LINE__ . ' Entity acquisition error:' . $image_path);
            abort(404);
        }

        $obj->image = $image;
        $obj->mime_type = $mimeType;

        return $obj;
    }
    public static function getFile(Request $request): FileResponseLibraries
    {
        $obj = new self();

        $storage = self::storage();

        $file_path = (!app()->isLocal()) ? $request->path : "/" . $request->path;
        $mimeType = self::mimeTypeFromPath($file_path);

        if (empty($mimeType)) {
            Log::error('File display error' . __CLASS__ . '::' . __METHOD__ . ' line:' . __LINE__ . ' mimetype acquisition error:' . $file_path);
            abort(404);
        }
        $file = "";
        try {
            $file = $storage->get($file_path);
        } catch (Exception $e) {
            Log::error('File display error' . __CLASS__ . '::' . __METHOD__ . ' line:' . __LINE__ . ' Entity acquisition error:' . $file_path);
            abort(404);
        }

        $obj->file = $file;
        $obj->mime_type = $mimeType;

        return $obj;
    }
    public static function exists($file_path)
    {
        $storage = self::storage();
        if ($storage->exists($file_path)) {
            return true;
        }
        return false;
    }
    public static function makeDirectory($folder_path)
    {
        $storage = self::storage();
        $storage->makeDirectory($folder_path);
    }
    public static function deleteDirectory($folder_path)
    {
        $storage = self::storage();
        $storage->deleteDirectory($folder_path);
    }
    public static function copy($from, $to)
    {
        $storage = self::storage();
        $storage->copy($from, $to);
    }
    public static function uploadFile($file, $file_path, $file_name)
    {
        $storage = self::storage();
        $storage->putFileAs($file_path, $file, $file_name);
    }
    public static function deleteFile($file_path, $file_name)
    {
        $storage = self::storage();
        $full_file_path = $file_path . $file_name;
        if ($storage->exists($full_file_path)) {
            $storage->delete($full_file_path);
        }
    }
}
