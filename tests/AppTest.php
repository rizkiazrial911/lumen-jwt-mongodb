<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Item;
use App\Models\User;

class AppTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Get Items
        $dummy_user = User::factory()->create();
        $response = $this->actingAs($dummy_user)->get('/api/item');
        $this->assertEquals(200, $this->response->status());

        // Create Items
        $store = $this->actingAs($dummy_user)->post('/api/item', ['title' => 'Aurum Testing', 'price' => 999]);
        $store ->seeJsonEquals([
            'message' => "Success Create Item",
        ]);

        // Delete Users
        $items = Item::where('title', 'Aurum Testing')->first();
        $delete = $this->actingAs($dummy_user)->json("DELETE", '/api/item/'.$items->_id);
        $delete->seeJsonEquals([
            'message' => "Success delete Item",
        ]);
    }
}
