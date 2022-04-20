<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Carbon\Carbon;

class NasaAPIService {

    protected $baseUrl;
    protected $apiKey;
    protected $http;

    public function __construct()
    {
        $this->baseUrl = config('services.nasa.base_url');
        $this->apiKey = config('services.nasa.key');

        $this->http = Http::baseUrl($this->baseUrl)->accept('application/json');
    }

    public function getImagePerDate($date)
    {
        $day = Carbon::parse($date)->format('d');
        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $url = "EPIC/api/natural/date/{$year}-{$month}-{$day}?api_key={$this->apiKey}";

        $response = json_decode($this->http->get($url));
        
        $imageFile = null;

        foreach($response as $resValue) {
            $imageName = $resValue->image;
            $imageFile = "https://api.nasa.gov/EPIC/archive/natural/{$year}/{$month}/{$day}/png/{$imageName}.png?api_key={$this->apiKey}";
        }

        return $imageFile;
    }
}
