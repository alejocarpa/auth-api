<?php

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *   @OA\Info(
 *     title="Auth API",
 *     version="1.0.0",
 *     description="API de autenticación con Laravel 12 + JWT"
 *   ),
 *   @OA\Server(
 *     url="http://localhost/api",
 *     description="Servidor local"
 *   )
 * )
 */

/**
 * @OA\Post(
 *   path="/v1/auth/login",
 *   tags={"Auth"},
 *   summary="Login de usuario",
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", example="ale@test.com"),
 *       @OA\Property(property="password", type="string", example="password123")
 *     )
 *   ),
 *   @OA\Response(response=200, description="Login exitoso"),
 *   @OA\Response(response=401, description="Credenciales incorrectas")
 * )
 */
