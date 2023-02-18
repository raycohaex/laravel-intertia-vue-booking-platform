<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::with(['images' => function($query){
            $query->orderBy('order');
        }])->paginate(25);

        return Inertia::render('Accommodation/Index', [
            'accommodations' => $accommodations
        ]);
    }

    public function show()
    {
        $accommodations = Accommodation::paginate(10);

        return Inertia::render('Accommodation/Show', [
            'accommodations' => $accommodations
        ]);
    }
}
