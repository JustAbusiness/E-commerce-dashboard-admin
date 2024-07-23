<?php

// Load Class Service Interface
if (!function_exists('loadClass')) {
    function loadClass($model, $folder = 'Repositories', $interface = 'Repository') {
        $serviceInstance = null; // Khởi tạo biến $serviceInstance
        $serviceInterfaceNamespace  = '\App\\' . $folder . '\\' . ucfirst($model) . $interface;
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }

        return $serviceInstance;
    }
}
