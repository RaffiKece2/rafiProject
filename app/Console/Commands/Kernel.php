<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;



class Kernel extends ConsoleKernel 
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(
            function () {

                \App\Models\Gallery::onlyTrashed()->where('deleted_at', '<=', now()->subDays(1))
                ->get()
                ->each(function ($file) {
                    Storage::delete($file->path);
                    $file->forceDelete();
                }
                
                );
                

            })->daily();

    }
}


?>