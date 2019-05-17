<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

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
        $statusEntity->firstOrCreate(['name' => 'Optie', 'css_class' => 'label-lease-option']);
        $statusEntity->firstOrCreate(['name' => 'Nieuwe aanvraag', 'css_class' => 'label-lease-new']);
        $statusEntity->firstOrCreate(['name' => 'Bevestigd', 'css_class' => 'label-lease-confirmed']);
    }
}
