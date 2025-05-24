<?php
session_start();
require_once 'functions.php';

// Check for birthdays today
$birthdaysToday = checkBirthdaysToday($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="/index.php" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">CMS</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="/pages/birthdays.php" class="py-2 px-2 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M12 2v4M12 6c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2zM5 10h14a2 2 0 0 1 2 2v2H3v-2a2 2 0 0 1 2-2zM3 14h18v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4zM7 18h.01M12 18h.01M17 18h.01"/>
</svg>

                        <?php if(count($birthdaysToday) > 0): ?>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">
                                <?= count($birthdaysToday) ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>