<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\City;
use Inertia\Response;
use App\Models\Country;
use App\Http\Requests\MultiStepFormRequest;

class MultiStepController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'countries' => Country::all()->toArray(),
            'cities'    => City::all()->groupBy('country_id')->toArray(),
        ]);
    }

    public function store(MultiStepFormRequest $request)
    {
        // save data in the DB
    }
}
