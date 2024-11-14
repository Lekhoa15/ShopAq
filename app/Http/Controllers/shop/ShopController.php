<?php
namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;


class ShopController extends Controller
{
    public function index()
    {

        return view('shop.shop');
    }
}
