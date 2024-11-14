<?php
namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;


class TestimonialController extends Controller
{
    public function index()
    {

        return view('shop.testimonial');
    }
}
