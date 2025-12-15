About SpringCo Fintech Solution

The system enforces defined business rules such as automatic account creation, maximum account limits per customer, minimum balance requirements for interest calculation, and full transaction traceability. It is built to demonstrate clean backend logic, relational data modeling, and practical fintech workflows.

Key Features
Customer Management
User registration and authentication.
Automatic creation of a FLEX account upon registration.
Maximum of five (5) accounts per customer.
Support for soft deletion of customers.

Account Management
Supported account types:
FLEX
DELUXE
VIVA
PIGGY
SUPA

Create, view, update, and close accounts.
View account balances, status, and creation dates.
Transactions
Account funding (credit).
Account withdrawal (debit) with balance validation.
Full transaction history retained for audit purposes.

Interest Management
Interest calculation based on account type.
Minimum balance requirement of NGN 20,000.

Interest rates:
FLEX: 2.5%
DELUXE: 3.5%
VIVA: 6.0%
PIGGY: 9.2%
SUPA: 10.0%

Optional interest history logging.
Reporting and Filtering
View customers and their accounts.
Filter customers by account type.
Identify unassigned accounts.
Identify customers with zero total balance.

Business Rules
FLEX account is automatically created on user registration.
A customer may own a maximum of five (5) accounts.
Overdrafts are not permitted.
Interest is calculated only when the minimum balance requirement is met.
Accounts may exist independently of customers.
All financial activities maintain an audit trail.

ROUTES
/register
/login
/dashboard
/create-account
/fund

API Endpoints
Authentication
POST /auth/register
POST /auth/login
POST /create-account
POST /fund


Installation
Clone the repository:
git clone https://github.com/uRPopsi/Vale-Assessment-Test.git
cd Vale-Assessment-Test

Install Xampp:
Upon installation activate Apace and MySQL

Install dependencies:
composer install
npm install


Set up environment variables:
cp .env.example .env
php artisan key:generate


Configure the database in .env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=


Run migrations and seeders:
php artisan migrate --seed


Start the application:
php artisan serve
npm run dev (Open a second terminal)


Access the application:
http://127.0.0.1:8000

Current Usage
Register a new user to automatically receive a FLEX account.
Register functionality is bugging so click the Already Logged In link multiple times to be redirected to dashboard
View accounts.
Filter accounts
Click the Create Account button to go to the create account page. (creation functionality is bugging)
Click the Fund button to go to the fund account page. (funding functionality is bugging)

Technology Stack
Backend: Laravel 10, Livewire, Jetstream
Frontend: Tailwind CSS
Database: MySQL

Tooling: Composer, NPM
