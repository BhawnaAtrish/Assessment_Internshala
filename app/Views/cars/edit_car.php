<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <!-- Include Bootstrap CSS if needed -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <?php if (isset($message)) : ?>
                    <div class="alert alert-danger"><?= esc($message) ?></div>
                <?php endif; ?>
                <form action="/update_car/<?= esc($car['car_id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="vehicle_model">Vehicle Model:</label>
                        <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" value="<?= esc($car['vehicle_model']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="vehicle_number">Vehicle Number:</label>
                        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" value="<?= esc($car['vehicle_number']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="seating_capacity">Seating Capacity:</label>
                        <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" value="<?= esc($car['seating_capacity']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="rent_per_day">Rent Per Day:</label>
                        <input type="number" class="form-control" id="rent_per_day" name="rent_per_day" value="<?= esc($car['rent_per_day']) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

        </div>
    </div>
</body>

</html>