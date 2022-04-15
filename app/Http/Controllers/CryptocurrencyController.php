<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CryptocurrencyRepositoryInterface;

class CryptocurrencyController extends Controller
{
    private CryptocurrencyRepositoryInterface $cryptocurrencyRepository;

    public function __construct(CryptocurrencyRepositoryInterface $cryptocurrencyRepository) 
    {
        $this->cryptocurrencyRepository = $cryptocurrencyRepository;
    }

    public function getCoinPrice($name){
        try {
            return response()->json($this->cryptocurrencyRepository->getCoinPrice($name), 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function getCoinPriceByDate($name, $date){
        try {
            return response()->json($this->cryptocurrencyRepository->getCoinPriceByDate($name, $date), 200);
        }catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
