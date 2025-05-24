<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

// Check if ID parameter exists
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../pages/contacts/list.php?error=invalid_id");
    exit;
}

$contactId = (int)$_GET['id'];

try {
    // First get the contact to check for image
    $stmt = $pdo->prepare("SELECT image_path FROM PERSON WHERE id = ?");
    $stmt->execute([$contactId]);
    $contact = $stmt->fetch();

    if ($contact) {
        // Delete associated phone numbers first (foreign key constraint would handle this, but explicit is better)
        $stmt = $pdo->prepare("DELETE FROM PHONE_NUMBERS WHERE person_id = ?");
        $stmt->execute([$contactId]);

        // Delete the contact
        $stmt = $pdo->prepare("DELETE FROM PERSON WHERE id = ?");
        $stmt->execute([$contactId]);

        // If contact had an image, delete it from server
        if ($contact['image_path'] && file_exists('../' . $contact['image_path'])) {
            unlink('../' . $contact['image_path']);
        }

        // Also delete any birthday notifications for this contact
        $stmt = $pdo->prepare("DELETE FROM BIRTHDAY_NOTIFICATIONS WHERE sender_id = ?");
        $stmt->execute([$contactId]);

        header("Location: ../pages/contacts/list.php?success=contact_deleted");
    } else {
        header("Location: ../pages/contacts/list.php?error=contact_not_found");
    }
} catch (PDOException $e) {
    // Log the error
    error_log("Error deleting contact: " . $e->getMessage());
    header("Location: ../pages/contacts/list.php?error=delete_failed");
}
exit;
?>