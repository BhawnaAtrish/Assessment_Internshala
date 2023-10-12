<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="row">
            <?php if (!empty($cars)) : ?>
                <?php foreach ($cars as $car) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($car->vehicle_model) ?></h5>
                                <p class="card-text">
                                    <strong>Vehicle Number:</strong> <?= esc($car->vehicle_number) ?><br>
                                    <strong>Seating Capacity:</strong> <?= esc($car->seating_capacity) ?><br>
                                    <strong>Rent Per Day:</strong> <?= esc($car->rent_per_day) ?><br>
                                </p>
                                <a href="/edit_car/<?= esc($car->car_id) ?>" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No cars available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
