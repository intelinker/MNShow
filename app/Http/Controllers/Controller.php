<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file, $path) {
        $destPath = 'images/'.$path.'/';
        $fileName = $file->getClientOriginalName();
        $saveFile = $file->move($destPath, $fileName);
        $fileType = substr(strrchr($fileName, '.'), 1);
        $justName = explode(".", $fileName)[0];
        if ($fileType == "mp4" || $fileType == "mpeg") {
            $video = $this->ffmpeg->fromDisk('video')->open($fileName);

            $duration = $video->getDurationInSeconds();
//                        dd($duration);

            $video->getFrameFromSeconds($duration / 3)->export()->toDisk('video')->save($justName.".jpg");
        }
//        dd($saveFile);
        if ($saveFile != null)
            return '/'.$destPath.$fileName;
        else
            return null;
    }
}
