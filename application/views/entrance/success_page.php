<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .success-container {
            text-align: center;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-icon {
            color: #4CAF50;
            font-size: 48px;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-top: 10px;
        }

        .back-to-home {
            margin-top: 20px;
        }

        .back-to-home a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">&#10003;</div>
        <?php if($report==12895051102){ ?>
            <h1>Account Creation in Progress!</h1>
            <p>Kindly go to your mail and click for the link just sent to you to procced with your registration</p>
        <?php }elseif($report==10975053162){ ?>
            <h1>Email Address Successfully Verified!</h1>
            <p>Click on link below to login and proceed</p>
            <div class="back-to-home">
                <p>Back to <a href="https://mtss.schooldriveng.com/index.php/entrance/login">Login</a></p>
            </div>
        <?php } ?>
        
    </div>
</body>
</html>
