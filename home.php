<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
                $res_ProfilePicture = $result['ProfilePicture'];

                $picture_base64 = !empty($res_ProfilePicture) ? 'data:image/jpg;charset=utf8;base64,' . base64_encode($res_ProfilePicture) : "stock.jpg";
            }
            
            echo "<a href='edit.php?Id=$res_id'>Edit Profile</a>";
            ?>

            <a class="text-red-500" href="php/logout.php"> <button class="">Log Out</button> </a>

        </div>
    </div>
    <main>
    <div class="bg-white p-4 mr-5 rounded-xl">
    <img class="h-[150px] w-[150px]" src="<?php echo $picture_base64; ?>" />
        </div>
       <div class="main-box top">
        <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>And you are <b><?php echo $res_Age ?> years old</b>.</p> 
            </div>
          </div>
       </div>

    </main>
</body>
</html>