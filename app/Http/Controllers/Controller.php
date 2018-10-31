<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Pbmedia\LaravelFFMpeg\FFMpeg;
use FFMpeg\FFProbe;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $ffmpeg;

    /**
     * Controller constructor.
     * @param $ffmpeg
     */
    public function __construct(FFMpeg $ffmpeg)
    {
        $this->ffmpeg = $ffmpeg;
    }


    public function uploadFile($file, $path) {
        $destPath = 'images/'.$path.'/';
        $fileName = $file->getClientOriginalName();
        $saveFile = $file->move($destPath, $fileName);
        $fileType = substr(strrchr($fileName, '.'), 1);
        $justName = explode(".", $fileName)[0];
        $duration = 0;
        $mediaPath = '/'.$destPath.$fileName;
        $imagePath = $mediaPath;
        if ($fileType == "mp4" || $fileType == "mpeg"|| $fileType == "avi") {
            $video = $this->ffmpeg->fromDisk('video')->open($fileName);

            $duration = $video->getDurationInSeconds();
//                        dd($duration);

            $video->getFrameFromSeconds($duration / 3)->export()->toDisk('video')->save($justName.".jpg");
            $imagePath = '/'.$destPath.$justName.".jpg";
        }
//        dd($saveFile);
        if ($saveFile != null)
            return ["path" => $mediaPath, "duration" => $duration, "imagePath"=>$imagePath];
        else
            return null;
    }
}
