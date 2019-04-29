<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

/**
 * Class StatusTableSeeder
 */
class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  Status $statusEntity THe model instance for the lease statusses. 
     * @return void
     */
    public function run(Status $statusEntity): void
    {
        $statusEntity->firstOrCreate(['name' => 'Optie']);
        $statusEntity->firstOrCreate(['name' => 'Nieuwe aanvraag']);
        $statusEntity->firstOrCreate(['name' => 'Bevestigd']);
    }
}
