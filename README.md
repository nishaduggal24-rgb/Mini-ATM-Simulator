# Mini ATM Simulator

## Introduction
Mini ATM Simulator is a simple web-based ATM application developed using PHP. It demonstrates basic ATM operations such as login, deposit, withdrawal, balance checking, PIN changing, and logout.

## Features
- 4-digit PIN based login
- Initial balance of ₹10,000
- Deposit money
- Withdraw money
- Display current balance
- Change ATM PIN
- Logout functionality
- Simple and user-friendly HTML/CSS interface

## Default Login
- **PIN:** `1234`
- **Initial Balance:** `₹10,000`

## Technologies Used
- PHP
- HTML
- CSS
- PHP Sessions

## Working of the Project

### 1. Login
The user enters the 4-digit PIN. If the entered PIN matches the stored PIN, the ATM dashboard is displayed.

### 2. Deposit Money
The user enters an amount. If the amount is greater than zero, it is added to the current balance.

### 3. Withdraw Money
The user enters an amount to withdraw. The program checks that the amount is valid and that sufficient balance is available.

### 4. Change PIN
The user enters the old PIN and a new 4-digit PIN. The PIN is changed only when the old PIN is correct and the new PIN contains exactly four digits.

### 5. Logout
The logout button destroys the current session and returns the user to the login screen.

## Project Structure
```text
Mini-ATM-Simulator/
├── index.php
├── README.md
├── ATM_Output.png
└── Nisha 2443002 PHP Word File.docx
```

## Output
The following screenshot shows the working output of the Mini ATM Simulator after a successful deposit operation.

![Mini ATM Simulator Output](ATM_Output.png)

## How to Run
1. Install XAMPP.
2. Start **Apache** from the XAMPP Control Panel.
3. Copy `index.php` into the XAMPP `htdocs` folder.
4. Open a web browser.
5. Enter `http://localhost/index.php`.
6. Login using the default PIN `1234`.

## Student Details
**Name:** Nisha  
**Project:** Mini ATM Simulator  
**Language:** PHP

## Conclusion
The Mini ATM Simulator demonstrates how PHP sessions, forms, conditional statements, and HTML/CSS can be combined to create a simple ATM application. It is a useful beginner-level project for understanding basic PHP web programming.
