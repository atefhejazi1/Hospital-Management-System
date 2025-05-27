## 🏥 Hospital Management System - Laravel

### 📋 Overview

This is a full-featured **Hospital Management System (HMS)** built using **Laravel** and **Livewire**. The system helps hospitals and clinics manage daily operations such as appointments, patients, doctors, billing, and medical records in a secure and efficient way.

> ❗ Note: This project does **not** use REST APIs. All interactions are handled via server-side rendering using **Livewire**.
> 💬 It includes a built-in **chat system** (Pusher) for real-time communication between doctors and patients.

---

### 🚀 Features

* 🏥 Departments and Clinics Management
* ⚕️ Doctor and Patient Profiles
* ⏰ Appointment Scheduling
* 💵 Invoice and Billing System
* 📃 Medical Records for each patient
* 🔐 Role-based Access Control
* 📊 Reports and Statistics
* 📂 Logs and Activity History
* 💬 Real-time Chat with Pusher
* ✨ Built with **Livewire** and **Repository Design Pattern**

---

### 🔧 Technologies Used

* Laravel 12
* Livewire
* Repository Design Pattern
* MySQL
* Bootstrap
* Pusher (Real-time Chat)

---

### 🔐 Authentication and Roles

The system includes:

* Admin login and dashboard
* Multiple user roles (Admin, Doctor, Receptionist, etc.)
* Permission-based access control for all modules

---

### ✅ How to Run Locally

```bash
git clone https://github.com/atefhejazi1/Hospital-Management-System.git
cd hospital-management-system
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
---

### 📄 Sample Modules Included

* Doctors & Specializations
* Patients and Medical Files
* Appointments Calendar
* Payments, Invoices & Receipts
* Medication & Prescriptions
* Notifications and Activity Log
* Real-time Doctor/Patient Chat

---

### 💬 Contact

Developed by [Atef Hejazi](https://www.linkedin.com/in/atefhejazi)
