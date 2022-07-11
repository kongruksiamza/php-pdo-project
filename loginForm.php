<?php
    $title="แบบฟอร์มลงชื่อเข้าใช้";
    require_once "layout/header.php";
    require_once "db/connect.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $new_password=md5($password.$username);
        $result=$user->getUser($username,$new_password);

        if(!$result){
            echo '<div class="alert alert-danger">ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</div>';
        }else{
            $_SESSION["username"]=$username;
            $_SESSION["userid"]=$result["id"];
            header("Location:index.php");
        }
        
    }
?>
    <h1 class="text-center"><?php echo "แบบฟอร์มลงชื่อเข้าใช้";?></h1>
    <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" 
            name="username" 
            value="<?php if($_SERVER["REQUEST_METHOD"]=="POST") echo $_POST["username"];?>"
            class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <input type="submit" name="submit" value="เข้าสู่ระบบ" class="btn btn-primary my-3">
    </form>
</div>
</body>
</html>