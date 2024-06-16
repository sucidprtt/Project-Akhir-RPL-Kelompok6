<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f8fc;
        }

        .login-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            width: 800px;
        }

        .illustration {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .illustration h1 {
            font-size: 72px;
            font-weight: 700;
            margin: 0;
        }

        .illustration h1 span {
            background: -webkit-linear-gradient(#007bff, #0056b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .illustration h1 span:nth-child(3) {
            background: -webkit-linear-gradient(#ff6347, #ff4500);
        }

        .illustration h1 span:nth-child(4) {
            background: -webkit-linear-gradient(#32cd32, #228b22);
        }

        .illustration p {
            font-size: 14px;
            color: #555;
            margin-top: 8px;
        }

        .login-form {
            flex: 1;
            padding-right: 40px; /* Changed from left to right */
        }

        .login-form .welcome-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .welcome-header h2 {
            margin: 0;
            font-size: 26px;
            color: #333;
        }

        .welcome-header p {
            margin: 5px 0 0;
            font-size: 18px;
            color: #666;
        }

        .login-form form {
            display: flex;
            flex-direction: column;
        }

        .login-form label {
            margin-bottom: 8px;
            color: #555;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #2c3e50;
            outline: none;
        }

        .login-form button[type="submit"] {
            padding: 10px;
            background-color: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .login-form button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="welcome-header">
                <h2>Smart Motorcycle Workshop</h2>
                <p>Please login to your account</p>
            </div>
            <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            <form method="post" action="login_process.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="illustration">
            <h1>
                <span>P</span>
                <span>P</span>
                <span style="background: -webkit-linear-gradient(#ff6347, #ff4500); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">S</span>
                <span style="background: -webkit-linear-gradient(#32cd32, #228b22); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">P</span>
            </h1>
            <p>Pratiwi, Prayogi, Surya Putra</p>
        </div>
    </div>
</body>
</html>
