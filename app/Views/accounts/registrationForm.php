<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .registration-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .tabs {
            display: flex;
            justify-content: center;
            background-color: #333;
        }

        .tab {
            cursor: pointer;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 4px;
            margin: 0 10px;
            transition: background-color 0.3s;
        }

        .tab:hover {
            background-color: #47A6FA;
        }

        .active-tab {
            background-color: #47A6FA;
            /* Change the background color of the active tab */
        }

        form {
            padding: 20px;
            display: none;
        }

        form.active-form {
            display: block;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="registration-container">
        <div class="tabs">
            <div class="tab active-tab" style="width: 100%" id="customerTab">Customer</div>
            <div class="tab" id="agencyTab" style="width: 100%;">Car Agency</div>
        </div>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif ?>
        <!-- Customer Registration Form -->
        <form action="/register-customer" method="post" id="customerForm" class="active-form">
            <?= csrf_field() ?>
            <label for="customerUsername">Username:</label>
            <input type="text" id="customerUsername" name="customerUsername" required>
            <label for="customerPassword">Password:</label>
            <input type="password" id="customerPassword" name="customerPassword" required>
            <label for="customerFullName">Full Name:</label>
            <input type="text" id="customerFullName" name="customerFullName" required>
            <input type="submit" name="customerSubmit" value="Register">
        </form>

        <!-- Car Agency Registration Form -->
        <form action="/register-agency" method="post" id="agencyForm">
            <?= csrf_field() ?>
            <label for="agencyUsername">Username:</label>
            <input type="text" id="agencyUsername" name="agencyUsername" required>
            <label for="agencyPassword">Password:</label>
            <input type="password" id="agencyPassword" name="agencyPassword" required>
            <label for="agencyFullName">Full Name:</label>
            <input type="text" id="agencyFullName" name="agencyFullName" required>
            <input type="submit" name="agencySubmit" value="Register">
        </form>
    </div>

    <script>
        const customerTab = document.getElementById('customerTab');
        const agencyTab = document.getElementById('agencyTab');
        const customerForm = document.getElementById('customerForm');
        const agencyForm = document.getElementById('agencyForm');

        customerTab.addEventListener('click', () => {
            customerTab.classList.add('active-tab');
            agencyTab.classList.remove('active-tab');
            customerForm.classList.add('active-form');
            agencyForm.classList.remove('active-form');
        });

        agencyTab.addEventListener('click', () => {
            customerTab.classList.remove('active-tab');
            agencyTab.classList.add('active-tab');
            customerForm.classList.remove('active-form');
            agencyForm.classList.add('active-form');
        });
    </script>
</body>

</html>