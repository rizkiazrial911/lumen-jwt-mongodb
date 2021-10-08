<?php 

/**
 * @OA\Schema(
 *      title="Store Item request",
 *      description="Store Item request body data",
 *      type="object",
 *      required={"name", "email", "password"}
 * )
 */

class RegisterRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name User",
     *      example="John Adams"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="Email user",
     *      example="user@mail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Password User",
     *      example="secret"
     * )
     *
     * @var string
     */
    public $password;
}