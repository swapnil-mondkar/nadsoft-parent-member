# Member Tree Management App

A simple PHP-based web application to manage and visualize a hierarchical tree structure of members (like a family tree or organizational chart).

## 🚀 Features

- Add new members with optional parent (to build hierarchy)
- Tree is rendered recursively with nested lists
- Frontend updates dynamically using jQuery + AJAX
- Fancybox modal used for member input form

## 🧱 Tech Stack

- **PHP** (with OOP)
- **MySQL** (for member storage)
- **jQuery** (AJAX + DOM)
- **Fancybox** (for modal)

## 📁 Project Structure

```
project/
│
├── config/
│   └── db.php                # Database connection setup
│
├── classes/
│   ├── member_repository.php # Handles DB queries
│   └── member_service.php    # Business logic (tree generation, etc.)
│
├── js/
│   └── script.js             # Handles form submit & DOM update
│
├── index.php                 # Main page
├── insert.php                # API to add member
├── get_members.php           # Get members as JSON
├── get_tree.php              # Get Tree as JSON
└── README.md
```

## ⚙️ Setup

1. **Clone the repo**:
   ```bash
   git clone https://github.com/swapnil-mondkar/nadsoft-parent-member.git
   cd member-tree-app
   ```

2. **Configure the database**:
   - Create a MySQL database and a `Members` table:
     ```sql
     CREATE TABLE Members (
         Id INT AUTO_INCREMENT PRIMARY KEY,
         Name VARCHAR(255) NOT NULL,
         ParentId INT DEFAULT NULL,
         CreatedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```
   - Update your DB credentials in `config/db.php`.

3. **Run the app**:
   - Serve it using PHP’s built-in server:
     ```bash
     php -S localhost:8000
     ```
   - Open `http://localhost:8000` in your browser.

## ✅ Example Usage

- Click "Add Member"
- Enter name and (optionally) select parent
- Click "Save Changes"
- Tree updates immediately

## 💡 Notes

- The tree is built recursively using `MemberService::buildTree()`
- Separation of concerns is maintained using Repository & Service classes

## 📄 License

MIT
