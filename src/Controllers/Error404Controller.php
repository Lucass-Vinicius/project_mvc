<?php 

namespace Src\Controllers;

class Error404Controller implements Controller
{
    public function processaRequisicao(): void 
    {
        header('location: /pages/erro-404.html');
    }
}