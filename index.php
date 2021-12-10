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
                // create a tab
                if ($value!="") {
                    // give tab a name/ID
                    print "<div id=\"$value\" class=\"tabcontent\">";
                    
                    // Prepare query for this domain
                    $html = file_get_contents("https://www.google.com/search?q=inurl:$value+-site:$value&hl=en&tbm=isch");
                    $dom = new domDocument;
                    libxml_use_internal_errors (true);
                    $dom->loadHTML($html);
                    //$images = $dom->getElementsByTagName('img');
                    $images = $dom->getElementsByTagName('a');
                    
                    // #todo: Remove Google.com URLs
                    // #todo: Trim urls so they start with http
                    // #todo: Decode Google Images URLs
                    // #todo: Flexbox of images with a link result, similar to Google Images results
                    
                    foreach($images as $image){
                        //$img = $image->getAttribute('src');
                        $img = $image->getAttribute('href');
                        echo $img."</br>";
                    }
                    
                    print "</div>";
                }
            }
        }
    ?>
</body>
</html>