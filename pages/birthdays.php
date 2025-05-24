<?php
require_once '../includes/header.php';

$upcomingBirthdays = getUpcomingBirthdays($pdo);
$birthdaysToday = checkBirthdaysToday($pdo);
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Birthdays</h1>
    
    <!-- Today's Birthdays -->
    <?php if(count($birthdaysToday) > 0): ?>
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Today's Birthdays</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach($birthdaysToday as $person): ?>
                    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                        <div class="flex items-center space-x-3">
                            <?= generateAvatar($person['FirstName'], 50) ?>
                            <div>
                                <h3 class="font-medium"><?= htmlspecialchars($person['FirstName']) ?> <?= htmlspecialchars($person['LastName']) ?></h3>
                                <p class="text-sm text-gray-500">Today! 🎉</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Upcoming Birthdays -->
    <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Upcoming Birthdays (Next 7 Days)</h2>
        <?php if(count($upcomingBirthdays) > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach($upcomingBirthdays as $person): 
                    $birthday = new DateTime($person['DOB']);
                    $now = new DateTime();
                    $nextBirthday = new DateTime($now->format('Y') . '-' . $birthday->format('m-d'));
                    
                    if ($nextBirthday < $now) {
                        $nextBirthday->modify('+1 year');
                    }
                    
                    $diff = $now->diff($nextBirthday);
                    $daysLeft = $diff->days;
                ?>
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex items-center space-x-3">
                            <?= generateAvatar($person['FirstName'], 40) ?>
                            <div>
                                <h3 class="font-medium"><?= htmlspecialchars($person['FirstName']) ?> <?= htmlspecialchars($person['LastName']) ?></h3>
                                <p class="text-sm text-gray-500">
                                    <?= $birthday->format('F j') ?> 
                                    (in <?= $daysLeft ?> day<?= $daysLeft != 1 ? 's' : '' ?>)
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">No upcoming birthdays in the next 7 days.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>