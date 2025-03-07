<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Registreer een nieuwe gebruiker",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "phone", "email", "password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="phone", type="string", example="+31612345678"),
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Gebruiker succesvol geregistreerd"),
     *     @OA\Response(response=400, description="Validatiefout"),
     * @OA\Header(
 *         header="Accept",
 *         description="Geef aan dat de API JSON verwacht",
 *         @OA\Schema(type="string", default="application/json")
 *     )
 * )
 */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'phone' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = \App\Models\User::create($validatedData);

        // return response(['user' => $user]);

        return response()->json([
            'message' => 'Gebruiker succesvol geregistreerd',
            'user' => $user
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Log in met e-mail en wachtwoord",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Succesvolle login" ),
     *     @OA\Response(response=401, description="Ongeldige inloggegevens")
 * )
 */



    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return response()->json(['error' => 'Ongeldige inloggegevens'], 401);
        }

        return response()->json([
            'message' => 'Succesvol ingelogd',
            'access_token' => Auth::user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => Auth::user()
        ], 200);
    }





    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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