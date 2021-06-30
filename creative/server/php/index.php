<?php


$config = require '../../../includes/config.php';

$options = array(
    'delete_type' => 'POST',
    'db_host' => 'localhost',
    'db_user' => $config['user'],
    'db_pass' => $config['password'],
    'db_name' => $config['db_name'],
    'db_table' => 'files'
);

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {

    protected function initialize() {
        $this->db = new mysqli(
            $this->options['db_host'],
            $this->options['db_user'],
            $this->options['db_pass'],
            $this->options['db_name']
        );
        parent::initialize();
        $this->db->close();
    }

    protected function handle_form_data($file, $index) {
        $file->url = @$_REQUEST['url'][$index];
        $file->description = @$_REQUEST['description'][$index];
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
                                          $index = null, $content_range = null) {
        $file = parent::handle_file_upload(
            $uploaded_file, $name, $size, $type, $error, $index, $content_range
        );
        if (empty($file->error)) {
            $sql = 'INSERT INTO `'.$this->options['db_table']
                .'` (`name`, `size`, `type`, `url`, `description`)'
                .' VALUES (?, ?, ?, ?, ?)';
            $query = $this->db->prepare($sql);
            $query->bind_param(
                'sisss',
                $file->name,
                $file->size,
                $file->type,
                $file->url,
                $file->description
            );
            $query->execute();
            $file->id = $this->db->insert_id;
        }
        return $file;
    }

    protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sql = 'SELECT `id`, `type`, `url`, `description` FROM `'
                .$this->options['db_table'].'` WHERE `name`=?';
            $query = $this->db->prepare($sql);
            $query->bind_param('s', $file->name);
            $query->execute();
            $query->bind_result(
                $id,
                $type,
                $url,
                $description
            );
            while ($query->fetch()) {
                $file->id = $id;
                $file->type = $type;
                $file->url = $url;
                $file->description = $description;
            }
        }
    }

    public function delete($print_response = true) {
        $response = parent::delete(false);
        foreach ($response as $name => $deleted) {
            if ($deleted) {
                $sql = 'DELETE FROM `'
                    .$this->options['db_table'].'` WHERE `name`=?';
                $query = $this->db->prepare($sql);
                $query->bind_param('s', $name);
                $query->execute();
            }
        }
        return $this->generate_response($response, $print_response);
    }

}

$upload_handler = new CustomUploadHandler($options);