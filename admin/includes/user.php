<?php require_once("init.php");
    class User extends DB_object {

        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        public $user_image;
        public $temp_path;
        public $upload_directory = "images";
        public $image_placeholder = "http://placehold.it/400x400&text=image";
        public $custom_errors = array();
        public $upload_errors_array = array(
            UPLOAD_ERR_OK        => "There is no error",
            UPLOAD_ERR_INI_SIZE  => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML",
            UPLOAD_ERR_PARTIAL   => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE   => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR=> "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE=> "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
        );

        public function set_file($file) {

            if (empty($file) || !$file || !is_array($file)) {
                $this->errors[] = "There was no file uploaded here";
                return false;
            } else if ($file['error'] != 0) {
                $this->errors[] = $this->upload_errors_array[$file['error']];
                return false;
            } else {
                $this->user_image = basename($file['name']);
                $this->temp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }

        }

        public function save_user_and_image() {

            if(!empty($this->errors)) {
                return false;
            }

            if (empty($this->user_image) || empty($this->temp_path)) {
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            if(file_exists($target_path)) {
                $this->error_get_last[] = "The file {$this->user_image} already exists";
                return false;
            }


            if(move_uploaded_file($this->temp_path, $target_path)) {
                if ($this->id) {
                    $this->update();
                } else if($this->create()) {
                    unset($this->temp_path);
                    return true;
                }
            } else {
                $this->errors[] = "the file directory probably does not have permission";
                return false;
            }

        }

        public function image_path_and_placeholder() {
            return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
        }

        public static function verify_user($username, $password) {
            global $database;

            $username = $database->escape_string($username);
            $password = $database->escape_string($password);

            $sql = "SELECT * FROM users WHERE ";
            $sql .= "username = '{$username}' ";
            $sql .= "AND password = '{$password}' ";
            $sql .= "LIMIT 1";

            $the_result_array = self::find_by_query($sql);

            return !empty($the_result_array) ? array_shift($the_result_array) : false;
        }
        
        
    }
?>