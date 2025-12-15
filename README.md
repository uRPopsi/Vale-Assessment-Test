# SpringCo Fintech Solution

A **Laravel 10 + Livewire fintech application** for managing customer accounts, transactions, and interest calculations.

---

## Features

- **Automatic FLEX Account**: Created upon user registration
- **Multiple Account Support**: Up to 5 accounts per customer
- **Fund & Withdraw Operations**: With balance validation
- **Automatic Interest Calculation**: For balances ≥ ₦20,000
- **Dashboard Filtering**:
  - Filter by account type
  - View accounts without customers
  - List customers with zero balance

---

## Account Types & Interest Rates

| Account Type | Interest Rate | Minimum Balance |
|--------------|---------------|-----------------|
| FLEX         | 2.5%          | ₦20,000         |
| DELUXE       | 3.5%          | ₦20,000         |
| VIVA         | 6.0%          | ₦20,000         |
| PIGGY        | 9.2%          | ₦20,000         |
| SUPA         | 10.0%         | ₦20,000         |

---

## Routes & Pages

- `/register` – User registration
- `/login` – User authentication
- `/dashboard` – Account overview with filters
- `/create-account` – Create new account
- `/fund` – Fund existing account
- `/withdraw` – Withdraw from account
- `/interest` – View interest details

---

## API Endpoints

### Authentication
```http
POST /auth/register
POST /auth/login
```

### Account Operations
```http
POST /create-account
POST /fund
POST /withdraw
```

### Request Examples


**Fund Account:**
```json
{
  "account_id": 1,
  "amount": 50000
}
```

**Withdraw from Account:**
```json
{
  "account_id": 1,
  "amount": 10000
}
```

---

## Installation & Setup

```bash
# Clone repository
git clone https://github.com/uRPopsi/Vale-Assessment-Test.git
cd Vale-Assessment-Test

# Install XAMPP
Install XAMPP and turn on Apache and MySQL

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Update .env with database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=springco_fintech
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Start development servers
php artisan serve
npm run dev
```

Visit: `http://127.0.0.1:8000`

---

## Tech Stack

- **Backend**: Laravel 10, Livewire, Jetstream
- **Frontend**: Tailwind CSS
- **Database**: MySQL
- **Package Managers**: Composer, NPM

---

## Notes

- Each customer can have a maximum of 5 active accounts
- FLEX accounts are automatically created during registration
