<!doctype html>
<html>
<body>

<form method ="post" action= "profile_page.php" >
    <?php include 'sign_in.php';
    session_start();
    $email=$_SESSION['email'];
    ?>
    <p> view your own projects</p>
    <br>
    <label>username : </label><?php session_start(); echo $_SESSION['email']; echo " | "; ?>
    <label>title</label><input type ="text" name ="var1" id ="var1">
    <input type="submit" name ="search" value ="search" >
    </form>
    <form method ="post" action= "profilepage_notuser.php" >
    <br>
    <p> view others </p>
    <label>title</label><input type ="text" name ="title" id ="var1">
    <label>email</label><input type ="text" name ="email2" id ="var2">
    <input type="submit" name ="search" value ="search" >
</form>
    <form method ="post" action="createprofile.php">
        <label>new project?</label>
        <input type="submit" name="redirect" value = "create new project" >
    </form>
<?php
// Create connection
    
session_start();
$db = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=fbcredits");

$result = pg_query($db, "SELECT * FROM project ");

while($row = pg_fetch_assoc($result)) {
    $image = $row['picture_url'];
    $imageData = base64_encode(file_get_contents($image));
    echo "<br>";
    echo '<img src="data:image/jpeg;base64,'.$imageData.'"height="100" width="100"/>';
    echo "Project Name:  ";
    echo $row["project_name"];
    echo "  creator  ";
    echo $row["creator"];
    echo "  target  ";
    echo $row["target"];
    echo "  raised  ";
    echo $row["raised"];
    echo "<br>";
}


?> 


</body>
</html>