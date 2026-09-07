<?php
session_start();

// Default ATM details
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 10000;
}

if (!isset($_SESSION['pin'])) {
    $_SESSION['pin'] = "1234";
}

$message = "";

// Login
if (isset($_POST['login'])) {
    $pin = $_POST['pin'];

    if ($pin == $_SESSION['pin']) {
        $_SESSION['login'] = true;
    } else {
        $message = "❌ Incorrect PIN!";
    }
}

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: atm.php");
    exit();
}

// ATM Operations
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {

    if (isset($_POST['deposit'])) {
        $amount = $_POST['amount'];

        if ($amount > 0) {
            $_SESSION['balance'] += $amount;
            $message = "✅ ₹$amount deposited successfully!";
        } else {
            $message = "❌ Enter a valid amount.";
        }
    }

    if (isset($_POST['withdraw'])) {
        $amount = $_POST['amount'];

        if ($amount <= 0) {
            $message = "❌ Enter a valid amount.";
        } elseif ($amount > $_SESSION['balance']) {
            $message = "❌ Insufficient Balance!";
        } else {
            $_SESSION['balance'] -= $amount;
            $message = "✅ ₹$amount withdrawn successfully!";
        }
    }

    if (isset($_POST['change_pin'])) {
        $old_pin = $_POST['old_pin'];
        $new_pin = $_POST['new_pin'];

        if ($old_pin == $_SESSION['pin']) {
            if (strlen($new_pin) == 4 && is_numeric($new_pin)) {
                $_SESSION['pin'] = $new_pin;
                $message = "✅ PIN changed successfully!";
            } else {
                $message = "❌ New PIN must contain 4 digits.";
            }
        } else {
            $message = "❌ Old PIN is incorrect!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini ATM Simulator</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .atm {
            width: 420px;
            background: #f4f4f4;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            text-align: center;
        }

        .header {
            background: #123c69;
            color: white;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
            margin: 5px 0 0;
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #aaa;
            border-radius: 7px;
            font-size: 16px;
        }

        button {
            width: 95%;
            padding: 12px;
            margin: 7px 0;
            border: none;
            border-radius: 7px;
            background: #123c69;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0b2948;
        }

        .balance {
            background: #dff0d8;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 20px;
            font-weight: bold;
        }

        .message {
            background: #fff3cd;
            padding: 12px;
            border-radius: 8px;
            margin: 12px 0;
        }

        .section {
            background: white;
            padding: 15px;
            margin: 12px 0;
            border-radius: 10px;
        }

        .logout {
            background: #c0392b;
        }

        .logout:hover {
            background: #922b21;
        }

        h3 {
            color: #123c69;
        }
    </style>
</head>

<body>

<div class="atm">

    <div class="header">
        <h1>🏧 MINI ATM</h1>
        <p>Welcome to ATM Simulator</p>
    </div>

    <?php if ($message != "") { ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php if (!isset($_SESSION['login']) || $_SESSION['login'] != true) { ?>

        <h3>🔐 ATM Login</h3>

        <form method="post">
            <input type="password" name="pin"
                   placeholder="Enter 4 Digit PIN"
                   maxlength="4" required>

            <button type="submit" name="login">
                LOGIN
            </button>
        </form>

        <p><b>Demo PIN:</b> 1234</p>

    <?php } else { ?>

        <h3>Welcome, Nisha 👋</h3>

        <div class="balance">
            Current Balance:
            ₹<?php echo number_format($_SESSION['balance'], 2); ?>
        </div>

        <!-- Deposit -->
        <div class="section">
            <h3>💰 Deposit Money</h3>

            <form method="post">
                <input type="number"
                       name="amount"
                       placeholder="Enter Amount"
                       required>

                <button type="submit" name="deposit">
                    DEPOSIT
                </button>
            </form>
        </div>

        <!-- Withdraw -->
        <div class="section">
            <h3>💸 Withdraw Money</h3>

            <form method="post">
                <input type="number"
                       name="amount"
                       placeholder="Enter Amount"
                       required>

                <button type="submit" name="withdraw">
                    WITHDRAW
                </button>
            </form>
        </div>

        <!-- Change PIN -->
        <div class="section">
            <h3>🔑 Change PIN</h3>

            <form method="post">
                <input type="password"
                       name="old_pin"
                       placeholder="Old PIN"
                       maxlength="4"
                       required>

                <input type="password"
                       name="new_pin"
                       placeholder="New 4 Digit PIN"
                       maxlength="4"
                       required>

                <button type="submit" name="change_pin">
                    CHANGE PIN
                </button>
            </form>
        </div>

        <!-- Logout -->
        <form method="post">
            <button type="submit" name="logout" class="logout">
                🚪 LOGOUT
            </button>
        </form>

    <?php } ?>

</div>

</body>
</html>