# Unity Care Clinic - Backend Management System

## Project Overview
This project involves the development of the first version of the backend for the Unity Care Clinic platform. Built using procedural PHP 8.5 and MySQLi, the system provides a robust administration interface to manage the clinic's core entities, including patients, doctors, and departments.

The central component of this application is a dynamic dashboard that offers administrators a global view of the system status, key statistics, and activity tracking to facilitate decision-making.

## Key Features

### 1. Entity Management (CRUD)
The system provides comprehensive management interfaces for the following:
* **Patients:** Create, read, update, and delete patient records.
* **Doctors:** Manage doctor profiles and associate them with specific departments.
* **Departments:** Administration of clinic departments.

### 2. Dashboard & Analytics
A centralized dashboard providing real-time insights:
* Key performance indicators (Total doctors, breakdown by specialty, etc.).
* Interactive charts and diagrams powered by Chart.js.
* Dynamic data refreshing.

### 3. Internationalization (i18n)
* Multi-language support (English, French).
* User capability to switch interface languages directly from the dashboard.

### 4. User Experience Enhancements
* AJAX integration for asynchronous operations (smoother navigation without page reloads).
* Modal windows for context-aware form management.

## Technical Architecture

### Technology Stack
* **Backend:** PHP 8.5 (Procedural style).
* **Database:** MySQL with MySQLi extension.
* **Frontend:** HTML5, CSS3, JavaScript.
* **Libraries:** Chart.js (Data visualization).

### Design Patterns & Best Practices
* **Modular Architecture:** Code is organized into logical modules to ensure maintainability.
* **DRY Principle:** "Don't Repeat Yourself" applied via reusable functions and included files.
* **Security:**
    * **Prepared Statements:** To prevent SQL Injection attacks.
    * **Input Sanitization:** To protect against XSS (Cross-Site Scripting).
    * **Secure Connection:** proper handling of database credentials.

## Prerequisites
* Web Server (Apache/Nginx)
* PHP 8.5 or higher
* MySQL Database Server

## Installation and Setup

 **Clone the Repository**
    To download the project to your local machine:
    ```bash
    git clone https://github.com/ikara-py/Backend-V1
    ```
## Project Structure

```text
|-- /assets             # CSS, JS, Images
|-- /config             # Database connection and global configuration
|-- /lang               # Translation files (fr.php, en.php)
|-- /pages              # Patients, Doctors, and Departments
|-- /database           # SQL scripts and ERD diagrams
|-- index.php           # Dashboard / Landing page
|-- README.md           # Project documentation