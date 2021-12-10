<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Bulk hotlinking tester</title>
</head>
<body>
    <script type="text/javascript">
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
    
    Enter URLs: (comma delimited)
    <form name="test" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <textarea id="urllist" name="urllist" rows="4" cols="50"></textarea>
        <input type="submit" name="submit">
    </form>
    
    <hr>
    
    <?php
        // check if form has submitted
        if ( isset( $_POST['submit'] ) ) {
            // get entered urls
            $urllist = $_POST['urllist'];
            // remove spaces
            trim($urllist," ");
            // turn into an array separated on comma
            $urlsarray = explode(",", $urllist);
            
            // start tabbed section, create tab titles
            echo "<div class=\"tab\">";
            
            // loop tab data for each item in array
            foreach($urlsarray as $value){
                if ($value!="") {
                    echo "<button class=\"tablinks\" onclick=\"openTab(event, '$value')\">$value</button>";
                }
            }
            
            // end tab titles
            echo "</div>";
            
            // create tab data section
            foreach($urlsarray as $value){
                if ($value!="") {
                    print "<div id=\"$value\" class=\"tabcontent\">";
                    print "<p>This is the content in the tab for $value.</p>";
                    print "</div>";
                }
            }
        }
    ?>
</body>
</html>