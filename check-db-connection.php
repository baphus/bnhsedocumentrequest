<?php

/**
 * Database Connection Checker for Laravel
 * This script checks the database connection without loading the entire Laravel app
 */

echo "=== Database Connection Checker ===\n\n";

if (!file_exists('.env')) {
    echo "❌ .env file not found!\n";
    exit(1);
}

echo "📄 Checking .env file...\n";
$envContent = file_get_contents('.env');
$envLines = explode("\n", $envContent);

$dbConfig = [
    'DB_CONNECTION' => null,
    'DB_HOST' => null,
    'DB_PORT' => null,
    'DB_DATABASE' => null,
    'DB_USERNAME' => null,
    'DB_PASSWORD' => null, // Added to config array
];

foreach ($envLines as $lineNum => $line) {
    $line = trim($line);
    if (empty($line) || strpos($line, '#') === 0) continue;

    foreach (array_keys($dbConfig) as $key) {
        if (strpos($line, $key . '=') === 0) {
            $value = substr($line, strlen($key) + 1);
            $value = trim($value, '"\'');
            $dbConfig[$key] = $value;

            // Mask password in the console output for security
            $displayValue = ($key === 'DB_PASSWORD' && !empty($value)) ? '********' : ($value ?: '(empty)');
            echo "  ✓ Found $key: $displayValue\n";
        }
    }
}

echo "\n📊 Current Database Configuration:\n";
echo "  Connection: " . ($dbConfig['DB_CONNECTION'] ?: 'sqlite') . "\n";
echo "  Database:   " . ($dbConfig['DB_DATABASE'] ?: 'not set') . "\n";
echo "  Username:   " . ($dbConfig['DB_USERNAME'] ?: 'not set') . "\n";
echo "  Password:   " . (!empty($dbConfig['DB_PASSWORD']) ? "Set (Length: " . strlen($dbConfig['DB_PASSWORD']) . ")" : "Empty/Not Set") . "\n\n";

$connection = $dbConfig['DB_CONNECTION'] ?: 'sqlite';
$password = $dbConfig['DB_PASSWORD'] ?: ''; // Use the parsed password

try {
    echo "🔌 Testing database connection...\n\n";

    if ($connection === 'sqlite') {
        $dbPath = $dbConfig['DB_DATABASE'] ?: 'database/database.sqlite';
        if (!file_exists($dbPath)) {
            echo "⚠️  SQLite file not found. Creating at: $dbPath\n";
            @touch($dbPath);
        }
        $pdo = new PDO("sqlite:$dbPath");
        echo "✅ Successfully connected to SQLite!\n";

    } elseif ($connection === 'mysql' || $connection === 'mariadb' || $connection === 'pgsql') {
        $host = $dbConfig['DB_HOST'] ?: '127.0.0.1';
        $port = $dbConfig['DB_PORT'] ?: ($connection === 'pgsql' ? '5432' : '3306');
        $database = $dbConfig['DB_DATABASE'] ?: 'laravel';
        $username = $dbConfig['DB_USERNAME'] ?: 'root';

        if ($connection === 'pgsql') {
            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
        } else {
            $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
        }

        // The actual connection test using the parsed credentials
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $pdo->query($connection === 'pgsql' ? "SELECT version()" : "SELECT VERSION() as version");
        $version = $result->fetch(PDO::FETCH_ASSOC);

        echo "✅ Successfully connected to " . ucfirst($connection) . "!\n";
        echo "  Version: " . (isset($version['version']) ? $version['version'] : current($version)) . "\n";
    }

} catch (PDOException $e) {
    echo "❌ Database connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n\n";

    if (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "💡 Troubleshooting: Your DB_USERNAME or DB_PASSWORD appears to be incorrect.\n";
    }
    exit(1);
}

echo "\n🚀 Everything looks good! You can now run: php artisan migrate --seed\n";
