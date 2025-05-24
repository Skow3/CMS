# 📇 CMS - Contact Management System

A **responsive and elegant Contact Management System (CMS)** built with **PHP**, **Tailwind CSS**, and **MySQL**. It allows users to **add, edit, delete**, and **search** contacts through a clean, intuitive interface.

Currently designed for **single-user** operation — multi-user support is planned for a future release.

---

## 🚀 Features

- ✅ Add new contacts with name, phone, email, and notes
- ✏️ Edit existing contacts
- 🗑️ Delete contacts with confirmation
- 🔍 Real-time contact search
- 📱 Fully responsive layout (Tailwind CSS)
- 🔒 Input validation and basic security

---

## 📸 Screenshot
DESKTOP VIEW
![Screenshot From 2025-03-29 21-36-35](https://github.com/user-attachments/assets/bff3c38f-156c-4da8-b6a9-5be06f12574c)
MOBILE VIEW
![Screenshot From 2025-03-29 21-38-06](https://github.com/user-attachments/assets/3209240c-a640-4f6b-99cd-5b33b290ecc1)
![Screenshot From 2025-03-29 22-07-37](https://github.com/user-attachments/assets/4da6d81c-b457-4016-a231-2ab9176e7c62)


---

## 🧰 Tech Stack

- **Frontend**: HTML, Tailwind CSS, minimal JavaScript
- **Backend**: PHP (procedural or OOP based)
- **Database**: MySQL
- **Extras**: Responsive design, secure DB interactions (PDO recommended)

---

## 🔧 Installation

1. **Clone the repo**

   ```bash
   git clone https://github.com/yourusername/cms-contact-manager.git
   cd cms-contact-manager
````

2. **Import the database**

   * Open MySQL or phpMyAdmin
   * Import the `contacts.sql` file included in the repo

3. **Configure the database connection**

   In `config.php` (or wherever you're managing DB connection):

   ```php
   $host = 'localhost';
   $dbname = 'cms';
   $username = 'root';
   $password = '';
   ```

   > Update with your actual DB credentials

4. **Run locally**

   Place the folder in your local server (`htdocs` for XAMPP or `/var/www/html` for Apache), and access it in your browser:

   ```
   http://localhost/cms-contact-manager/
   ```

---

## 🛡️ Security Notes

* Basic input sanitization is applied
* Future updates will include:

  * Multi-user support with authentication
  * CSRF protection and session handling
  * Role-based access (admin vs user)

---

## 🗃️ Project Structure

```bash
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── script.js
├── config/
│   └── database.php
├── images/
├── includes/
│   ├── auth.php
│   ├── bottom_nav.php
│   ├── footer.php
│   ├── functions.php
│   └── header.php
├── pages/
│   ├── contacts/
│   │   ├── add.php
│   │   ├── edit.php
│   │   ├── list.php
│   │   └── view.php
│   ├── birthdays.php
│   ├── favorites.php
│   └── notifications.php
├── process/
│   ├── contact_process.php
│   ├── delete.php
│   └── notification_process.php
├── index.php
├── LICENSE
└── README.md
```

---

## 🛠️ TODO (Future Improvements)

* [ ] Multi-user authentication and sessions
* [ ] Password-protected accounts
* [ ] Export contacts to CSV/Excel
* [ ] Profile picture uploads
* [ ] Tag-based contact grouping

---

## 🧑‍💻 Author

**Skowport**

Feel free to fork this project, suggest improvements, or report issues!

---

## 📄 License

MIT License — Free to use and modify.

```

---

Let me know if you want:
- A license file
- `contacts.sql` template
- Markdown badges (for PHP, Tailwind, MySQL, etc.)
- GitHub Pages setup (for documentation/demo)

Ready when you are!
```
