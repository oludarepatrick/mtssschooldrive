<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            /*font-family: 'Arial', sans-serif;*/
            /*background-color: #3498db;*/
            /*margin: 0;*/
            /*padding: 0;*/
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
            /*height: 100vh;*/
        }

        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 80%;
            margin: 30px auto;
            padding-bottom:100px;
        }

        .logo {
            max-width: 500px;
            margin-bottom: 20px;
        }

        .login-form {
            max-width: 300px;
            margin: 0 auto;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background-color: maroon;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: darkblue;
        }
        
        .registration-link {
            text-align: center;
            margin-top: 20px;
        }

        .registration-link a {
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            color: #3498db;
            background-color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            border: 1px solid #3498db;
            transition: background-color 0.3s, color 0.3s;
            /*box-shadow: 0 0 0 5px rgba(0, 0, 0, 0.5);*/
            
        }

        .registration-link a:hover {
            background-color: #3498db;
            color: #ffffff;
        }
    </style>
</head>
<body>
    
    
    <div class="login-container">
        
        <span class="logo"><?php echo img(array('src'=>'asset/images/mtss.png', 'width'=>100, 'heigth'=>10))?></span>
        <h2>Login for MTSS entrance form</h2>
        <?php if(!empty($report)){ echo "<h5 style='color:red'>".$report."</h5>"; } ?>
        <form action="https://mtss.schooldriveng.com/index.php/entrance/login_exec" method="post" class="login-form">
            <input type="email" name="email" placeholder="Enter your email address" class="form-input" required>
            <input type="password" name="password" placeholder="Enter your password" id="password" class="form-input" required>
        
            <span id="error_message" class="error"></span><br>
            <button type="submit" class="login-button">Login</button>
        </form>
        <div class="registration-link">
            I don't have an account? <a href="https://mtss.schooldriveng.com/index.php/entrance/">Create Account</a>
        </div>
    </div>
    <div align="center" style="margin:0px; padding:0px; font-size:12px; color:darkblue;">
        Copyright @2023 07053796686, schooldrivesng@gmail.com Drive Technology Limited, All rights reserved.
    </div>
</body>
</html>
