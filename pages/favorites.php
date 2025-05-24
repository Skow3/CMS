<?php
require_once '../includes/header.php';

// Fetch favorite contacts
$stmt = $pdo->query("SELECT * FROM PERSON WHERE fav = 'Y' ORDER BY FirstName ASC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Favorite Contacts</h1>
        <a href="contacts/list.php" class="text-blue-500 hover:text-blue-700">View All Contacts</a>
    </div>

    <?php if(count($contacts) > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach($contacts as $contact): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border-l-4 border-yellow-400">
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
                                    <span class="text-yellow-500">★</span>
                                </h3>
                                <p class="text-gray-600"><?= htmlspecialchars($contact['Email']) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-gray-50 flex justify-between">
                        <a href="contacts/view.php?id=<?= $contact['id'] ?>" class="text-blue-500 hover:text-blue-700">View</a>
                        <a href="contacts/edit.php?id=<?= $contact['id'] ?>" class="text-gray-500 hover:text-gray-700">Edit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No favorites yet</h3>
            <p class="mt-1 text-sm text-gray-500">Mark contacts as favorites to see them here.</p>
            <div class="mt-6">
                <a href="contacts/add.php" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Contact
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>