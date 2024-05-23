<?php

use Src\Video\Controllers\{
    VideoListController,
    EditVideoController,
    VideoFormController,
    RemoveVideoController,
    NewVideoController,
};

return [
    'GET/' => VideoListController::class,
    'GET/novo-video' => VideoFormController::class,
    'POST/novo-video' => NewVideoController::class,
    'GET/editar-video' => VideoFormController::class,
    'POST/editar-video' => EditVideoController::class,
    'GET/remover-video' => RemoveVideoController::class,
];