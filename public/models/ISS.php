<?php
class ISS
{
    // Google Maps API key.
    private $apiKey;
    // Formatted latitude and longitude string.
    private $latLng;

    public function __construct($latitude, $longitude)
    {
        $this->latLng = $latitude . ',' . $longitude;
        /**
        * The Google Maps API key is being held in a config file that is not directly
        * accessible from the browse if the server is correctly set.
        */
        $this->apiKey = Config::getConfig(['API_KEYS', 'google_maps_api']);
    }

    public function getISSLocation()
    {
        /**
        * The access to Google Maps API is not completely free,
        * so we don't want our API key to be publicly displayed to everbody on the client side.
        * That's why we are querying the API on our server.
        */
        $json = json_decode(
            file_get_contents(
                'https://maps.googleapis.com/maps/api/geocode/json?language=pl&latlng=' . $this->latLng . '&key=' . $this->apiKey
            )
        );

        return $this->extractAddress($json);
    }

    private function extractAddress($json)
    {
        if (isset($json->results[0])) {
            return $json->results[0]->formatted_address;
        } else {
            // Sometimes there are problems with Google Maps API responding with no results even though the parameters are fine.
            return '*chwilowy brak danych*';
        }
    }
}
