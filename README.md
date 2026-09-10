# 🪙 Gardecet - Crypto Faucet & Earning Platform

A modern cryptocurrency earning platform built with Laravel that allows users to earn various cryptocurrencies through multiple methods including faucet claims, PTC (Paid-to-Click) advertisements, mining plans, and referral commissions.

## ✨ Features

### 🚀 User Features
- **Multi-Currency Faucet** - Claim BTC, LTC, DOGE, and other cryptocurrencies periodically
- **PTC Advertisement System** - Earn rewards by viewing advertisements with timer-based verification
- **Mining Plans** - Purchase mining contracts for passive cryptocurrency income
- **Referral Program** - Earn commissions from your referrals' activities
- **Coupon System** - Redeem promotional codes for bonus rewards
- **Energy System** - Gamified energy mechanics for user engagement
- **Auto-Payout** - Instant withdrawals via FaucetPay integration
- **Multi-Currency Balance** - Separate balance tracking for each cryptocurrency

### 🎯 Admin Features
- **Comprehensive Dashboard** - Real-time statistics and analytics
- **User Management** - Monitor and manage user accounts
- **Faucet Configuration** - Set reward amounts, cooldowns, and energy costs
- **PTC Ad Management** - Create and manage advertisement campaigns
- **Mining Plan Control** - Configure mining plans with custom rewards and durations
- **Coupon Management** - Generate and track promotional coupons
- **Settings Panel** - Configure platform settings and API integrations

### 🔐 Security & Integration
- **FaucetPay Authentication** - Secure email-based login via FaucetPay API
- **hCaptcha Protection** - Bot prevention and abuse protection
- **Atomic Transactions** - Safe balance operations with database-level atomicity
- **Session Management** - Secure session handling with CSRF protection
- **Admin Guard** - Separate authentication for admin panel

## 🛠️ Tech Stack

- **Framework**: Laravel 13.17
- **PHP**: 8.3+
- **Frontend**: Tailwind CSS 4.0, Vite 8.0
- **Database**: SQLite (default), MySQL/PostgreSQL compatible
- **Testing**: Pest 5.1
- **Code Quality**: Laravel Pint
- **Queue**: Database queue driver
- **Session**: Database session driver

## 📦 Installation

### Prerequisites
- PHP 8.3 or higher
- Composer
- Node.js & NPM
- SQLite (or MySQL/PostgreSQL)

### Quick Setup

```bash
# Clone the repository
git clone <repository-url>
cd gardecet

# Install dependencies and setup
composer setup

# Configure environment
cp .env.example .env
php artisan key:generate

# Configure FaucetPay API
# Edit .env and add:
# FAUCETPAY_API_KEY=your_api_key_here

# Run migrations
php artisan migrate

# Build frontend assets
npm run build

# Start development server
composer run dev
```

### Manual Setup

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate --seed

# Build assets
npm run build

# Start the application
php artisan serve
```

## 🚀 Development

### Run Development Server

```bash
# Run Laravel server, queue worker, and Vite dev server concurrently
composer run dev
```

This command will start:
- Laravel development server on `http://localhost:8000`
- Queue worker for background jobs
- Vite dev server for hot module replacement

### Individual Commands

```bash
# Start Laravel server only
php artisan serve

# Start queue worker
php artisan queue:listen

# Start Vite dev server
npm run dev

# Build production assets
npm run build
```

## 🧪 Testing

```bash
# Run all tests
composer test

# Or use Pest directly
vendor/bin/pest

# Run specific test
vendor/bin/pest tests/Feature/FaucetTest.php
```

## 🎨 Code Style

```bash
# Format code with Laravel Pint
vendor/bin/pint

# Check formatting without fixing
vendor/bin/pint --test
```

## 📁 Project Structure

```
gardecet/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   ├── FaucetController.php
│   │   ├── SurfAdController.php
│   │   ├── MiningController.php
│   │   └── ...
│   ├── Models/
│   │   ├── User.php
│   │   ├── Currency.php
│   │   ├── FaucetClaim.php
│   │   ├── PtcAd.php
│   │   └── ...
│   └── Services/
│       ├── FaucetPayService.php
│       ├── HCaptchaService.php
│       └── CoinMarketCapService.php
├── resources/
│   └── views/
│       ├── admin/          # Admin panel views
│       ├── dashboard.blade.php
│       ├── faucet.blade.php
│       └── ...
├── routes/
│   ├── web.php            # User routes
│   └── admin.php          # Admin routes
└── database/
    └── migrations/
```

## 🔑 Configuration

### Required Environment Variables

```env
# Application
APP_NAME=Gardecet
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=sqlite

# FaucetPay Integration
FAUCETPAY_API_KEY=your_api_key

# hCaptcha (Optional)
HCAPTCHA_SECRET=your_secret
HCAPTCHA_SITEKEY=your_sitekey

# CoinMarketCap (Optional)
COINMARKETCAP_API_KEY=your_api_key
```

### FaucetPay Setup

1. Register at [FaucetPay.io](https://faucetpay.io/)
2. Generate API key from your dashboard
3. Add API key to `.env` file
4. Configure supported currencies in admin panel

### Admin Access

Create admin account via tinker:

```bash
php artisan tinker
```

```php
App\Models\Admin::create([
    'username' => 'admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('your-secure-password')
]);
```

Access admin panel at: `http://localhost:8000/admin`

## 🎮 Usage

### For Users

1. Visit homepage and login with FaucetPay email
2. Complete hCaptcha verification
3. Start earning through:
   - **Faucet**: Claim rewards every cooldown period
   - **PTC Ads**: View advertisements for rewards
   - **Mining**: Purchase mining plans for passive income
   - **Referrals**: Invite friends using your referral link

### For Administrators

1. Login to admin panel at `/admin`
2. Configure platform settings
3. Manage users, ads, and mining plans
4. Monitor platform statistics
5. Generate promotional coupons

## 🔧 API Integrations

### FaucetPay API
- User email verification
- Automatic cryptocurrency payouts
- Balance synchronization

### hCaptcha
- Bot protection on claims
- Abuse prevention
- Rate limiting

### CoinMarketCap (Optional)
- Real-time cryptocurrency prices
- Currency conversion rates
- Market data

## 📊 Database Schema

Key tables:
- `users` - User accounts with energy and referral tracking
- `currencies` - Supported cryptocurrencies
- `currency_users` - User balance per currency (pivot table)
- `faucet_claims` - Faucet claim history
- `ptc_ads` - Advertisement campaigns
- `ptc_ad_clicks` - Ad view tracking
- `mining_plans` - Mining plan templates
- `user_minings` - Active user mining contracts
- `coupons` - Promotional coupons
- `payments` - Transaction history
- `settings` - Platform configuration

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please ensure:
- Code follows Laravel conventions
- All tests pass (`composer test`)
- Code is formatted with Pint (`vendor/bin/pint`)

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP framework
- [FaucetPay](https://faucetpay.io/) - Cryptocurrency micropayment platform
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [hCaptcha](https://www.hcaptcha.com/) - Anti-bot protection

## 📧 Support

For support and questions:
- Open an issue on GitHub
- Contact via email
- Join our community channels

## 🚦 Status

- ✅ Core features complete
- ✅ Admin panel functional
- ✅ FaucetPay integration active
- ⏳ Additional features in development

---

**Made with ❤️ using Laravel**
