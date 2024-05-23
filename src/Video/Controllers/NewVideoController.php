<?php 

namespace Src\Video\Controllers;

use Src\Video\models\Entity\Video;

class NewVideoController implements Controller
{
    public function __construct(Private Video $obVideo)
    {
        $this->obVideo = new Video;
    }

    public function processaRequisicao(): void
    {
        if (!isset($_POST['url']) && !isset($_POST['titulo'])) {
            header('Location: /');
            exit;
        }

        //Inserção vídeo no banco de dados
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($url === false || $titulo === false) {
            header('Location: /');
            exit;
        }

        $this->obVideo->url = $url;
        $this->obVideo->title = $titulo;
        $this->obVideo->cadastrar();
        header('Location: /');
    }
}