<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

if (!function_exists('uploadFile')) {
    function uploadFile($file, $params = null)
    {
        $ci = &get_instance();
        $ci->load->database();
        $ci->load->model('settings_model', 'setting');
        $uploadedData = array();
        $countfiles = count($file);
        // Looping all files
        foreach ($file as $f) {

            // Define new $_FILES array - $_FILES['file']
            $_FILES['file']['name'] = $f['name'];
            $_FILES['file']['type'] = $f['type'];
            $_FILES['file']['tmp_name'] = $f['tmp_name'];
            $_FILES['file']['error'] = $f['error'];
            $_FILES['file']['size'] = $f['size'];

            // Set preference
            $config['upload_path'] = $params['file_upload_path'];
            $config['allowed_types'] = $params['file_allowed'];
            $config['max_size'] = $params['file_max_size']; // max_size in kb
            $config['overwrite'] =  $params['file_overwrite'] ?  $params['file_overwrite'] : FALSE;
            $config['file_name'] = clean($params['file_name']);
            if (!file_exists($params['file_upload_path'])) {
                mkdir($params['file_upload_path'], 0777, true);
            }
            //Load upload library
            $ci->load->library('upload', $config);

            // File upload
            if (!$ci->upload->do_upload('file')) {
                // Get data about the file
                return $ci->upload->display_errors();
            } else {
                $uploadedData[] = $ci->upload->data();
                $uploadedData[]['file_type_name'] = $params['file_type_name'];
            }
        }
        if ($uploadedData) {
            return $uploadedData;
        }
    }

    function uploadMultipleFile($files, $params = null)
    {
        $ci = &get_instance();
        $ci->load->database();
        $ci->load->model('settings_model', 'setting');
        $countfiles = count($_FILES[$files]['name']);
        // Looping all files
        $i = 0;
        for ($i = 0; $i < $countfiles; $i++) {
            if (!empty($_FILES[$files]['name'][$i])) {
                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES[$files]['name'][$i];
                $_FILES['file']['type'] = $_FILES[$files]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES[$files]['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES[$files]['error'][$i];
                $_FILES['file']['size'] = $_FILES[$files]['size'][$i];
                // Set preference
                $config['upload_path'] = $params['file_upload_path'];
                $config['allowed_types'] = $params['file_allowed'];
                $config['max_size'] = $params['file_max_size']; // max_size in kb
                $config['overwrite'] = FALSE;
                $config['file_name'] = clean($params['file_name'] . '_' . $i);
                if (!file_exists($params['file_upload_path'])) {
                    mkdir($params['file_upload_path'], 0777, true);
                }
                //Load upload library
                $ci->load->library('upload', $config);
                $ci->upload->initialize($config);
                // File upload
                if (!$ci->upload->do_upload('file')) {
                    return $ci->upload->display_errors();
                } else {
                    $uploadedData[] = $ci->upload->data();
                    $uploadedData[]['file_type_name'] = $params['file_type_name'];
                    // Initialize array
                }
            }
        }
        if ($uploadedData) {
            return $uploadedData;
        }
    }

    function uploadSingleFile($file, $params = null)
    {
        $ci = &get_instance();
        $ci->load->database();
        $ci->load->model('settings_model', 'setting');
        // Set preference
        $config['upload_path'] = $params['file_upload_path'];
        $config['allowed_types'] = $params['file_allowed'];
        $config['max_size'] = $params['file_max_size']; // max_size in kb
        $config['overwrite'] = $params['file_overwrite'];
        $config['file_name'] =  clean($params['file_name']);
        if (!file_exists($params['file_upload_path'])) {
            mkdir($params['file_upload_path'], 0777, true);
        }
        //Load upload library// re-initialize upload library
        $ci->load->library('upload', $config);
        $ci->upload->initialize($config);

        // File upload
        if (!$ci->upload->do_upload($file)) {
            return $ci->upload->display_errors();
        } else {
            $uploadedData[] = $ci->upload->data();
            $uploadedData[0]['file_type_name'] = $params['file_type_name'];
            // Initialize array
        }
        if ($uploadedData) {
            return $uploadedData;
        }
    }
}
