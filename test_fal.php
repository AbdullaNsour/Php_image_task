 <!-- step 1 Add Form to upload Image   step2 on update.php-->
 <form action="upload.php" enctype="multipart/form-data" method="POST">
     <div class="form-group">
         <input type="file" name="file" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $file; ?>">
         <button type="submit" name="send"> UPLOAD</button>
     </div>
 </form>
 <!-- >>>>> error URL When Upload Image -->

 <!-- step 2   isset image   -->
 <!-- Array ([name])=>aftereffects.jpg [type] => image/jpeg [tmp_name]=> 
                    D:\xamppnew\tmp\phpA75A.tmp[error]=>0[size]=> 64851) -->
 <?php
    if (isset($_POST['send'])) {
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActalExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        if (in_array($fileActalExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActalExt;
                    $fileDestination = 'upload/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("location: index.php?uploadsuccess");
                } else {
                    echo 'your file is too big!';
                }
            } else {
                echo 'there was an error uploading your file!';
            }
        } else {
            echo 'you cannot upload file';
        }
    }
    ?>