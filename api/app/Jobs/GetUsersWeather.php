<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\UsersWeather;


class GetUsersWeather implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $users;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //Doing some setup.
        //Getting all the users.
        $this->users=\App\Models\User::get();
        if(!$this->users->count()){
            return;
        }
        
        $this->handle();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->users as $key => $user) {
            $user_weather_data=$this->getUserWeather($user);
            if($user_weather_data){
                $this->saveUserWeather($user,$user_weather_data);
            }
        }
    }

    private function getUserWeather($user) //Sending a request for User`s weather data
    {   
       $api_key= env('WEATHERAPI_API_KEY');
       $response = Http::get('http://api.weatherapi.com/v1/current.json', 
            [
                'key' => $api_key,
                'q' => $user->latitude   . ',' . $user->longitude,
            ]
        );
        return ['status'=>$response->successful(),'response'=>$response->json()];
    }

    private function saveUserWeather($user,$user_weather_data) //Structuring and saving the data.
    {
            if (empty($user_weather_data) || empty($user)) {
                return;
            }
            if(!$user_weather_data['status']){
                $new_weather_data["user_id"]=$user['id'];
                $new_weather_data["status"]=false;
                $new_weather_data['updated_at']=date('Y-m-d H:i:s');
                $new_weather_data['error_code']=$user_weather_data['response']['error']['code'];
                $new_weather_data['error_message']=$user_weather_data['response']['error']['message'];
                $weather_data=UsersWeather::updateOrInsert(['user_id'=>$user['id']],$new_weather_data);
                
            }else{
                $new_weather_data["user_id"]=$user['id'];
            $new_weather_data["location_name"]=$user_weather_data['response']['location']['name'];
            $new_weather_data["location_country"]=$user_weather_data['response']['location']['country'];
            $new_weather_data["location_tz_id"]=$user_weather_data['response']['location']['tz_id'];
            $new_weather_data["temp_c"]=$user_weather_data['response']['current']['temp_c'];
            $new_weather_data["temp_f"]=$user_weather_data['response']['current']['temp_f'];
            $new_weather_data["is_day"]=$user_weather_data['response']['current']['is_day'];
            $new_weather_data["condition_text"]=$user_weather_data['response']['current']['condition']['text'];
            $new_weather_data["condition_icon"]=$user_weather_data['response']['current']['condition']['icon'];
            $new_weather_data["condition_code"]=$user_weather_data['response']['current']['condition']['code'];
            $new_weather_data["wind_mph"]=$user_weather_data['response']['current']['wind_mph'];
            $new_weather_data["wind_kph"]=$user_weather_data['response']['current']['wind_kph'];
            $new_weather_data["wind_degree"]=$user_weather_data['response']['current']['wind_degree'];
            $new_weather_data["wind_dir"]=$user_weather_data['response']['current']['wind_dir'];
            $new_weather_data["pressure_mb"]=$user_weather_data['response']['current']['pressure_mb'];
            $new_weather_data["pressure_in"]=$user_weather_data['response']['current']['pressure_in'];
            $new_weather_data["precip_mm"]=$user_weather_data['response']['current']['precip_mm'];
            $new_weather_data["precip_in"]=$user_weather_data['response']['current']['precip_in'];
            $new_weather_data["humidity"]=$user_weather_data['response']['current']['humidity'];
            $new_weather_data["cloud"]=$user_weather_data['response']['current']['cloud'];
            $new_weather_data["feelslike_c"]=$user_weather_data['response']['current']['feelslike_c'];
            $new_weather_data["feelslike_f"]=$user_weather_data['response']['current']['feelslike_f'];
            $new_weather_data["vis_km"]=$user_weather_data['response']['current']['vis_km'];
            $new_weather_data["vis_miles"]=$user_weather_data['response']['current']['vis_miles'];
            $new_weather_data["uv"]=$user_weather_data['response']['current']['uv'];
            $new_weather_data["gust_mph"]=$user_weather_data['response']['current']['gust_mph'];
            $new_weather_data["gust_kph"]=$user_weather_data['response']['current']['gust_kph'];
            $new_weather_data['updated_at']=date('Y-m-d H:i:s');
            $new_weather_data['status']=true;
            $weather_data=UsersWeather::updateOrInsert(['user_id'=>$user['id']],$new_weather_data);
             
            }
        }
}
