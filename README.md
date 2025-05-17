
---

### ✅ `backend/README.md`

```markdown
# Event Booking Backend 🎯 (Laravel API)

This is the backend API built with Laravel, serving as the core of the Event Booking platform. It manages user authentication, event data, and booking functionality.

---

## 🛠️ Setup Instructions

### Prerequisites:
- PHP 8.1+
- Composer
- MySQL or MariaDB

### Installation:

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate

# Setup DB connection in .env, then run:
php artisan migrate --seed
php artisan serve
