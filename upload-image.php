<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Story</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="upload" accept=".png, .gif, .jpg" required/>
        <input type="submit" value="upload"/>
    </form>

    <?php  
        if (isset($_FILES['upload'])) {
            try {
                require "connect.php";
                $stmt = $pdo->prepare("INSERT INTO `images` (`img_name`, `img_data`) VALUES (? , ?)");
                $stmt->execute([$_FILES['upload']['name'], file_get_contents($_FILES['upload']['tmp_name'])]);
                echo 'ok';
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    ?>
</body>
</html>