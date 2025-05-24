<?php
require_once __DIR__ . '/../config/database.php';

// Generate avatar if no image is uploaded
function generateAvatar($name, $size = 100) {
    $colors = ['bg-blue-500', 'bg-green-500', 'bg-red-500', 'bg-yellow-500', 'bg-purple-500'];
    $initial = strtoupper(substr($name, 0, 1));
    $color = $colors[rand(0, count($colors) - 1)];
    
    return '<div class="flex items-center justify-center rounded-full text-white text-2xl font-bold '.$color.' w-'.$size.' h-'.$size.'">'.$initial.'</div>';
}

// Check for birthdays today
function checkBirthdaysToday($pdo) {
    $today = date('m-d');
    $stmt = $pdo->prepare("SELECT id, FirstName, LastName FROM PERSON WHERE DATE_FORMAT(DOB, '%m-%d') = ?");
    $stmt->execute([$today]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get upcoming birthdays (next 7 days)
function getUpcomingBirthdays($pdo) {
    $today = date('m-d');
    $nextWeek = date('m-d', strtotime('+7 days'));
    
    $stmt = $pdo->prepare("
        SELECT id, FirstName, LastName, DOB 
        FROM PERSON 
        WHERE DATE_FORMAT(DOB, '%m-%d') BETWEEN ? AND ?
        ORDER BY DATE_FORMAT(DOB, '%m-%d')
    ");
    $stmt->execute([$today, $nextWeek]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>