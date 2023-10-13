<!DOCTYPE html>
<html>

<head>
    <title>Available Cars to Rent</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

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

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .car-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            /* Spacing between cards */
        }

        .car-details {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: calc(50% - 10px);
            /* Two cars per row with spacing */
            box-sizing: border-box;
        }

        .rent-button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .rent-button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($message)) : ?>
            <div class="alert alert-info" role="alert">
                <?= esc($message) ?>
            </div>
        <?php endif ?>
        <div class="car-container">
            <?php foreach ($cars as $car) : ?>
                <div class="car-details">
                    <p>Vehicle Model: <?= esc($car->vehicle_model) ?></p>
                    <p>Vehicle Number: <?= esc($car->vehicle_number) ?></p>
                    <p>Seating Capacity: <?= esc($car->seating_capacity) ?></p>
                    <p>Rent per Day: Rs.<?= esc($car->rent_per_day) ?></p>
                    <!-- Display input fields if customer is logged in -->
                    <?php if ($customerLoggedIn) : ?>
                        <div class="rental-inputs">
                            <form action="/rent_car" method="post">
                                <?= csrf_field() ?>
                                <label for="days">Number of Days:</label>
                                <select name="days" id="days" required>
                                    <?php for ($i = 1; $i <= 7; $i++) : ?>
                                        <option value="<?= $i ?>"><?= $i ?> Day<?= $i > 1 ? 's' : '' ?></option>
                                    <?php endfor; ?>
                                </select>
                                <label for="start-date">Start Date:</label>
                                <input type="date" id="start-date" name="start-date" required>
                                <!-- Include a hidden input for the car ID -->
                                <input type="hidden" name="car-id" value="<?= esc($car->car_id) ?>">
                                <button class="rent-button" type="submit">Rent Car</button>
                            </form>
                        </div>
                    <?php endif ?>
                    <!-- Display "Rent Car" button with conditions -->
                    <?php if (!$customerLoggedIn) : ?>
                        <div style="color:red;">Login as Customer to Rent Car</div>
                    <?php endif ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>