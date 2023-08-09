<?php
use Spatie\Url\Url;

if (!function_exists('external_url')):
    function external_url($url): string {
        $external = Url::fromString($url);
        $scheme = $external->getScheme();

        return empty($scheme) 
            ? $external->withScheme("https")
            : (string) $external;
    }
endif;
