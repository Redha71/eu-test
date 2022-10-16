<?php

namespace App\Http\Controllers;

use App\Models\userCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class weatherController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $city = userCity::where('user_id', $userId)->first();
            if (!empty($city)) {
                $apiWeather = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $city->city . "&APPID=871902d92e2299033879e5f4428ff1a3");
        //decodethe result
        $weatherA = json_decode($apiWeather, true);
        if ($weatherA['cod'] == 200) {
            //C= K- 273.15
            $temCelsius = $weatherA['main']['temp'] - 273;
            $weather = "<b>" . $weatherA['name'] . ", " . $weatherA['sys']['country'] . " : " . intval($temCelsius) . " &deg;C</b></br>";
            $weather .= "<b>Weather Condition : </b>" . $weatherA['weather'][0]['description'] . "</br>";
            $weather .= "<b> Atmosperic Pressure : </b>" . $weatherA['main']['pressure'] . "hPa</br>";
            $weather .= "<b>Wind Speed : </b>" . $weatherA['wind']['speed'] . "meter/sec</br>";
            $weather .= "<b>Clouds : </b>" . $weatherA['clouds']['all'] . "%</br>";

            return view('weather', compact('weather'));
        } else {
            $errorCity = "No City With this Name";
            return view('weather', compact('errorCity'));
        }
            } else {
                return view('weather');
            }
        } else {
            return view('weather');
        }
    }
    public function weatherCall(Request $request)
    {

        $city = $request->city;
        //Send Api openweater api
        $apiWeather = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&APPID=871902d92e2299033879e5f4428ff1a3");
        //decodethe result
        $weatherA = json_decode($apiWeather, true);
        if ($weatherA['cod'] == 200) {
            //C= K- 273.15
            $temCelsius = $weatherA['main']['temp'] - 273;
            $weather = "<b>" . $weatherA['name'] . ", " . $weatherA['sys']['country'] . " : " . intval($temCelsius) . " &deg;C</b></br>";
            $weather .= "<b>Weather Condition : </b>" . $weatherA['weather'][0]['description'] . "</br>";
            $weather .= "<b> Atmosperic Pressure : </b>" . $weatherA['main']['pressure'] . "hPa</br>";
            $weather .= "<b>Wind Speed : </b>" . $weatherA['wind']['speed'] . "meter/sec</br>";
            $weather .= "<b>Clouds : </b>" . $weatherA['clouds']['all'] . "%</br>";

            return view('weather', compact('weather'));
        } else {
            $errorCity = "No City With this Name";
            return view('weather', compact('errorCity'));
        }
    }
    public function storeCity(Request $request)
    {
        // The user is logged in...
        if (Auth::check()) {

            $city = $request->city;
            $userId = Auth::id();
            $checkUId = userCity::where('user_id', $userId)->first();
            if ($checkUId) {
                userCity::where('user_id', $userId)->update([
                    'user_id' => $userId,
                    'city' => $city
                ]);
            } else {
                userCity::insert([
                    'user_id' => $userId,
                    'city' => $city
                ]);
            }

            return redirect()->route('weather');
        }
    }
}
