<?php
require_once '../../includes/header.php';

// Fetch all contacts
$stmt = $pdo->query("SELECT * FROM PERSON ORDER BY fav DESC, FirstName ASC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Your Contacts</h1>
        <a href="add.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Contact
        </a>
    </div>

    <!-- Birthday Notifications -->
    <?php if(count($birthdaysToday) > 0): ?>
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded">
            <div class="flex justify-between items-center">
                <p class="font-bold">Birthday Alert!</p>
                <button class="text-blue-700 hover:text-blue-900" onclick="this.parentElement.parentElement.style.display='none'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <p>
                <?php foreach($birthdaysToday as $person): ?>
                    <?= htmlspecialchars($person['FirstName']) ?> <?= htmlspecialchars($person['LastName']) ?> has a birthday today!
                <?php endforeach; ?>
            </p>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach($contacts as $contact): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="p-4">
                    <div class="flex items-center space-x-4">
                        <?php if($contact['image_path']): ?>
                            <img src="/<?= htmlspecialchars($contact['image_path']) ?>" alt="<?= htmlspecialchars($contact['FirstName']) ?>" class="w-16 h-16 rounded-full object-cover">
                        <?php else: ?>
                            <?= generateAvatar($contact['FirstName'],10) ?>
                        <?php endif; ?>
                        <div>
                            <h3 class="font-semibold text-lg">
                                <?= htmlspecialchars($contact['FirstName']) ?> <?= htmlspecialchars($contact['LastName']) ?>
                                <?php if($contact['fav'] == 'Y'): ?>
                                    <span class="text-yellow-500">★</span>
                                <?php endif; ?>
                            </h3>
                            <p class="text-gray-600"><?= htmlspecialchars($contact['Email']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-2 bg-gray-50 flex justify-between">
                    <a href="view.php?id=<?= $contact['id'] ?>" class="text-blue-500 hover:text-blue-700">View</a>
                    <a href="edit.php?id=<?= $contact['id'] ?>" class="text-gray-500 hover:text-gray-700">Edit</a>
                    <a href="../../process/delete.php?id=<?= $contact['id'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>