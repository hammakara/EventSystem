# 🚀 Laravel Event Management System - Deployment Guide

## Hosting on event-b17.wuaze.com

This guide will help you deploy your Laravel Event Management System to your hosting server.

---

## 📋 Pre-Requirements

### Server Requirements
- **PHP**: 8.1 or higher
- **MySQL**: 5.7 or higher / MariaDB 10.3 or higher
- **Web Server**: Apache with mod_rewrite enabled
- **Composer**: Latest version
- **Node.js**: 16.x or higher (for asset compilation)

### Required PHP Extensions
- bcmath
- ctype
- fileinfo
- json
- mbstring
- openssl
- pdo
- pdo_mysql
- tokenizer
- xml

---

## 🛠️ Deployment Steps

### Step 1: Upload Files
1. Upload all project files to your hosting account
2. Extract files to your domain directory (e.g., `public_html/event-b17.wuaze.com/`)

### Step 2: Configure Web Server
1. Point your domain's document root to the `public` folder
2. Ensure `.htaccess` files are enabled and working
3. The main application should be accessible at: `https://event-b17.wuaze.com`

### Step 3: Environment Configuration
1. Copy `.env.production` to `.env`:
   ```bash
   cp .env.production .env
   ```

2. Edit `.env` file with your hosting details:
   ```bash
   # Update these values with your hosting provider's details
   APP_NAME="Event Management System"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://event-b17.wuaze.com

   # Database Configuration
   DB_CONNECTION=mysql
   DB_HOST=localhost  # or your database host
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password

   # Mail Configuration (update with your hosting provider's settings)
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.wuaze.com
   MAIL_PORT=587
   MAIL_USERNAME=your_email
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="noreply@event-b17.wuaze.com"
   ```

### Step 4: Install Dependencies
```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install and build assets (if Node.js is available)
npm install
npm run build
```

### Step 5: Generate Application Key
```bash
php artisan key:generate
```

### Step 6: Set Up Database
```bash
# Run database migrations
php artisan migrate --force

# Seed sample data (optional)
php artisan db:seed --force
```

### Step 7: Configure Storage
```bash
# Create symbolic link for file storage
php artisan storage:link
```

### Step 8: Optimize for Production
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

### Step 9: Set Permissions
Set the correct permissions for storage and cache directories:
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

---

## 🔒 Security Configuration

### 1. Environment Security
- Ensure `.env` file is not publicly accessible
- Set `APP_DEBUG=false` in production
- Use strong, unique `APP_KEY`

### 2. HTTPS Configuration
- Enable HTTPS for your domain
- Uncomment HTTPS redirect in `public/.htaccess`:
  ```apache
  # Force HTTPS
  RewriteCond %{HTTPS} off
  RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
  ```

### 3. File Security
- Ensure sensitive files are protected by `.htaccess`
- Restrict access to `.env`, `composer.json`, etc.

---

## 🗄️ Database Setup

### Option 1: Create Database via cPanel/phpMyAdmin
1. Log into your hosting control panel
2. Create a new MySQL database
3. Create a database user with full privileges
4. Update `.env` with database credentials

### Option 2: Import Sample Data
If you want to start with sample data:
```bash
# After running migrations, seed the database
php artisan db:seed --force
```

This will create:
- 1 Admin user (admin@example.com)
- 5 Sample organizers
- 10 Sample venues
- 20 Sample events
- 100 Sample attendees
- 8 Sample vendors
- Role & permission system

---

## 🎛️ Admin Access

### Default Admin Credentials
- **Email**: `admin@example.com`
- **Password**: Check `database/seeders/RolesAndAdminSeeder.php` for the default password

### Create New Admin User
```bash
php artisan tinker
# Then run:
$user = User::create([
    'name' => 'Your Name',
    'email' => 'your@email.com',
    'password' => Hash::make('your-secure-password')
]);
$user->assignRole('admin');
```

---

## 🔧 Troubleshooting

### Common Issues

#### 1. 500 Internal Server Error
- Check `.env` file exists and is properly configured
- Ensure storage directories are writable (755 permissions)
- Check error logs in your hosting control panel

#### 2. Database Connection Error
- Verify database credentials in `.env`
- Ensure database exists and user has proper privileges
- Check if your hosting requires a specific database host

#### 3. CSS/JS Not Loading
- Run `npm run build` to compile assets
- Check if `public/build` directory exists with compiled files
- Verify web server can serve static files

#### 4. File Upload Issues
- Ensure `storage/app/public` directory exists
- Run `php artisan storage:link`
- Check file permissions on storage directories

### Performance Optimization
```bash
# Cache everything for better performance
php artisan optimize

# Or run individual cache commands:
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📊 Application Features

Your deployed Event Management System includes:

### ✨ Core Features
- **Event Management**: Create, edit, and manage events
- **Venue Management**: Add and manage event venues
- **Organizer Management**: Handle event organizers
- **Attendee Management**: Track event attendees
- **Vendor Management**: Manage event vendors and services
- **User Authentication**: Secure login system
- **Role-Based Access**: Admin, Organizer, and Attendee roles
- **Dashboard**: Comprehensive management interface

### 🎨 UI Features
- **Responsive Design**: Mobile-friendly interface
- **Dark Mode**: Toggle between light and dark themes
- **Modern Design**: Clean, professional appearance
- **Interactive Components**: Dynamic forms and modals

### 🔧 Technical Features
- **Laravel Framework**: Latest stable version
- **Tailwind CSS**: Modern styling framework
- **Alpine.js**: Lightweight JavaScript framework
- **Database Relationships**: Properly structured data
- **Performance Optimized**: Cached configurations and routes

---

## 📞 Support

If you encounter any issues during deployment:

1. Check the error logs in your hosting control panel
2. Verify all requirements are met
3. Ensure file permissions are correctly set
4. Review the `.env` configuration

---

## 🎉 Congratulations!

Your Laravel Event Management System is now live at:
**https://event-b17.wuaze.com**

You can now:
- 👤 **Login** as admin and manage the system
- 🎉 **Create Events** and manage attendees
- 📊 **View Dashboard** with comprehensive statistics
- 🎨 **Customize** the application as needed

---

*Last updated: $(date)*
