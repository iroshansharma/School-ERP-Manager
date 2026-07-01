# School ERP Manager

A complete WordPress-based **School Management Portal (Mini ERP)** developed using a **Custom Theme** and **Custom Plugin**.

This project was created as part of the **WordPress Internship Assignment**.

---

# Project Information

**Project Name:** School ERP Manager

**Developer:** Roshan Sharma

**Version:** 1.0.0

**Platform:** WordPress

**PHP:** 8.0+

**Database:** MySQL

---

# Features

## Custom Theme

- Responsive Layout
- Header & Footer
- Homepage
- About School Page
- Contact Page
- Blog Page
- Custom Navigation Menu
- Custom Logo
- Widget Areas
- Theme Customizer

---

## Student Management

- Custom Post Type (Students)
- Student Profile
- Roll Number
- Section
- Student Photo
- Archive Page
- Single Student Page

---

## Attendance Module

- Mark Attendance
- Manage Attendance
- Edit Attendance
- Delete Attendance
- Bulk Delete
- Search Attendance
- Attendance Report
- Student Attendance Dashboard

---

## Notice Board Module

- Add Notice
- Edit Notice
- Delete Notice
- Bulk Delete
- Search Notices
- Notice Expiry Date
- Automatically Hide Expired Notices
- Frontend Notice Board

### Frontend Shortcode

```text
[school_notices]
```

---

## REST API Integration

Integrated JSONPlaceholder REST API using WordPress HTTP API.

### Features

- wp_remote_get()
- Error Handling
- JSON Response
- Decode API Response
- Display API Data

### Shortcode

```text
[api_test]
```

---

## Dashboards

### Admin Dashboard

- Statistics
- Attendance Summary
- Notice Count
- Quick Actions

### Teacher Dashboard

- Attendance Management
- Student Dashboard Access

### Student Dashboard

- Student Profile
- Attendance Summary
- Latest Notices

---

# User Roles

### Administrator

- Full Access

### Teacher

- Teacher Dashboard
- Student Dashboard
- Attendance Management
- Notice Management

### Student

- Student Dashboard
- Attendance History
- Latest Notices

---

# Security

- WordPress Nonces
- Data Sanitization
- Data Escaping
- Prepared SQL Queries

---

# Database

## Custom Tables

```
wp_student_attendance
wp_school_notices
```

---

# Technologies Used

- WordPress
- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- WordPress Shortcodes
- WordPress REST API
- Custom Post Types
- WP_List_Table

---

# Installation

Follow the steps below to install the School ERP Manager project:

### Step 1: Install WordPress
Install and configure a fresh WordPress website on your local server (XAMPP/WAMP) or web hosting.

### Step 2: Log in
Log in to the WordPress Admin Dashboard using an **Administrator** account.

### Step 3: Install the Custom Theme

1. Go to **Appearance → Themes**.
2. Click **Add New**.
3. Click **Upload Theme**.
4. Click **Choose File** and select the **School_erp_theme.zip** file.
5. Click **Install Now**.
6. After installation, click **Activate**.

### Step 4: Install the School ERP Plugin

1. Go to **Plugins → Add New**.
2. Click **Upload Plugin**.
3. Click **Choose File** and select the **school-erp-manager.zip** file.
4. Click **Install Now**.
5. After installation, click **Activate Plugin**.

### Step 5: Automatic Setup

After activating the plugin:

- Required database tables are created automatically.
- User roles and permissions are configured.
- Default pages and shortcodes are registered.
- The School ERP system is ready to use.

### Step 6: Login and Start

Log in as an **Administrator** to access the complete School ERP system and start managing students, attendance, notices, and dashboards.

---

# Available Shortcodes

## Student Dashboard

```text
[student_dashboard]
```

## Teacher Dashboard

```text
[teacher_dashboard]
```

## Admin Dashboard

```text
[admin_dashboard]
```

## Notice Board

```text
[school_notices]
```

## REST API Demo

```text
[api_test]
```

---

# Folder Structure

```
School_erp_theme/
│
├── archive.php
├── archive-students.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── home.php
├── index.php
├── page.php
├── page-about.php
├── page-contact.php
├── page-school-notices.php
├── single.php
├── single-students.php
├── sidebar.php
├── style.css
└── README.md
```
---

```
school-erp-manager/

│
├── admin/
|   ├── attendance-page.php 
|   ├── attendance-report.php
|   ├── class-attendance-list-table.php
|   ├── class-notice-list-table.php
|   ├── manage-attendance.php
|   ├── manage-notices.php
|   └──  notice-page.php
|
├── assets/
|   ├── css/
|        └── admin.css
|   └── js/
|        └──  admin.js
│
├── includes/
│   ├── activation.php
│   ├── attendance.php
│   ├── database.php
|   ├── notices.php
│   ├── pages.php
│   ├── redirects.php
│   ├── roles.php
│   └── permissions.php
│
└── school-erp-manager.php
```

---

# Assignment Modules Completed

- ✅ Custom Theme Development
- ✅ Student Custom Post Type
- ✅ Attendance Management
- ✅ Notice Board Management
- ✅ REST API Integration
- ✅ Custom Database Tables
- ✅ Security Implementation
- ✅ Admin Dashboard
- ✅ Teacher Dashboard
- ✅ Student Dashboard
- ✅ WordPress Shortcodes

---

# Future Improvements

- Fee Management
- Exam Management
- Result Management
- Library Management
- Timetable
- Parent Dashboard
- SMS Notifications
- Email Notifications
- Export PDF
- Export Excel

---

# Author

**Roshan Sharma**

---

# License

This project is developed for educational and internship purposes.