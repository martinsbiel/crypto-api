<?php

namespace App\Repositories;

use App\Interfaces\CryptocurrencyRepositoryInterface;
use App\Models\Cryptocurrency;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CryptocurrencyRepository implements CryptocurrencyRepositoryInterface 
{
    /**
     * BTC -> bitcoin
     * ETH -> ethereum
     * DACXI -> dacxi
     * ATOM -> cosmos
     * LUNA -> terra-luna
     */

    public function getCoinPrice(string $name)
    {
        $client = new CoinGeckoClient();

        switch($name){
            case 'btc':
                $data = $client->simple()->getPrice('bitcoin', 'usd');
                break;
            case 'eth':
                $data = $client->simple()->getPrice('ethereum', 'usd');
                break;
            case 'dacxi':
                $data = $client->simple()->getPrice('dacxi', 'usd');
                break;
            case 'atom':
                $data = $client->simple()->getPrice('cosmos', 'usd');
                break;
            case 'luna':
                $data = $client->simple()->getPrice('terra-luna', 'usd');
                break;
            default:
                throw new \Exception('Coin not found');
                break;
        }

        // retrieve the crypto id from array
        $arrayKey = array_key_first($data);

        Cryptocurrency::create([
            'name' => $arrayKey,
            'price' => $data[$arrayKey]['usd']
        ]);

        return $data;
    }

    public function getCoinPriceByDate(string $name, string $date)
    {
        $client = new CoinGeckoClient();

        switch($name){
            case 'btc':
                $data = $client->coins()->getHistory('bitcoin', $date);
                break;
            case 'eth':
                $data = $client->coins()->getHistory('ethereum', $date);
                break;
            case 'dacxi':
                $data = $client->coins()->getHistory('dacxi', $date);
                break;
            case 'atom':
                $data = $client->coins()->getHistory('cosmos', $date);
                break;
            case 'luna':
                $data = $client->coins()->getHistory('terra-luna', $date);
                break;
            default:
                throw new \Exception('Coin not found');
                break;
        }

        // check if the coin actually exists on that date
        if(!isset($data['market_data'])){
            throw new \Exception('Coin not found on this date');
        }

        // format the date to store in database
        $newDate = new \DateTime($date);
        $dateFormated = $newDate->format('Y-m-d');

        Cryptocurrency::create([
            'name' => $data['id'],
            'price' => $data['market_data']['current_price']['usd'],
            'price_date' => $dateFormated
        ]);

        // format the response making it pretty
        $result = [
            $data['id'] => [
                'date' => $date,
                'usd' => $data['market_data']['current_price']['usd']
            ]
        ];

        return $result;
    }
}