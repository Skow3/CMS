<?php
require_once '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $fav = isset($_POST['fav']) ? 'Y' : 'N';
    
    // Handle file upload
    $imagePath = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/profile_images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $destination = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $destination)) {
            $imagePath = 'assets/uploads/profile_images/' . $filename;
        }
    }
    
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO PERSON (FirstName, LastName, Email, DOB, image_path, fav) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $dob, $imagePath, $fav]);
    
    // Get the last inserted ID
    $personId = $pdo->lastInsertId();
    
    // Insert phone numbers
    if (isset($_POST['phone_numbers'])) {
        foreach ($_POST['phone_numbers'] as $phone) {
            if (!empty($phone['number'])) {
                $stmt = $pdo->prepare("INSERT INTO PHONE_NUMBERS (person_id, PhoneN, label) VALUES (?, ?, ?)");
                $stmt->execute([$personId, $phone['number'], $phone['label']]);
            }
        }
    }
    
    header("Location: list.php");
    exit;
}
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Contact</h1>
    
    <form action="add.php" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Profile Image -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Profile Image</label>
                <div class="flex items-center space-x-4">
                    <div id="avatar-preview" class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">Preview</span>
                    </div>
                    <input type="file" name="profile_image" id="profile_image" class="border rounded p-2" accept="image/*" onchange="previewImage(this)">
                </div>
            </div>
            
            <!-- Name Fields -->
            <div>
                <label for="first_name" class="block text-gray-700 mb-2">First Name*</label>
                <input type="text" id="first_name" name="first_name" required class="w-full border rounded p-2">
            </div>
            
            <div>
                <label for="last_name" class="block text-gray-700 mb-2">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="w-full border rounded p-2">
            </div>
            
            <!-- Email and DOB -->
            <div>
                <label for="email" class="block text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full border rounded p-2">
            </div>
            
            <div>
                <label for="dob" class="block text-gray-700 mb-2">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="w-full border rounded p-2">
            </div>
            
            <!-- Phone Numbers (Dynamic) -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">Phone Numbers</label>
                <div id="phone-numbers-container">
                    <div class="phone-number-group flex space-x-2 mb-2">
                        <select name="phone_numbers[0][label]" class="border rounded p-2">
                            <option value="Primary">Primary</option>
                            <option value="Secondary">Secondary</option>
                            <option value="Work">Work</option>
                            <option value="Home">Home</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="tel" name="phone_numbers[0][number]" class="border rounded p-2 flex-grow" placeholder="Phone number">
                        <button type="button" class="bg-red-500 text-white px-3 rounded" onclick="removePhoneField(this)">×</button>
                    </div>
                </div>
                <button type="button" onclick="addPhoneField()" class="mt-2 bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded text-sm">+ Add Another</button>
            </div>
            
            <!-- Favorite -->
            <div class="md:col-span-2 flex items-center">
                <input type="checkbox" id="fav" name="fav" class="mr-2">
                <label for="fav" class="text-gray-700">Mark as favorite</label>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
            <a href="list.php" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Cancel</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Save Contact</button>
        </div>
    </form>
</div>

<script>
let phoneCount = 1;

function addPhoneField() {
    const container = document.getElementById('phone-numbers-container');
    const newGroup = document.createElement('div');
    newGroup.className = 'phone-number-group flex space-x-2 mb-2';
    newGroup.innerHTML = `
        <select name="phone_numbers[${phoneCount}][label]" class="border rounded p-2">
            <option value="Primary">Primary</option>
            <option value="Secondary">Secondary</option>
            <option value="Work">Work</option>
            <option value="Home">Home</option>
            <option value="Other">Other</option>
        </select>
        <input type="tel" name="phone_numbers[${phoneCount}][number]" class="border rounded p-2 flex-grow" placeholder="Phone number">
        <button type="button" class="bg-red-500 text-white px-3 rounded" onclick="removePhoneField(this)">×</button>
    `;
    container.appendChild(newGroup);
    phoneCount++;
}

function removePhoneField(button) {
    const group = button.closest('.phone-number-group');
    if (document.querySelectorAll('.phone-number-group').length > 1) {
        group.remove();
    } else {
        group.querySelector('input[type="tel"]').value = '';
    }
}
// USED GPT HERE , ALSO NOT DOING THE PHOTO UPLOAD THING IN THE SERVER
function previewImage(input) {
    const preview = document.getElementById('avatar-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-full">`;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php require_once '../../includes/footer.php'; ?>