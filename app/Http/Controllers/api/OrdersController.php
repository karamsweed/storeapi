<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\orderitam;
use App\Models\orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

  /**
 * @OA\Post(
 *     path="/api/orders",
 *     summary="Maak een nieuwe bestelling aan (vereist authenticatie)",
 *     security={{"bearerAuth":{}}},
 *     tags={"Orders"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={ "state", "address", "orders"},
 *             @OA\Property(property="state", type="string", example="pending"),
 *             @OA\Property(property="address", type="string", example="123 Main Street"),
 *             @OA\Property(property="orders", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="products_id", type="integer", example=2),
 *                     @OA\Property(property="quantity", type="integer", example=3),
 *                     @OA\Property(property="size", type="string", example="M")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(response=201, description="Bestelling aangemaakt"),
 *     @OA\Response(response=400, description="Ongeldige invoer"),
 *     @OA\Response(response=401, description="Niet geautoriseerd - Bearer Token vereist"),
 *      @OA\Header(
 *         header="Accept",
 *         description="Geef aan dat de API JSON verwacht",
 *         @OA\Schema(type="string", default="application/json")
 *     )
 * )
 */
    public function store(Request $request)
    {
        // Valideer inkomende data
        $validatedData = $request->validate([
            "state"    => "required|string",
            "address"  => "required|string",
            "orders"   => "required|array",
            "orders.*.products_id" => "required|integer",
            "orders.*.quantity" => "required|integer|min:1",
            "orders.*.size" => "required|string",
        ]);

        try {
            // Haal de ingelogde gebruiker op
            $user = auth()->user();

            // Maak de bestelling aan
            $order = Orders::create([
                "user_id" => $user->id,  // Gebruik ingelogde gebruiker
                "state"   => $validatedData["state"],
                "address" => $validatedData["address"],
            ]);

            // Bestelling items toevoegen
            foreach ($validatedData["orders"] as $orderItem) {
                orderitam::create([
                    "orders_id" => $order->id,
                    "products_id" => $orderItem["products_id"],
                    "quantity" => $orderItem["quantity"],
                    "size" => $orderItem["size"],
                ]);
            }

            return response()->json([
                "message" => "Bestelling succesvol aangemaakt",
                "order" => $order,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Er is iets misgegaan",
                "details" => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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