<?php
// Create a database connection
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "search";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// 1. Test if connection occurred
if(mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
?>
<?php
    // 2. perform a database query
    $cleanSearch = mysqli_real_escape_string($_POST['search']);
    $query = mysqli_query("SELECT * FROM music_info WHERE artist LIKE '%$cleanSearch%'");
    // test if there was a query error
    if(!$query) {
        die("Database query failed");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <h1>Music Info</h1>
        <form method="POST" action="index.php" id="searchForm">
            <input type="text" id="searchBox" name="search" placeholder="search...">
            <input type="submit" name="submit" value="search">
        </form>
        <?php
            // 3. use returned data (if any)
            while($row = mysqli_fetch_row($query)) {
                // output data from each row
                var_dump($row);
                echo "<hr/>";
            }
        ?>
        <?php
            // 4. release returned data 
            mysqli_free_result($query);
        ?>
    </body>
</html>
<?php
    // 5. Close database connection
    mysqli_close($connection);
?>