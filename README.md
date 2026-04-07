# Mithlesh Nursing Home Management System

A comprehensive Hospital/Nursing Home Management System built with CodeIgniter 4.6 and Bootstrap 5.

## Features

### Public Panel
- **Home Page** - Hero section, services overview, doctors preview, stats
- **About Us** - Mission, vision, and core values
- **Services** - Complete list of medical services
- **Doctors List** - Doctor profiles with specialization
- **Contact Page** - Contact information and inquiry form
- **Inquiry Form** - Stores inquiries in database

### Admin Panel
- **Dashboard** - Statistics cards, quick actions
- **Patient Management** - CRUD operations, auto patient ID generation, IPD/OPD tracking
- **Staff Management** - Doctor, Nurse, Receptionist, Lab Technician, Pharmacist
- **Doctor Management** - Specialization, experience, availability
- **Appointment Management** - Book appointments, assign doctors, status tracking
- **Inquiry Management** - View and manage public inquiries
- **Billing Module** - Generate bills, payment tracking, printable bills

## Tech Stack
- **Backend**: CodeIgniter 4.6 (PHP 8.1+)
- **Frontend**: Bootstrap 5, Bootstrap Icons
- **Database**: MySQL
- **Authentication**: Session-based

## Installation Steps

### 1. Database Setup

1. Create a MySQL database named `Mithlesh_nursing`:
```sql
CREATE DATABASE Mithlesh_nursing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Run the database migrations:
```bash
# Navigate to project directory
cd C:\xampp\htdocs\ci4.6

# Run migrations
php spark migrate
```

Alternatively, you can run migrations from the browser after accessing the site.

### 2. Configuration

The `.env` file is already configured with:
- Environment: development
- Base URL: http://localhost/ci4.6/public/
- Database: Mithlesh_nursing
- Username: root (change if different)
- Password: "" (change if different)

### 3. Access the Application

**Public Website:**
```
http://localhost/ci4.6/public/
```

**Admin Panel:**
```
http://localhost/ci4.6/public/admin/login
```

**Default Admin Credentials:**
- Email: admin@Mithleshnursing.com
- Password: admin123

## Project Structure

```
app/
├── Config/
│   ├── Filters.php       # Auth filter registered
│   └── Routes.php        # All routes configured
├── Controllers/
│   ├── Admin/
│   │   ├── Auth.php           # Admin login/logout
│   │   ├── Dashboard.php      # Admin dashboard
│   │   ├── Patients.php       # Patient CRUD
│   │   ├── Staff.php          # Staff CRUD
│   │   ├── Doctors.php        # Doctor CRUD
│   │   ├── Appointments.php   # Appointment management
│   │   ├── Inquiries.php      # Inquiry management
│   │   └── Bills.php          # Billing module
│   └── Home.php               # Public website controller
├── Database/
│   └── Migrations/       # All database migrations
├── Filters/
│   └── AuthFilter.php    # Authentication filter
├── Models/
│   ├── UserModel.php
│   ├── DoctorModel.php
│   ├── PatientModel.php
│   ├── StaffModel.php
│   ├── AppointmentModel.php
│   ├── InquiryModel.php
│   ├── BillModel.php
│   └── ServiceModel.php
└── Views/
    ├── admin/
    │   ├── auth/login.php
    │   ├── layout/main.php
    │   ├── dashboard/index.php
    │   ├── patients/
    │   ├── staff/
    │   ├── doctors/
    │   ├── appointments/
    │   ├── inquiries/
    │   └── bills/
    └── public/
        ├── layout/main.php
        ├── home.php
        ├── about.php
        ├── services.php
        ├── doctors.php
        └── contact.php
```

## Database Schema

### Tables Created

1. **users** - Admin users
2. **doctors** - Doctor information
3. **patients** - Patient records with auto-generated IDs
4. **staff** - Staff members (doctors, nurses, etc.)
5. **appointments** - Appointment bookings
6. **inquiries** - Contact form submissions
7. **bills** - Billing records
8. **services** - Hospital services

## Key Features

### Patient Management
- Auto-generated Patient ID (format: SNHYYYY####)
- IPD/OPD patient types
- Admission and discharge tracking
- Room/bed assignment
- Doctor assignment
- Disease/diagnosis tracking
- Bill amount tracking

### Billing System
- Auto-generated Bill Number
- Multiple charge categories:
  - Room charges
  - Doctor fees
  - Medicine charges
  - Test charges
  - Other charges
- Discount calculation
- Payment status tracking
- Printable bill format

### Appointment System
- Book appointments with doctor selection
- Date and time scheduling
- Status tracking (Pending, Confirmed, Completed, Cancelled)
- Today's appointments view

## Security Features

- CSRF protection enabled
- Session-based authentication
- Password hashing (bcrypt)
- Input validation and sanitization
- SQL injection prevention (Query Builder)
- XSS protection (esc() helper)
- Admin route protection via filter

## Troubleshooting

### Issue: "The application environment is not set correctly"
**Solution**: Check .env file has `CI_ENVIRONMENT = development` (not "devlopment")

### Issue: Database connection failed
**Solution**: 
1. Ensure MySQL is running in XAMPP
2. Check database credentials in .env file
3. Verify database `Mithlesh_nursing` exists

### Issue: 404 errors
**Solution**: Ensure .htaccess is configured for URL rewriting in public folder

### Issue: "Cannot declare class Config\Filters"
**Solution**: This was a duplicate class issue - now fixed in the code

## Development

### Running Migrations
```bash
php spark migrate
```

### Rollback Migrations
```bash
php spark migrate:rollback
```

### Create New Migration
```bash
php spark make:migration MigrationName
```

### Create New Controller
```bash
php spark make:controller ControllerName
```

### Create New Model
```bash
php spark make:model ModelName
```

## Support

For any issues or questions, please contact the development team.

## License

This project is proprietary software for Mithlesh Nursing Home.

---

**Built with ❤️ using CodeIgniter 4**