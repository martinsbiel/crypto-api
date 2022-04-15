<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# About
API created to consult cryptocurrencies prices over time. It uses Laravel 9 and a [API client](https://github.com/codenix-sv/coingecko-api) recommended by [CoinGecko](https://www.coingecko.com/en/api/documentation). The API has two main endpoints: one to check the current price of a cryptocurrency and other to check the price on a specific date. It also stores the price and date from five different coins. I also implemented Repository Design Pattern wich creates one new level of abstraction between the model and controller layers.

### Available coins to search:
- btc
- dacxi
- eth
- atom
- luna

### Available endpoints:

`/api/coin/{name}`

`/api/coin-history/{name}/{date}`

The date should follow the format: dd-mm-yyyy

All prices are in USD.

# How to run the application
This application uses Laravel 9, make sure to follow the [requirements](https://laravel.com/docs/9.x/deployment#server-requirements) to run it.

- Clone the repository with `git clone`
- Open the `.env.example` file and rename it to `.env` then edit the database credentials
- Run `composer install` to install PHP dependencies
- Run `php artisan key:generate` to generate the application key
- Run `php artisan migrate` to execute the database migrations
- Run `php artisan serve` to serve the application
- Done!
