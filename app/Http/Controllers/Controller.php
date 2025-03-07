<?php

namespace App\Http\Controllers;


/**
 * @OA\Info(
 *     title="Jouw Laravel API",
 *     version="1.0",
 *     description="Dit is de documentatie voor de Laravel API.",
 *     @OA\Contact(
 *         email="support@jouwapi.com"
 *     )
 * )
 *@OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Voer hier je Bearer Token in om geautoriseerde verzoeken te maken"
 * )
 */
abstract class Controller
{
    //
}