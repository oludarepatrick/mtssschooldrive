<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
        }
        
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        
        .btn1 {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn2 {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            background-color: green;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn3 {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            background-color: red;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        .success-message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            display: none;
        }
        
        .success-message.show {
            display: block;
        }
        .success-icon {
            color: #4CAF50;
            font-size: 48px;
            margin-bottom: 20px;
            text-align:center;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
            font-size: 16px;
            text-align:center;
            margin-top: 10px;
        }
        .btn1 a, .btn2 a, .btn3 a{
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div align="center">
                <a href="">
                    <?php echo img(array('src'=>'asset/images/mtss.png', 'width'=>100, 'heigth'=>10))?>
                </a>
        </div>
         <div class="success-icon">Success &#10003;</div>
        <h1><?php echo $record->sname.' '.$record->fname.' '.$record->oname ?></h1>
        <p>Kindly click on one of the below button to complete your registration </p>
        <div class="buttons">
            <?php if($record->status==3){ ?>
                <button class="btn1"><a style="text-decoration: none; color:fff; font-weight: bold;">Pay with leverpay</a></button>
            <?php }else{?>
                <button class="btn1"><a style="text-decoration: none; color:fff; font-weight: bold;">Proceed to write exam</a></button>
            <?php }?>
            <button class="btn2"><a style="text-decoration: none; color:fff; font-weight: bold;" href="https://mtss.schooldriveng.com/index.php/entrance/registration/<? echo $record->uuid ?>">Edit form</a></button>
            <button class="btn3"><a style="text-decoration: none; color:fff; font-weight: bold;" href="https://mtss.schooldriveng.com/index.php/entrance/login">logout</a></button>
        </div>
        <div class="success-message">
            Success! Your action was completed.
        </div>
        
    </div>
    <div align="center" style="margin:0px; padding:0px; font-size:12px; color:darkblue;">
        Copyright @2023 07053796686, schooldrivesng@gmail.com Drive Technology Limited, All rights reserved.
    </div>
</body>
</html>
