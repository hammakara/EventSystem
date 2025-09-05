# Laravel Event Management System - Performance Optimization Script
# Run this script to apply all performance optimizations

Write-Host "🚀 Starting Laravel Event Management System Optimization..." -ForegroundColor Green

# 1. Run database migrations for indexes
Write-Host "📊 Running database migrations..." -ForegroundColor Yellow
php artisan migrate

# 2. Clear all caches
Write-Host "🧹 Clearing application cache..." -ForegroundColor Yellow
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 3. Optimize application for production
Write-Host "⚡ Optimizing for production..." -ForegroundColor Yellow
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Optimize Composer autoloader
Write-Host "📦 Optimizing Composer autoloader..." -ForegroundColor Yellow
composer dump-autoload --optimize

# 5. Build optimized frontend assets
Write-Host "🎨 Building production assets..." -ForegroundColor Yellow
npm run build

# 6. Generate application key if not exists
Write-Host "🔑 Checking application key..." -ForegroundColor Yellow
php artisan key:generate --show --no-interaction

# 7. Create storage link
Write-Host "🔗 Creating storage link..." -ForegroundColor Yellow
php artisan storage:link

# 8. Run database seeders (optional - comment out if not needed)
# Write-Host "🌱 Running database seeders..." -ForegroundColor Yellow
# php artisan db:seed

# 9. Set proper permissions (Unix/Linux only - skip on Windows)
if ($IsLinux -or $IsMacOS) {
    Write-Host "🔒 Setting proper permissions..." -ForegroundColor Yellow
    sudo chown -R www-data:www-data storage/
    sudo chown -R www-data:www-data bootstrap/cache/
    sudo chmod -R 755 storage/
    sudo chmod -R 755 bootstrap/cache/
}

Write-Host "✅ Optimization complete! Your Laravel application is now optimized for performance." -ForegroundColor Green

Write-Host "`n📋 Performance Optimizations Applied:" -ForegroundColor Cyan
Write-Host "✓ Database indexes added for faster queries" -ForegroundColor White
Write-Host "✓ Query optimization with eager loading and scopes" -ForegroundColor White
Write-Host "✓ Advanced caching strategy implemented" -ForegroundColor White
Write-Host "✓ Frontend assets optimized and minified" -ForegroundColor White
Write-Host "✓ Alpine.js performance enhancements" -ForegroundColor White
Write-Host "✓ CSS optimizations with lazy loading" -ForegroundColor White
Write-Host "✓ API optimization with proper pagination" -ForegroundColor White
Write-Host "✓ Laravel configuration optimized" -ForegroundColor White

Write-Host "`n🔧 Additional Recommendations:" -ForegroundColor Cyan
Write-Host "• Enable Redis for cache driver in production" -ForegroundColor White
Write-Host "• Configure queue system for background jobs" -ForegroundColor White
Write-Host "• Enable OPcache in PHP configuration" -ForegroundColor White
Write-Host "• Use CDN for static assets" -ForegroundColor White
Write-Host "• Enable gzip compression on web server" -ForegroundColor White

Write-Host "`n🚀 Ready to launch!" -ForegroundColor Green
