<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk hotlinking tester</title>
</head>
<body>
    Enter URLs: (comma delimited)
    <form name="test" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <textarea id="urllist" name="urllist" rows="4" cols="50"></textarea>
        <input type="submit" name="submit">
    </form>
    
    <hr>
    
    <?php
        if ( isset( $_POST['submit'] ) ) { 
             $firstname = $_POST['urllist'];
            echo "User Has entered: <b> $firstname </b>";
        }
    ?>
    
</body>
</html>