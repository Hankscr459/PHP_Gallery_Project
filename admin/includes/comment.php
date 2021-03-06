<?php require_once("init.php");
    class Comment extends DB_object {

        protected static $db_table = "users";
        protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');
        public $id;
        public $photo_id;
        public $author;
        public $body;
        
    }
?>