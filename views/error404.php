<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | ProManage</title>
    <style>
        :root {
            --bg-primary: #f5f5f5;
            --bg-secondary: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --accent-primary: #2c7a7b;
            --accent-secondary: #e67e22;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, var(--bg-primary), var(--bg-secondary));
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            text-align: center;
            background-color: var(--bg-secondary);
            padding: 40px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }
        .icon {
            font-size: 80px;
            color: var(--accent-primary);
            margin-bottom: 20px;
        }
        h1 {
            font-size: 36px;
            color: var(--accent-primary);
            margin-bottom: 10px;
        }
        p {
            color: var(--text-secondary);
            margin-bottom: 20px;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: var(--accent-primary);
            color: white;
        }
        .btn-primary:hover {
            background-color: #236c6d;
        }
        .btn-secondary {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            border: 1px solid var(--text-secondary);
        }
        .btn-secondary:hover {
            background-color: #e0e0e0;
        }
        .support {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--bg-primary);
            font-size: 14px;
            color: var(--text-secondary);
        }
        @media (max-width: 480px) {
            .buttons {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">&#x1F50D;</div>
        <h1>404 - Page Not Found</h1>
        <p>Oops! It seems you've ventured into uncharted territory.</p>
        <p>The page you're looking for doesn't exist or has been moved. Don't worry, even the best project managers sometimes lose their way!</p>
        <div class="buttons">
            <a href="index.php?page=admin_home" class="btn btn-primary">Back to Home</a>
            <a href="/dashboard" class="btn btn-secondary">Go to Dashboard</a>
        </div>
        <div class="support">
            <p>If you believe this is an error, please contact our support team.</p>
        </div>
    </div>
</body>
</html>