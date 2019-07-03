<?php

/**
 * @param string $key
 * @param mixed $default
 * @param bool $isArray
 * @return mixed
 */
function env($key, $default = null, $isArray = false)
{

    $value = getenv($key) ?? $_ENV[$key] ?? $_SERVER[$key];

    if ($value === false) {
        return $default;
    }
    if ($isArray) {
        $arrayValue = array_map('trim', explode(',', $value));
        if (empty($arrayValue)) {
            return $default;
        }
        return $arrayValue;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
        case 'TRUE':
            return true;

        case 'false':
        case '(false)':
        case 'FALSE':
            return false;
    }


    return $value;
}