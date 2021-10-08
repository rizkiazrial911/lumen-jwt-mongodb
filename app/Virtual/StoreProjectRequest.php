<?php 

/**
 * @OA\Schema(
 *      title="Store Project request",
 *      description="Store Project request body data",
 *      type="object",
 *      required={"title", "price"}
 * )
 */

class StoreProjectRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Title item",
     *      example="Indomie Goreng"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="price",
     *      description="Price of item",
     *      example="1000"
     * )
     *
     * @var string
     */
    public $price;
}