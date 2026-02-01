# 📝 TaskBoard - Task Management System

![Status](https://img.shields.io/badge/Status-Project%20Active-brightgreen)
![Version](https://img.shields.io/badge/Version-1.0.0-blue)
![License](https://img.shields.io/badge/License-MIT-gray)

**TaskBoard** is a professional planning system designed to streamline workflow management. This project was developed as a mission for TaskBoard Inc. to provide an intuitive interface for tracking, prioritizing, and managing daily activities.

---

## 🚀 Key Features

### 🔐 Security & Access
* **Secure Authentication:** Complete registration/login system.
* **Data Protection:** Password hashing using **bcrypt**, protection against **CSRF**, and **SQL Injection**.
* **Form Validation:** Strict server-side and client-side validation.

### 📋 Task Management (CRUD)
* **Full Lifecycle:** Create, Read, Update, and Delete tasks.
* **Soft Delete:** Tasks are archived rather than permanently erased.
* **Dynamic Inputs:** Add up to 5 tasks at once using Vanilla JavaScript.
* **Metadata:** Manage deadlines, priorities (Low/Medium/High), and statuses.

### 📊 Intelligence & Search
* **Smart Dashboard:** Real-time stats (Total, Overdue, Completion %).
* **Advanced Filtering:** Filter by priority, status, and sort by deadline.
* **Live Search:** Instant search by title or description keywords.

---

## 🛠 Tech Stack

* **Backend:** PHP Laravel (MVC Architecture)
* **Frontend:** HTML5, CSS3, JavaScript (Vanilla / Alpine.js)
* **Database:** MySQL
* **Planning:** Jira / Kanban

---

## 🏗 Architecture

The project follows the **MVC (Model-View-Controller)** pattern:

1.  **Model:** Manages database logic and relations.
2.  **View:** Renders the UI and provides user feedback.
3.  **Controller:** Handles the logic between the User and the Data.

---

## 💻 Installation & Setup

1. **Clone the repository**
   ```bash
   git clone [https://github.com/your-username/taskboard.git](https://github.com/your-username/taskboard.git)
