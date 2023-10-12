<!DOCTYPE html>
<html>

<head>
    <title>Add New Car</title>
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

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"] {
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

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <?= session()->getFlashdata('error') ?>

    <form action="/add_cars" method="post">
        <?= csrf_field() ?>

        <label for="agency_id">Agency:</label>
        <select id="agency_id" name="agency_id" required>
            <option value="">Select an agency</option>
            <option value="1">1</option>
        </select>

        <label for="vehicle_model">Vehicle Model:</label>
        <input type="text" id="vehicle_model" name="vehicle_model">

        <!-- Vehicle Number -->
        <label for="vehicle_number">Vehicle Number:</label>
        <input type="text" id="vehicle_number" name="vehicle_number" required>

        <!-- Seating Capacity -->
        <label for="seating_capacity">Seating Capacity:</label>
        <input type="number" id="seating_capacity" name="seating_capacity" required>

        <!-- Rent Per Day -->
        <label for="rent_per_day">Rent Per Day:</label>
        <input type="number" id="rent_per_day" name="rent_per_day" required>

        <?php if (isset($message)) : ?>
            <?= $message ?>
        <?php endif ?>
        <!-- Submit Button -->
        <input type="submit" name="submit" value="Add Car">
    </form>
</body>

</html>