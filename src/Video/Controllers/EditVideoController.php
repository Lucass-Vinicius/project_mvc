<?php 

namespace Src\Video\Controllers;

use Src\Video\models\Entity\Video;

class EditVideoController implements Controller
{
    public function __construct(private Video  $obVideo)
    {
        $obVideo = new Video;
    }
    public function processaRequisicao(): void 
    {        
        //VALIDAÇÂO DO ID
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!isset($id)) {
            // header('location: /');
            exit();
        }
        
        $this->obVideo = Video::getVideo($id);

        //VALIDAÇÃO DO VIDEO
        if (!$this->obVideo instanceof Video) {
            // header('location: /');
            exit();
        }

        //VALIDAÇÃO DO POST
        if (isset($_POST['url'], $_POST['titulo'])) {
            $this->obVideo->url =  $_POST['url'];
            $this->obVideo->title = $_POST['titulo'];
            $this->obVideo->atualizar();
            header('location: /');
            exit();
        }
    }
}