<!doctype html>
<html>
<body>

<form method ="post" action= "testing.php" >
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
    <form method ="post" action= "testing.php" >
    <br>
    <p> view others </p>
    <label>title</label><input type ="text" name ="titl" id ="var1">
    <label>email</label><input type ="text" name ="email2" id ="var2">
    <input type="submit" name ="search" value ="search" >
</form>
    <form method ="post" action="createprofile.php">
        <label>new project?</label>
        <input type="submit" name="redirect" value = "create new project" >
    </form>
<?php
// Create connection
include 'sign_in.php';
session_start();
$email=$_SESSION['email'];
$db = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=fbcredits");
if (isset($_POST['search'])){
    $sql ="select * from project where lower(project_name) like '$_POST[titl]%' or upper(project_name) like '$_POST[title]%' ";
}
else{
    $sql="select * from project";
}
$result = pg_query($db,$sql);
echo "<table>";
echo "<th>picture</th>";
echo "<th>project name</th>";   
echo "<th>creator</th>";
echo "<th>target</th>";
echo "<th>raised</th>";
echo "click to go";
while($row = pg_fetch_assoc($result)) {
    $image = $row['picture_url'];
    $imageData = base64_encode(file_get_contents($image));
    echo "<tr>";
    echo "<td>";
    echo '<img src="data:image/jpeg;base64,'.$imageData.'"height="100" width="100"/>';
    echo "</td>";
    echo "<td>$row[project_name]</td>";
    echo "<td>$row[creator]</td>";
    echo "<td>$row[target]</td>";
    echo "<td>$row[raised]</td>";
    echo "<td>";
    if($row[creator]==$_SESSION['email']){
        echo "<form method=post action=profile_page.php >
        <input type=hidden name=title value='$row[project_name]' >
        <input type=submit name=submit value=move > ";
    }
    else{
        echo "<form method=post action=profilepage_notuser.php >
        <input type=hidden name=title2 value= '$row[project_name]' >
        <input type=hidden name=not value= '$row[creator]' >
        <input type=submit name=submit value=go > ";
    }
    echo "</td>";
    echo "</tr>\n";
}

echo "</table>";


?> 


</body>
</html>