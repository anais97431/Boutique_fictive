<?php

function img_load_cat($id_category)
{

    //if(isset($_POST['upload_photos'])){
    // Include the database configuration file
    include_once 'conect.php';
    global $connection;

    // File upload configuration
    $targetDir = "uploads/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if (!empty(array_filter($_FILES['photos']['name']))) {
        foreach ($_FILES['photos']['name'] as $key => $val) {
            // File upload path
            $fileName = basename($_FILES['photos']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;


            // Delette pour uploads

            //     // selection de l'image pour comparaison
            // $sql = "SELECT * FROM categorys 
            // WHERE id_category=$id_category";
            // $sth = $connection->prepare($sql);
            // $sth->execute();

            // $resultat = $sth->fetch(PDO::FETCH_OBJ);


            // @unlink("uploads/" . $resultat->img);



            // if ($resultat) {
            //     $sql =  "DELETE FROM  categorys
            //     WHERE id_category = $id_category";

            //     $sth = $connection->prepare($sql);
            //     $sth->execute();
            // }








            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["photos"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql
                    $insertValuesSQL .= "('" . $fileName . "'),";
                } else {
                    $errorUpload .= $_FILES['photos']['name'][$key] . ', ';
                }
            } else {
                $errorUploadType .= $_FILES['photos']['name'][$key] . ', ';
            }
        }





        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            // Insert image file name into database
            $insert = $connection->query("UPDATE categorys SET img =$insertValuesSQL  WHERE id_category = $id_category");
            if ($insert) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . $errorUpload : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . $errorUploadType : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "Files are uploaded successfully." . $errorMsg;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }


    // Display status message
    echo $statusMsg;
}
//}