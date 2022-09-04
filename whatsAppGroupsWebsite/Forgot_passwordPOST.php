<?php
include('Connection.php');
if(isset($_POST['forgetemail1'])){
    $error=0;
  

    $email=$_POST['email'];

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $sql = "SELECT * FROM restpassword WHERE email='$email'";
        $result = $conn->query($sql);
        //Random number 4 dight
        $token=rand(1000, 9999);

        if($result->num_rows > 0){
            $sql="UPDATE restpassword  set  token='$token' WHERE email='$email' ";
            $result = $conn->query($sql);

        }

        else{
            $sql="INSERT INTO restpassword(email,token)
            VALUES('$email','$token')";
                    mysqli_query($conn,$sql);

        }
        //Email
        $to_email =$email;
        $subject="Reset Password";
        $body="Hi,your code is $token ";
        $headers = "From: yazeedfahad891@gmail.com";
//$_SESSION['emailresetpassword']=$email;

        if (mail($to_email, $subject, $body, $headers)) {
            
            header('location:passwordMessage.php');

        } 
       
        
        //Email
    

        
    }
    else{
        echo "<script>alert(' you have write incorrect email.')</script>";
        //header('location:forgot_password.php');
    }
}
if(isset($_POST['changePassword'])){
    $email=(($_POST['email1']));
    $password=  (($_POST['password1']));
    $password1= (($_POST['password']));
    $token= (($_POST['token']));
    $sql="SELECT token FROM restpassword WHERE token='$token 'AND email='$email'";
    $result=mysqli_query($conn,$sql);
    if($result->num_rows > 0){


        if(($password1==$password )){
            if(strlen($password1)>6){
                $sql="UPDATE user  set  password='$password' WHERE email='$email' ";
                $result = $conn->query($sql);
                $sqll= "delete from restpassword where email='$email'";
                $result = $conn->query($sqll);
                header('location:login.php');

    
                
            }
            else{
                echo "<script>alert('  كلمة المرور يجب ان لا تكون اقل من 6.')</script>";
                include('ForgetPassword1.php');

            }

            

        }
        else{
            echo "<script>alert(' كلمة المرور غير متطابقة     =.')</script>";
            include('ForgetPassword1.php');


            
            
        }
    
    

    }
    else{
        echo "<script>alert('    الكود غير صحيح')</script>";
        include('ForgetPassword1.php');


    }

    
}


    ?>



























