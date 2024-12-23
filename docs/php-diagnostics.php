<?php

function runDiagnostics() {
    $diagnostics = [];
    
    // Basic PHP Info
    $diagnostics['php_version'] = phpversion();
    $diagnostics['php_sapi'] = php_sapi_name();
    $diagnostics['memory_limit'] = ini_get('memory_limit');
    $diagnostics['max_execution_time'] = ini_get('max_execution_time');
    
    // Critical Extensions
    $required_extensions = [
        'json',      // For API handling
        'curl',      // For GitHub API calls
        'pdo',       // Database
        'openssl',   // For secure connections
        'mbstring'   // String handling
    ];
    
    $diagnostics['extensions'] = [];
    foreach ($required_extensions as $ext) {
        $diagnostics['extensions'][$ext] = extension_loaded($ext);
    }
    
    // File System Access
    $temp_dir = sys_get_temp_dir();
    $diagnostics['filesystem'] = [
        'temp_dir' => $temp_dir,
        'temp_writable' => is_writable($temp_dir),
        'current_dir' => getcwd(),
        'current_writable' => is_writable(getcwd())
    ];
    
    // Database Connectivity (check what's available)
    $db_extensions = [
        'mysql' => extension_loaded('pdo_mysql'),
        'pgsql' => extension_loaded('pdo_pgsql'),
        'sqlite' => extension_loaded('pdo_sqlite')
    ];
    $diagnostics['database_support'] = $db_extensions;
    
    // HTTP Client Capabilities
    $diagnostics['http_client'] = [
        'curl' => function_exists('curl_version') ? curl_version() : false,
        'fopen_allowed' => ini_get('allow_url_fopen')
    ];
    
    // Important INI Settings
    $diagnostics['ini_settings'] = [
        'post_max_size' => ini_get('post_max_size'),
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'display_errors' => ini_get('display_errors'),
        'error_reporting' => ini_get('error_reporting')
    ];

    return outputDiagnostics($diagnostics);
}

function outputDiagnostics($data) {
    $output = [];
    
    // Format the output
    $output[] = "=== PHP Environment Diagnostics ===\n";
    
    $output[] = "PHP Version: " . $data['php_version'];
    $output[] = "SAPI: " . $data['php_sapi'];
    $output[] = "Memory Limit: " . $data['memory_limit'];
    $output[] = "Max Execution Time: " . $data['max_execution_time'] . "\n";
    
    $output[] = "Required Extensions:";
    foreach ($data['extensions'] as $ext => $loaded) {
        $output[] = sprintf("  %-20s [%s]", $ext, $loaded ? '✓' : '✗');
    }
    $output[] = "";
    
    $output[] = "Filesystem Access:";
    foreach ($data['filesystem'] as $key => $value) {
        $output[] = sprintf("  %-20s: %s", $key, is_bool($value) ? ($value ? '✓' : '✗') : $value);
    }
    $output[] = "";
    
    $output[] = "Database Support:";
    foreach ($data['database_support'] as $db => $available) {
        $output[] = sprintf("  %-20s [%s]", $db, $available ? '✓' : '✗');
    }
    $output[] = "";
    
    $output[] = "HTTP Client Capabilities:";
    $output[] = "  allow_url_fopen: " . ($data['http_client']['fopen_allowed'] ? '✓' : '✗');
    if ($data['http_client']['curl']) {
        $output[] = "  cURL version: " . $data['http_client']['curl']['version'];
        $output[] = "  SSL version: " . $data['http_client']['curl']['ssl_version'];
    } else {
        $output[] = "  cURL: Not available";
    }
    $output[] = "";
    
    $output[] = "Important INI Settings:";
    foreach ($data['ini_settings'] as $setting => $value) {
        $output[] = sprintf("  %-20s: %s", $setting, $value);
    }
    
    return implode("\n", $output);
}

// Only run if called directly
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    header('Content-Type: text/plain');
    echo runDiagnostics();
}
