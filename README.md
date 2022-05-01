
# Omure Weather Forcast

The Omure weather forcast service is a Laravel application develop around the Open Weather Forcast API service. The service fetches weather forcast data for New York, London, Paris, Tokyo and Berlin. The data is saved in a database for later retrieval. 

## Project Requirement
- Run Laravel 8, PHP 8.1+
- MySQL or Postgres database
- **[Create Open Weather API Account](https://openweathermap.org/)**

## Installation & Setup
- Clone the repository 
- Create a copy of .env.example as .env in the root directory
- Update the .env with your ``DATABASE DETAILS``
- Update the .env by setting `QUEUE_CONNECTION` to `databaase`. We are using database for our queued jobs
- Update the .env by setting `OPEN_WEATHER_API_URL` to **[OPEN_WEATHER_API_URL](https://api.openweathermap.org/data/2.5/group)**
- Update the .env by setting `OPEN_WEATHER_API_KEY` to your Open Weather Account's API Key
- Run `composer install` to install the dependencies
- Run `php artisan key:generate` to generate the Laravel App Key
- Run `php artisan migreate` to create the database tables
- Run `php artisan db:seed` to populate the locations table with the default cities.
- Run `./vendor/bin/phpunit` to test the application, ensure all tests pass successfully.
- Run `php artisan serve` to start the application : `Starting Laravel development server: http://127.0.0.1:8000`

## Usage
Using PostMan or any other API testing tool, make a call to the `base_url/api/weatherforcasts`, where `base_url` is your server ip eg. `http://127.0.0.1:8000`
Sample Response:
```
    "code": "200",
    "message": "Weather forcast retrieved successfully",
    "data": [
        {
            "city_id": 5128581,
            "city_name": "New York",
            "weather": [
                {
                    "id": 800,
                    "main": "Clear",
                    "description": "clear sky",
                    "icon": "01d"
                }
            ],
            "temp": 292.49,
            "feels_like": 291.26,
            "temp_min": 288.7,
            "temp_max": 296.4,
            "pressure": 1019,
            "humidity": 30,
            "created_at": "2022-04-01"
        },
```

A documentation can be found here.