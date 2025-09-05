<?php
/**
 * ============================================================================
 * Laravel Event Management System - Deployment Script
 * ============================================================================
 * Run this script on your hosting server to set up the application
 * Usage: php deploy.php
 * ============================================================================
 */

echo "=============================================================================\n";
echo "Laravel Event Management System - Deployment Setup\n";
echo "=============================================================================\n";

// Check PHP version
echo "Checking PHP version...\n";
if (version_compare(PHP_VERSION, '8.1.0', '<')) {
    echo "ERROR: PHP 8.1 or higher is required. Current version: " . PHP_VERSION . "\n";
    exit(1);
}
echo "✓ PHP version: " . PHP_VERSION . " (OK)\n\n";

// Check required extensions
echo "Checking required PHP extensions...\n";
$requiredExtensions = [
    'bcmath', 'ctype', 'fileinfo', 'json', 'mbstring', 
    'openssl', 'pdo', 'pdo_mysql', 'tokenizer', 'xml'
];

$missingExtensions = [];
foreach ($requiredExtensions as $ext) {
    if (!extension_loaded($ext)) {
        $missingExtensions[] = $ext;
    } else {
        echo "✓ {$ext}\n";
    }
}

if (!empty($missingExtensions)) {
    echo "\nERROR: Missing required extensions:\n";
    foreach ($missingExtensions as $ext) {
        echo "✗ {$ext}\n";
    }
    echo "\nPlease install these extensions before continuing.\n";
    exit(1);
}

echo "\n=============================================================================\n";
echo "Setting up Laravel application...\n";
echo "=============================================================================\n";

// Set proper permissions
echo "Setting directory permissions...\n";
if (is_dir('storage')) {
    chmod('storage', 0755);
    echo "✓ Storage directory permissions set\n";
}
if (is_dir('bootstrap/cache')) {
    chmod('bootstrap/cache', 0755);
    echo "✓ Bootstrap cache directory permissions set\n";
}

// Check if .env exists
if (!file_exists('.env')) {
    echo "\nWARNING: .env file not found!\n";
    echo "Please copy .env.production to .env and update database credentials\n\n";
}

echo "\n=============================================================================\n";
echo "Next Steps:\n";
echo "=============================================================================\n";
echo "1. Copy .env.production to .env\n";
echo "2. Update database credentials in .env file\n";
echo "3. Run: php artisan migrate --force\n";
echo "4. Run: php artisan db:seed --force (optional, for sample data)\n";
echo "5. Run: php artisan storage:link\n";
echo "6. Set up your web server to point to the 'public' directory\n\n";

echo "Deployment preparation completed!\n";
echo "=============================================================================\n";
?>
