<?php
class Config
{
    public static function getConfig(array $details = [])
    {
        // Using json_decode and json_encode converts multidimensional arrays into objects on all levels.
        $config = json_decode(json_encode(parse_ini_file(__ROOT__ . '/resources/config.ini', true)));

        foreach ($details as $detail) {
            $config = $config->{$detail};
        }

        return $config;
    }
}
