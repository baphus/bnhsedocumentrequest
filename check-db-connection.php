<?php

/**
 * Database Connection Checker for Laravel
 * This script checks the database connection without loading the entire Laravel app
 */

echo "=== Database Connection Checker ===\n\n";

// Check if .env file exists
if (!file_exists('.env')) {
    echo "❌ .env file not found!\n";
    echo "Please copy .env.example to .env and configure your database settings.\n";
    exit(1);
}

// Try to parse .env file manually
echo "📄 Checking .env file...\n";
$envContent = file_get_contents('.env');
$envLines = explode("\n", $envContent);

$dbConfig = [
    'DB_CONNECTION' => null,
    'DB_HOST' => null,
    'DB_PORT' => null,
    'DB_DATABASE' => null,
    'DB_USERNAME' => null,
];

foreach ($envLines as $lineNum => $line) {
    $line = trim($line);

    // Skip comments and empty lines
    if (empty($line) || strpos($line, '#') === 0) {
        continue;
    }

    // Check for database-related settings
    foreach (array_keys($dbConfig) as $key) {
        if (strpos($line, $key . '=') === 0) {
            $value = substr($line, strlen($key) + 1);
            $value = trim($value, '"\'');
            $dbConfig[$key] = $value;
            echo "  ✓ Found $key: " . ($key === 'DB_PASSWORD' ? '***' : $value) . "\n";
        }
    }
}

echo "\n";

// Display current configuration
echo "📊 Current Database Configuration:\n";
echo "  Connection Type: " . ($dbConfig['DB_CONNECTION'] ?: 'sqlite (default)') . "\n";
echo "  Host: " . ($dbConfig['DB_HOST'] ?: '127.0.0.1 (default)') . "\n";
echo "  Port: " . ($dbConfig['DB_PORT'] ?: 'default') . "\n";
echo "  Database: " . ($dbConfig['DB_DATABASE'] ?: 'database/database.sqlite (default)') . "\n";
echo "  Username: " . ($dbConfig['DB_USERNAME'] ?: 'default') . "\n";
echo "\n";

// Test the connection
$connection = $dbConfig['DB_CONNECTION'] ?: 'sqlite';

try {
    echo "🔌 Testing database connection...\n\n";

    if ($connection === 'sqlite') {
        $dbPath = $dbConfig['DB_DATABASE'] ?: 'database/database.sqlite';
        if (!file_exists($dbPath)) {
            echo "⚠️  SQLite database file not found at: $dbPath\n";
            echo "Creating database file...\n";
            @touch($dbPath);
        }

        $pdo = new PDO("sqlite:$dbPath");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Test query
        $result = $pdo->query("SELECT sqlite_version() as version");
        $version = $result->fetch(PDO::FETCH_ASSOC);

        echo "✅ Successfully connected to SQLite!\n";
        echo "  SQLite Version: " . $version['version'] . "\n";

    } elseif ($connection === 'mysql' || $connection === 'mariadb') {
        $host = $dbConfig['DB_HOST'] ?: '127.0.0.1';
        $port = $dbConfig['DB_PORT'] ?: '3306';
        $database = $dbConfig['DB_DATABASE'] ?: 'laravel';
        $username = $dbConfig['DB_USERNAME'] ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';

        $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if database exists
        $result = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'");
        if ($result->rowCount() === 0) {
            echo "⚠️  Database '$database' does not exist on MySQL server.\n";
            echo "You can create it with: CREATE DATABASE $database;\n";
        } else {
            // Try to connect to specific database
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4", $username, $password);
            $result = $pdo->query("SELECT VERSION() as version");
            $version = $result->fetch(PDO::FETCH_ASSOC);

            echo "✅ Successfully connected to MySQL!\n";
            echo "  MySQL Version: " . $version['version'] . "\n";
            echo "  Database: $database\n";
        }

    } elseif ($connection === 'pgsql') {
        $host = $dbConfig['DB_HOST'] ?: '127.0.0.1';
        $port = $dbConfig['DB_PORT'] ?: '5432';
        $database = $dbConfig['DB_DATABASE'] ?: 'laravel';
        $username = $dbConfig['DB_USERNAME'] ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';

        echo "  Attempting to connect to PostgreSQL at $host:$port...\n";

        $dsn = "pgsql:host=$host;port=$port;dbname=$database";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $pdo->query("SELECT version()");
        $version = $result->fetch(PDO::FETCH_ASSOC);

        echo "✅ Successfully connected to PostgreSQL!\n";
        echo "  PostgreSQL Version: " . $version['version'] . "\n";
        echo "  Database: $database\n";

    } else {
        echo "⚠️  Unknown connection type: $connection\n";
        exit(1);
    }

    echo "\n✅ Database connection is working!\n";

} catch (PDOException $e) {
    echo "❌ Database connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n\n";

    echo "💡 Troubleshooting tips:\n";

    if ($connection === 'pgsql') {
        echo "  • Make sure PostgreSQL is installed and running\n";
        echo "  • Check if the hostname is correct (use '127.0.0.1' or 'localhost' instead of 'postgres' for local setup)\n";
        echo "  • Verify the port (default is 5432)\n";
        echo "  • Ensure the database exists\n";
        echo "  • Check username and password\n";
        echo "  • If you're using Docker, make sure the container is running\n";
        echo "\n  Alternative: Switch to SQLite by setting DB_CONNECTION=sqlite in your .env file\n";
    } elseif ($connection === 'mysql') {
        echo "  • Make sure MySQL/MariaDB is installed and running\n";
        echo "  • Check if the hostname is correct (usually '127.0.0.1' or 'localhost')\n";
        echo "  • Verify the port (default is 3306)\n";
        echo "  • Ensure the database exists\n";
        echo "  • Check username and password\n";
        echo "\n  Alternative: Switch to SQLite by setting DB_CONNECTION=sqlite in your .env file\n";
    } elseif ($connection === 'sqlite') {
        echo "  • Make sure the database directory is writable\n";
        echo "  • Check if SQLite PDO extension is installed (php -m | grep pdo_sqlite)\n";
    }

    exit(1);
}

echo "\n🚀 You can now run: php artisan migrate --seed\n";
