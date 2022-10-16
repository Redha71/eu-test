<?php

namespace App\Console\Commands;

use App\Mail\DailyWeatherMail;
use App\Models\User;
use App\Models\userCity;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyWeatherCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyweather:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usercity = userCity::find()->get();
        if (count($usercity)>0) {
            foreach ($usercity as $key => $item) {
                $userEmail=User::where('id', $item->user_id)->first();
                $email = $userEmail->email;
                $apiWeather = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" .$item->city . "&APPID=871902d92e2299033879e5f4428ff1a3");
                //decodethe result
                $weatherA = json_decode($apiWeather, true);
                    //C= K- 273.15
                    $temCelsius = $weatherA['main']['temp'] - 273;
                    $weather = "<b>" . $weatherA['name'] . ", " . $weatherA['sys']['country'] . " : " . intval($temCelsius) . " &deg;C</b></br>";
                    $weather .= "<b>Weather Condition : </b>" . $weatherA['weather'][0]['description'] . "</br>";
                    $weather .= "<b> Atmosperic Pressure : </b>" . $weatherA['main']['pressure'] . "hPa</br>";
                    $weather .= "<b>Wind Speed : </b>" . $weatherA['wind']['speed'] . "meter/sec</br>";
                    $weather .= "<b>Clouds : </b>" . $weatherA['clouds']['all'] . "%</br>";

                    Mail::to($email)->send(new DailyWeatherMail($weather));
                
            }
        }
    }
}
