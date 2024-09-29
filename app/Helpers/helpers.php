<?php

if (! function_exists('logException')) {
    function logException($e): void
    {
        $logFilePath = storage_path('logs/exceptions_log.json');

        $logData = [
            'error_message' => $e->getMessage(),
            'method' => request()->method(),
            'url' => request()->url(),
            'time' => now()->toDateTimeString(),
        ];

        $existingLogs = file_exists($logFilePath)
            ? json_decode(file_get_contents($logFilePath), true)
            : [];

        $existingLogs[] = $logData;

        file_put_contents($logFilePath, json_encode($existingLogs, JSON_PRETTY_PRINT));
    }
}
