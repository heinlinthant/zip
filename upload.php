<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['zipfile']) && $_FILES['zipfile']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['zipfile']['tmp_name'];
        $fileName = $_FILES['zipfile']['name'];
        $fileSize = $_FILES['zipfile']['size'];
        $fileType = $_FILES['zipfile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Check if the file is a ZIP file
        if ($fileExtension == 'zip') {
            // Set the upload folder
            $uploadFileDir = './';
            $dest_path = $uploadFileDir . $fileName;

            // Create the upload folder if it doesn't exist
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }

            // Move the file to the desired folder
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                echo "File is successfully uploaded.";
            } else {
                echo "There was an error moving the uploaded file.";
            }
        } else {
            echo "Please upload a valid ZIP file.";
        }
    } else {
        echo "No file was uploaded or there was an upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload ZIP File</title>
</head>
<body>
    <h2>Upload ZIP File</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="zipfile" accept=".zip" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
