<?php 

namespace Src\Video\Controllers;

use Src\Video\models\Entity\Video;

class VideoFormController implements Controller
{
    public function __construct(private Video $video)
    {
    }
    public function processaRequisicao(): void 
    {
        if (isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            Video::getVideo($id);
        }
        require_once __DIR__.'/../views/video-form.php';
    }
}