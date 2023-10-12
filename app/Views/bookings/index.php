<h2><?= esc($title) ?></h2>

<?php if (! empty($bookings) && is_array($bookings)): ?>

    <?php foreach ($bookings as $bookings_item): ?>

        <h3><?= esc($bookings_item['booking_id']) ?></h3>

        <div class="main">
            <?= esc($bookings_item['car_id']) ?>
        </div>
        <p><a href="/bookings/<?= esc($bookings_item['car_id'], 'url') ?>">View booking</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No Booking</h3>

    <p>Unable to find any bookings for you.</p>

<?php endif ?>