# SpringCo Fintech Solution

A **Laravel 10 + Livewire fintech application** for managing customer accounts, transactions, and interest calculations.
This project exposes **secure REST API endpoints (Laravel Sanctum)** that can be tested via **Postman**, alongside a functional web UI built with Jetstream.

---

## Features

* **Automatic FLEX Account**

  * A FLEX account is automatically created upon user registration

* **Multiple Account Support**

  * Each customer can have up to **5 accounts**
  * Supported types: FLEX, DELUXE, VIVA, PIGGY, SUPA

* **Fund & Withdraw Operations**

  * Secure balance updates
  * Insufficient balance protection

* **Automatic Interest Calculation**

  * Interest applies only when balance ≥ ₦20,000
  * Rate depends on account type

* **Dashboard Filtering**

  * Filter by account type
  * View all user accounts and balances

---

## Account Types & Interest Rates

| Account Type | Interest Rate | Minimum Balance |
| ------------ | ------------- | --------------- |
| FLEX         | 2.5%          | ₦20,000         |
| DELUXE       | 3.5%          | ₦20,000         |
| VIVA         | 6.0%          | ₦20,000         |
| PIGGY        | 9.2%          | ₦20,000         |
| SUPA         | 10.0%         | ₦20,000         |

---

## Routes & Pages (Web UI)

These routes are used by the **Livewire + Jetstream UI** and require browser-based authentication:

* `/` – User registration page
* `/login` – User authentication
* `/dashboard` – Account overview and filters
* `/create-account` – Create a new account
* `/fund` – Fund an existing account
* `/withdraw` – Withdraw from an account
* `/interest` – View interest details

> These routes are **not intended for Postman testing** due to CSRF protection.

---

## API Endpoints (Postman Ready)

All API endpoints are prefixed with:

```
http://127.0.0.1:8000/api
```

---

### Authentication

#### Register

```
POST /api/register
```

**Body (JSON):**

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

Returns an **authentication token**.

---

#### Login

```
POST /api/login
```

**Body (JSON):**

```json
{
  "email": "john@example.com",
  "password": "password"
}
```

Returns an **authentication token**.

---

### Authentication Requirement (Important)

All protected endpoints require authentication.

In Postman:

1. Open the **Authorization** tab
2. Set **Auth Type** to `Bearer Token`
3. Paste the token returned from `/login` or `/register`

---

### Account Operations

#### Get All User Accounts

```
GET /api/accounts
```

Returns all accounts belonging to the authenticated user.

---

#### Create a New Account

```
POST /api/accounts
```

**Body (JSON):**

```json
{
  "account_type_id": 2
}
```

* Users cannot have more than **5 accounts**
* `account_type_id` must exist in the `account_types` table

---

### Fund & Withdraw Operations

> **Important:**
> The number in the URL represents the **ACCOUNT ID**, not the user ID. The account's ID can be found inside of the database in the accounts table named "id".

Example:

```
/api/accounts/12/fund
```

Funds the account with ID **12**.

---

#### Fund Account

```
POST /api/accounts/{account_id}/fund
```

**Body (JSON):**

```json
{
  "amount": 5000
}
```

Updates the account balance and records the transaction.

---

#### Withdraw From Account

```
POST /api/accounts/{account_id}/withdraw
```

**Body (JSON):**

```json
{
  "amount": 2000
}
```

Returns an error if the balance is insufficient.

---

### Interest Calculation

#### View Interest

```
GET /api/accounts/{account_id}/interest
```

Returns calculated interest based on account type and balance.

---

### Logout

```
POST /api/logout
```

Logs out the authenticated user and invalidates the token.

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

Visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Tech Stack

* **Backend:** Laravel 10, Sanctum, Jetstream
* **Frontend:** Livewire, Tailwind CSS
* **Database:** MySQL
* **Authentication:** Laravel Sanctum
* **Tooling:** Composer, NPM

---

## Notes

* Each customer can have a **maximum of 5 accounts**
* **FLEX accounts** are automatically created during registration
* **API endpoints** are fully testable via Postman
* Web UI and API authentication are intentionally separated
* For fund and withdraw endpoints, the `{id}` in the URL represents the **account ID**

---
