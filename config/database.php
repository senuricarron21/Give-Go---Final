<?php
// GiveGo Global Configuration and Database Helper
// Sets up server-side environment states, session headers, and utility constants

// Automatically load all OOP Classes from classes/ directory
require_once __DIR__ . '/../classes/autoload.php';

// Initialize Session via AuthGuard OOP Class
AuthGuard::startSession();

// Define Environment Constants
define('APP_NAME', 'GiveGo');
define('APP_VERSION', '1.0.0');
define('DEFAULT_LATITUDE', 6.9271);  // Colombo base
define('DEFAULT_LONGITUDE', 79.8612);

// Timezone Setup
date_default_timezone_set('Asia/Colombo');

/**
 * Procedural bridge for backward compatibility.
 * Delegates authorization to AuthGuard OOP class.
 *
 * @param array $allowedRoles
 */
function restrictAccessTo($allowedRoles) {
    AuthGuard::restrictAccessTo($allowedRoles);
}
