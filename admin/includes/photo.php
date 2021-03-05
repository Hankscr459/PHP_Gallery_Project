<?php
    class Photo extends DB_object {

        protected $db_table = "photos";
        protected $db_table_fields = array('Photo_id', 'title', 'description', 'filename', 'type', 'size');
        public $Photo_id;
        public $title;
        public $description;
        public $filename;
        public $type;
        public $size;
    }
?>