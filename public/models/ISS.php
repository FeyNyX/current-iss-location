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
        *
        * Additional thing that should be implemented here would be querying Google Maps API
        * only once per every 10 seconds and saving the results to our own database.
        * This would save us making independent (costly) queries for every user that visits our site.
        *
        * Step by step:
        * - user enters the site and we check if we have actual position in our database
        * - if not, we query the API and save fresh data to our database
        *
        * We could set cron instead, but that way we could make unneeded queries to the API,
        * even when there are no visitors on our site at all at given moment.
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
            return 'terenem niezamieszkanym.';
        }
    }
}
