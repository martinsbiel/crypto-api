<?php

namespace App\Interfaces;

interface CryptocurrencyRepositoryInterface 
{
    public function getCoinPrice(string $name);
    public function getCoinPriceByDate(string $name, string $date);
}