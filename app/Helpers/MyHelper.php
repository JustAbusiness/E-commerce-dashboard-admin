<?php

// Load Class Service Interface

use Illuminate\Support\Carbon;

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


// Convert DateTime
if (!function_exists('convertDateFormat')) {
    function convertDateFormat($inputTime, $inputFormat = 'd-m-Y', $outputFormat = 'Y-m-d H:i:s') {
        $carbonDate = Carbon::createFromFormat($inputFormat, $inputTime);
        $newFormat = $carbonDate->format($outputFormat);
        return $newFormat;
    }
}

// Cast Field
if(!function_exists('castRequest'))
{
    function castRequest($payload, $key = []){
        foreach ($key as $k => $v) {
            $snakeKey = Illuminate\Support\Str::snake($v);
            $payload[$snakeKey] = $payload[$v];
            unset($payload[$v]);
        }
        return $payload;
    }
}
