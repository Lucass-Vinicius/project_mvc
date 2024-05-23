<?php 
// declare(strict_types=1);

namespace Src\Video\models\Db;

use \PDO; 
use \PDOException;

class Database 
{
    public $connection;
    
    public function __construct(public $table = null)
    {
        $this->table = $table;
        $this->setConnection(); 
    }
    
    private function setConnection(): void 
    {
        try {
            $dsn = "pgsql:host=".HOST.";port=".PORT.";dbname=".NAME;
            $this->connection = new PDO($dsn, USER, PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    public function execute(string $query,array $params = [])
    {
        try {
            $statment = $this->connection->prepare($query);
            $statment->execute($params);
            return $statment;
        } catch (PDOException $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    public function insert(array $values): string
    {
        try {
            //DADOS DA QUERY
            $fields = array_keys($values);
            $binds = array_pad([],count($fields),'?');
            
            //MONTA A QUERY
            // $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
            $query = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(',', $fields),
                implode(',', $binds)
            );
            
            //Excuta O INSERT 
            $this->execute($query,array_values($values));
            
            
            //RETORNA O ID INSERIDO 
            return $this->connection->lastInsertId();
            // $video->setId($this->connection->lastInsertId());
        } catch (PDOException $e) {
            return 'erro';
        }
    }

    public function select (string $fields = '*', string $where = null, string $order = null, string $limit = null): object
    {
        // DADOS DA QUERY

        $where = !empty($where) ? 'WHERE '.$where : '';
        $order = !empty($order) ? 'ORDER BY '.$order : '';
        $limit = !empty($limit) ? 'LIMIT '.$$limit : '';

        // MONTA A QUERY 
        $query = sprintf(
            'SELECT %s FROM %s %s %s %s',
            $fields, 
            $this->table,
            $where,
            $order,
            $limit
        );
        return $this->execute($query);
    }
    
    // Método responsável por executar a atualização no banco de dados
    public function update(string $where,array $values): bool
    {
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        // $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fileds).'=? WHERE '.$where;
        $query = sprintf(
            'UPDATE %s SET %s WHERE %s',
            $this->table,
            implode('=?,', $fields) . '=?',
            $where
        );
        

        //EXEUTA A QUERY
        $this->execute($query,array_values($values));
        return true;
    }

    //Método responsável por deletar dados do banco
    public function delete (string $where): bool
    {
        //MONTA A QUERY
        // $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
        $query = sprintf(
            'DELETE FROM %s WHERE %s',
            $this->table,
            $where
        );

        //EXEUTA A QUERY
        $this->execute($query);
        return true;
    }
}