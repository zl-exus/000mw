<?php
namespace classes;

use PDO;

class Db
{

    const USER = DB_USER;
    const PASS = DB_PASS;
    const HOST = DB_HOST;
    const DB   = DB_NAME;

    public static function connectDb()
    {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $connect = new PDO("mysql:dbname=$db;host=$host;", $user, $pass, $options);
        } catch (PDOException $ex) {
            echo '<br>Подключить бд не удалось ' . $ex->getMessage() . ' <br>';
        }

        return $connect;
    }

    private function getTablesNames()
    {
        /*
         * The utility method for obtaining all the names of tables from the 
         * working database for transfer to some metodod, etc.
         * 
         * @return array of all table names from the working database
         */
        $tables = $this->connectDb()->query('SHOW TABLES from ' . self::DB)->fetchAll();
        foreach ($tables as $tables => $table_name) {
            foreach ($table_name as $name) {
                $tables_names[] = $name;
            }
        }
        return $tables_names;
    }
    
    private function buildQueryForTable($name)
    {
        /*
         * The service method that forms the query string to retrieve table data 
         * based on the table name
         * 
         * @param string $name expected table name 
         * 
         * @return string structurally prepared for use in the query
         */
        $tables_names = $this->getTablesNames();
        foreach ($tables_names as $table_name) {
            if ($name === $table_name) {
                $table_name_for_query = $name;
            } else {
                exit('Wrong table name in: ' . next(debug_backtrace())['function']);
            }
        }

        $query = "SELECT * FROM . $table_name_for_query";
        return $query;
    }

    public function getTable($name, $key = '')
    /*
     *  Returns the associative array formed from the table.
     * 
     *  @param string $name
     * 
     *  @return array <b>PDO::FETCH_ASSOC</b> returns an array containing
     *  all of the remaining rows in the result set.
     */
    {
        if (isset($name)) {
            try {
                $sql = $this->buildQueryForTable($name);
                $table = $this->connectDb()->prepare($sql);
                $table->bindValue(1, $name, PDO::PARAM_STR);
                $table->execute();
                $table_data = $table->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                echo '<br>Возникла ошибка при попытке извлечь данные: ' . $ex->getMessage() . ' <br>';
            }
        }
        return $table_data;
    }

    public function getMessagesArray()   
    {
        try {
            $mess_array = $this->connectDb()->query('SELECT * FROM message_header, message_body WHERE message_header.post_id = message_body.post_id ORDER BY posted DESC')->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo '<br>Возникла ошибка при попытке извлечь данные: ' . $ex->getMessage() . ' <br>';
        }
        return $mess_array;
    }

    public function addMessage($user_id, $text, $parent_post_id = 0, $has_children = 0)
    {

        $sql = 'BEGIN; 
                  INSERT INTO message_header (parent_post_id, author_id, has_children) VALUES(?, ?, ?);
                  INSERT INTO message_body (post_id, post_text) VALUES(LAST_INSERT_ID(), ?);
                  COMMIT;';
        $addmess = $this->connectDb()->prepare($sql);
        $addmess->bindValue(1, $parent_post_id);
        $addmess->bindValue(2, $user_id); // need get author_id!!!!
        $addmess->bindValue(3, $has_children);
        $addmess->bindValue(4, $text);
        $addmess->execute();
    }

    public function addUserVk($user_data)
    {
        $succes = '';
        if (isset($user_data)) {
            $sql = 'INSERT INTO authors (first_name, last_name, soc_id) VALUES(?, ?, ?);';
            $add_user = $this->connectDb()->prepare($sql);
            $add_user->bindValue(1, $user_data['first_name'], PDO::PARAM_STR);
            $add_user->bindValue(2, $user_data['last_name'], PDO::PARAM_STR);
            $add_user->bindValue(3, $user_data['uid'], PDO::PARAM_STR);
            $success = $add_user->execute();
        }
        return $success;
    }

    public function isRegstredVk($user_data)
    {
        $isRegistred = false;

        if (isset($user_data['uid'])) {
            $sql = 'SELECT EXISTS(SELECT * FROM `authors` WHERE `soc_id` LIKE ?);';
            $query = $this->connectDb()->prepare($sql);
            $query->bindValue(1, $user_data['uid'], PDO::PARAM_INT);
            $query->execute();
            $rows_count = $query->fetch(PDO::FETCH_NUM);
            if ($rows_count[0] != 0) {
                $isRegistred = true;
            }
        }

        return $isRegistred;
    }

    public function getAuthorId($user_data)
    {
        if (isset($user_data['id'])) {
            $sql = 'SELECT * FROM `authors` WHERE `soc_id` LIKE ?;';
            $query = $this->connectDb()->prepare($sql);
            $query->bindValue(1, $user_data['id'], PDO::PARAM_INT);
            $query->execute();
            $res = $query->fetch();
            print_r($res);
        }
        return $authorId = 0;
    }
}
