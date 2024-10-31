<?php
// Check if the form was submitted
if(isset($_POST["submit"])) {
    // Check if files were uploaded successfully
    if(isset($_FILES["file1"]) && isset($_FILES["file2"])) {
        // Loop through each file
        for ($i = 1; $i <= 2; $i++) {
            $fileInputName = "file" . $i;
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES[$fileInputName]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Create the uploads directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Check file size
            if ($_FILES[$fileInputName]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            $allowedFormats = array("jpg", "jpeg", "png", "gif");
            if(!in_array($imageFileType, $allowedFormats)) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES[$fileInputName]["name"])) . " has been uploaded.<br>";
                } else {
                    echo "Sorry, there was an error uploading your file.<br>";
                }
            }
        }
    } else {
        echo "No file uploaded.";
    }
}
?>
