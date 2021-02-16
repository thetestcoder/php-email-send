<html>
<head>
    <style>
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .container {
            width: 70%;
            border: 1px solid rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 10px auto;
        }

        .query {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        .subject h3 {
            padding-top: 12px;
            padding-bottom: 12px;
            background: #4CAF50;
            color: white;
            border-radius: 15px;
        }

        .contact p {
            background: #ddd;
            padding: 10px;
            border-radius: 15px;
        }

        .site-info {
            padding: 5px 20px;
            width: 70%;
            margin: auto;
            text-align: center;
            background: #ddd;
        }

        .site-info p {
            font-size: 20px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="query">
        <div class="subject">
            <h3><?php echo $subject ?? "" ?></h3>
        </div>
        <div class="detail">
            <?php echo $query ?? "" ?>
        </div>
        <div class="contact">
            <p>Name - <?php echo $name ?? "Unknown" ?></p>
            <p>Email - <?php echo $email ?? "Unknown" ?></p>
        </div>
    </div>
</div>
<div class="site-info">
    The Test Coder
</div>
</body>
</html>