<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Toon een lijst van producten",
     *     tags={"Products"},
     *     @OA\Response(
     *         response=200,
     *         description="Lijst van producten met paginering",
     *     ),
     *     @OA\Response(response=500, description="Serverfout")
     * )
     */
    public function index(Request $request)
    {
        try {
            $data = Products::paginate(10);

            // Voeg afbeeldingen toe aan elk product
            foreach ($data as $product) {
                $product->images = Images::where('products_id', $product->id)->pluck('url')->toArray();
            }

            $response = [
                'total_pages' => $data->lastPage(),
                'count' => $data->total(),
                'next' => $data->nextPageUrl(),
                'previous' => $data->previousPageUrl(),
                'results' => $data->items()
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Er is iets misgegaan", "details" => $e->getMessage()], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
 /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Toon een specifiek product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID van het product",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Product gevonden"),
     *     @OA\Response(response=404, description="Product niet gevonden"),
     *     @OA\Response(response=500, description="Serverfout")
     * )
     */
    public function show(int $id)
    {
        try {
            $product = Products::find($id);

            if (!$product) {
                return response()->json(["error" => "Product niet gevonden"], 404);
            }

            // Voeg afbeeldingen toe
            $product->images = Images::where('products_id', $id)->pluck('url')->toArray();

            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Er is iets misgegaan", "details" => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}