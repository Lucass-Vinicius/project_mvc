<?php 
namespace Src\Video\models\Entity;

use Src\Video\models\Db\Database;
use PDO;

class Video
{
    public int $id;
    public string $url;
    public string $title;

    public function cadastrar(): bool
    {
        // $this->ts_inclusao = date('Y-m-d H:i:s');

        //Inserir o video no banco
        $obDatabase = new Database('videos');
        $obDatabase->insert([
            'url' => $this->url,
            'title' => $this->title,
            // 'ts_inclusao' => $this->ts_inclusao,
        ]);

        return true;
    }

    public function atualizar(): bool
    {
        return (new Database('videos'))->update('id = ' . $this->id, [
            'url' => $this->url,
            'title' => $this->title
        ]);
    }

    public function excluir(): bool
    {
        // $this->cancellation_ts = date('Y-m-d H:i:s');
        // return (new Database('videos'))->update('id = '.$this->id,[
        //     'ts_cancelamento' => $this->cancellation_ts
        // ]);
        return (new Database('videos'))->delete('id = ' . $this->id);
    }

    public static function getVideos()
    {
        return (new Database('videos'))->select('id, url, title')->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    
    public static function getVideo(int $id): object
    {
        return (new Database('videos'))->select('id, url, title','id = '.$id)->fetchObject(self::class);
    }
}