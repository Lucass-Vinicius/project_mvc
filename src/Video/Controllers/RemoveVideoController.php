<?php 

namespace Src\Video\Controllers;

use Src\Video\models\Entity\Video;

class RemoveVideoController implements Controller
{
    public function __construct(Private Video $obVideo)
    {
        $this->obVideo = new Video;
    }
    
    public function processaRequisicao(): void
    {
        if (isset($_GET['id'])) {
            $this->obVideo->id = $_GET['id'];
            $this->obVideo->excluir();
            header('Location: /');
            exit;
        } else {
            echo 'Erro';
            exit;
        }
    }
}