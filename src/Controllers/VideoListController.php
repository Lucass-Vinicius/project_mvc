<?php 

namespace Src\Controllers;

use Src\Entity\Video;

class VideoListController implements Controller
{    
    public function __construct(private Video $videos)
    {
    }
    
    public function processaRequisicao(): void 
    {
        $videos = Video::getVideos();
        require_once __DIR__ .'/../views/video-list.php';
    }
}