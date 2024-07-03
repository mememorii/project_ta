<?php

if(isset($_FILES['upload'])) {
    $uploadDir = 'public/assets/dist/uploads/';
    $file = $_FILES['upload'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $newName = $file['name'];
        move_uploaded_file($file['tmp_name'], $uploadDir . $newName);

        $response = new StdClass;
        $response->uploaded = 1;
        $response->url = base_url($uploadDir . $newName);
        echo stripslashes(json_encode($response));
    } else {
        echo '{"error": "Failed to upload file"}';
    }
}

?>