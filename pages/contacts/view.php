<?php
require_once '../../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$contactId = $_GET['id'];

// Get contact info
$stmt = $pdo->prepare("SELECT * FROM PERSON WHERE id = ?");
$stmt->execute([$contactId]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    header("Location: index.php");
    exit;
}

// Get phone numbers
$stmt = $pdo->prepare("SELECT * FROM PHONE_NUMBERS WHERE person_id = ?");
$stmt->execute([$contactId]);
$phoneNumbers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Contact Details</h1>
        <a href="list.php" class="text-blue-500 hover:text-blue-700">← Back to Contacts</a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Profile Image -->
                <div class="flex-shrink-0">
                    <?php if($contact['image_path']): ?>
                        <img src="/<?= htmlspecialchars($contact['image_path']) ?>" alt="<?= htmlspecialchars($contact['FirstName']) ?>" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow">
                    <?php else: ?>
                        <?= generateAvatar($contact['FirstName'], 32) ?>
                    <?php endif; ?>
                </div>

                <!-- Contact Info -->
                <div class="flex-grow">
                    <div class="flex items-center mb-4">
                        <h2 class="text-xl font-bold">
                            <?= htmlspecialchars($contact['FirstName']) ?> <?= htmlspecialchars($contact['LastName']) ?>
                        </h2>
                        <?php if($contact['fav'] == 'Y'): ?>
                            <span class="ml-2 text-yellow-500">★</span>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-4">
                        <!-- Email -->
                        <?php if($contact['Email']): ?>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500">Email</h3>
                                <p class="text-gray-800"><?= htmlspecialchars($contact['Email']) ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Date of Birth -->
                        <?php if($contact['DOB']): ?>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500">Date of Birth</h3>
                                <p class="text-gray-800">
                                    <?= date('F j, Y', strtotime($contact['DOB'])) ?>
                                    (<?= calculateAge($contact['DOB']) ?> years old)
                                </p>
                            </div>
                        <?php endif; ?>

                        <!-- Phone Numbers -->
                        <?php if(count($phoneNumbers) > 0): ?>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500">Phone Numbers</h3>
                                <ul class="space-y-2">
                                    <?php foreach($phoneNumbers as $phone): ?>
                                        <li class="flex items-center">
                                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                                <?= htmlspecialchars($phone['label']) ?>
                                            </span>
                                            <span class="text-gray-800"><?= htmlspecialchars($phone['PhoneN']) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <a href="edit.php?id=<?= $contact['id'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
            <a href="/process/delete.php?id=<?= $contact['id'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</a>
        </div>
    </div>
</div>

<?php 
// Add to functions.php:
function calculateAge($dob) {
    $birthdate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($birthdate);
    return $age->y;
}
?>

<?php require_once '../../includes/footer.php'; ?>