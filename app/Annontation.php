<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
    /**
     * @OA\Info(
     *   title="Example API",
     *   version="1.0",
     *   @OA\Contact(
     *     email="support@example.com",
     *     name="Support Team"
     *   )
     * )
     */
    /**
     * @OA\Post(
     *     path="/api/login",
     *     operationId="/api/login",
     *     tags={"Credentials"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns valid credential",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     * )
     * 
     * 
     * @OA\Post(
     *     path="/api/register",
     *     operationId="/api/register",
     *     tags={"Credentials"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Success register user",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     * )
     * 
     * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="Authorization",
     * )
     * 
     * @OA\Get(
     *     path="/api/check_login",
     *     operationId="/api/check_login",
     *     tags={"Credentials"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns message authorization"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized. when token is not valid.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     * 
     * @OA\Get(
     *     path="/api/refresh_token",
     *     operationId="/api/refresh_token",
     *     tags={"Credentials"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns new token"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized. when token is not valid.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     * @OA\Get(
     *     path="/api/logout",
     *     operationId="/api/logout",
     *     tags={"Credentials"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns message success logout"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized. when token is not valid.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     *  @OA\Get(
     *     path="/api/item",
     *     operationId="get_list",
     *     tags={"CRUD Via MongoDB"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns message list item"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized. when token is not valid.",
     *     ),
     *     security={{ "Authorization": {} }}
     *  )
     * 
     * @OA\Post(
     *     path="/api/item",
     *     operationId="store",
     *     tags={"CRUD Via MongoDB"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreProjectRequest")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Returns message success create item",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     *  @OA\Get(
     *     path="/api/item/{id}",
     *     operationId="get_detail",
     *     tags={"CRUD Via MongoDB"},
     *     @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="A id",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns message list item"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized. when token is not valid.",
     *     ),
     *     security={{ "Authorization": {} }}
     *  )
     * 
     * @OA\Put(
     *     path="/api/item/{id}",
     *     operationId="update",
     *     tags={"CRUD Via MongoDB"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreProjectRequest")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id items",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Returns message success update item",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     * @OA\Delete(
     *     path="/api/item/{id}",
     *     operationId="delete",
     *     tags={"CRUD Via MongoDB"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id items",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Returns message success delete item",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     * 
     * @OA\Get(
     *     path="/api/firebase",
     *     operationId="index-firebase",
     *     tags={"CRUD Via Firebase"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns message list item"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized. when token is not valid.",
     *     ),
     *     security={{ "Authorization": {} }}
     *  )
     * 
     * @OA\Post(
     *     path="/api/firebase",
     *     operationId="store-firebase",
     *     tags={"CRUD Via Firebase"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreProjectRequest")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Returns Success create item on firebase",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     * @OA\Get(
     *     path="/api/firebase/{id}",
     *     operationId="detail-firebase",
     *     tags={"CRUD Via Firebase"},
     *     @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="A id",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns message list item"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized. when token is not valid.",
     *     ),
     *     security={{ "Authorization": {} }}
     *  )
     * 
     * @OA\Put(
     *     path="/api/firebase/{id}",
     *     operationId="update",
     *     tags={"CRUD Via Firebase"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreProjectRequest")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id items",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Returns message success update item",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     * @OA\Delete(
     *     path="/api/firebase/{id}",
     *     operationId="delete",
     *     tags={"CRUD Via Firebase"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id items",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Returns message success delete item",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Error: Server error.",
     *     ),
     *     security={{ "Authorization": {} }}
     * )
     * 
     */

class Annotation extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

}