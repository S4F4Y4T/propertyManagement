<?php

namespace App\Http\Controllers\Api;

use App\Filters\FlatFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Flat\CreateFlatRequest;
use App\Http\Requests\Flat\UpdateFlatRequest;
use App\Http\Resources\FlatResource;
use App\Models\Flat;

class FlatController extends Controller
{
    public function index(FlatFilter $flatFilter)
    {
        return FlatResource::collection(
            Flat::filter($flatFilter)->paginate()
        );
    }

    public function store(CreateFlatRequest $request)
    {
        $flat = Flat::create($request->validatedData());
        return self::success(message: "Flat added successfully", data: FlatResource::make($flat));
    }

    public function show(Flat $flat)
    {
        return FlatResource::make($flat);
    }

    public function update(UpdateFlatRequest $request, Flat $flat)
    {
        $flat->update($request->validated());
        return self::success(message: "Flat updated successfully", data: FlatResource::make($flat));
    }

    public function destroy(Flat $flat)
    {
        $flat->delete();
        return self::success(message: "Flat deleted successfully");
    }
}