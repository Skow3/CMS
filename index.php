<?php
require_once 'includes/header.php';

// Fetch all contacts with their primary phone numbers
$stmt = $pdo->query("
    SELECT p.*, ph.PhoneN as primary_phone
    FROM PERSON p
    LEFT JOIN PHONE_NUMBERS ph ON p.id = ph.person_id AND ph.label = 'Primary'
    ORDER BY p.fav DESC, p.FirstName ASC
");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get counts for dashboard
$totalContacts = count($contacts);
$favoriteContacts = $pdo->query("SELECT COUNT(*) FROM PERSON WHERE fav = 'Y'")->fetchColumn();
$birthdaysToday = count(checkBirthdaysToday($pdo));
$upcomingBirthdays = count(getUpcomingBirthdays($pdo));
?>

<div class="container mx-auto px-4 py-8 pb-20">
    <h1 class="text-2xl font-bold text-gray-800 mb-8">Welcome, Shivam !</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Contacts</h3>
                    <p class="text-2xl font-semibold text-gray-900"><?= $totalContacts ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Favorites</h3>
                    <p class="text-2xl font-semibold text-gray-900"><?= $favoriteContacts ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M12 2s1.5 2 1.5 3.5S12 7 12 7s-1.5-.5-1.5-1.5S12 2 12 2z"/>  
    <path d="M18 7H6v6h12V7z"/>  
    <path d="M4 13h16v6H4z"/>  
    <path d="M6 19h12"/>  
</svg>

                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Birthdays Today</h3>
                    <p class="text-2xl font-semibold text-gray-900"><?= $birthdaysToday ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Upcoming Birthdays</h3>
                    <p class="text-2xl font-semibold text-gray-900"><?= $upcomingBirthdays ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- All Contacts Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">All Contacts</h3>
            <a href="pages/contacts/add.php" class="text-sm font-medium text-blue-500 hover:text-blue-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New
            </a>
        </div>
        
        <ul class="divide-y divide-gray-200">
            <?php if(count($contacts) > 0): ?>
                <?php foreach($contacts as $contact): ?>
                    <li class="py-3 px-6 hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <!-- Profile Image -->
                            <div class="shrink-0">
                                <?php if($contact['image_path']): ?>
                                    <img class="w-10 h-10 rounded-full" src="<?= htmlspecialchars($contact['image_path']) ?>" alt="<?= htmlspecialchars($contact['FirstName']) ?>">
                                <?php else: ?>
                                    <?= generateAvatar($contact['FirstName'], 10) ?>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Contact Info -->
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    <?= htmlspecialchars($contact['FirstName']) ?> <?= htmlspecialchars($contact['LastName']) ?>
                                    <?php if($contact['fav'] == 'Y'): ?>
                                        <span class="text-yellow-500 ml-1">★</span>
                                    <?php endif; ?>
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    <?= $contact['primary_phone'] ? htmlspecialchars($contact['primary_phone']) : 'No phone number' ?>
                                </p>
                            </div>
                            
                            <!-- View Button -->
                            <a href="/pages/contacts/view.php?id=<?= $contact['id'] ?>" class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full hover:bg-blue-200 transition-colors">
                                <span class="w-2 h-2 me-1 bg-blue-500 rounded-full"></span>
                                VIEW
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="py-6 px-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No contacts</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by adding your first contact.</p>
                    <div class="mt-6">
                        <a href="contacts/add.php" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add Contact
                        </a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    
    <!-- Birthday Notifications -->
    <?php if($birthdaysToday > 0): ?>
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Birthday Alert!</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>
                            <?php 
                            $stmt = $pdo->query("SELECT FirstName, LastName FROM PERSON WHERE DATE_FORMAT(DOB, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d')");
                            $birthdayPeople = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach($birthdayPeople as $person): 
                            ?>
                                <?= htmlspecialchars($person['FirstName']) ?> <?= htmlspecialchars($person['LastName']) ?>,
                            <?php endforeach; ?>
                            have birthdays today! 🎉
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>