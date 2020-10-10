<?php

namespace App\Commands;

use App\Domain\Chessboard;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class RunChessboardCalculation extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'chessboard-calculation:run';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Runs a chessboard iteration from specific starting coordinates';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $chessboard = new Chessboard(); 
        
        $columns = range(0, $chessboard->size - 1);
        $rows = range(0, $chessboard->size - 1);

        foreach ($columns as $column)
        {
            foreach ($rows as $row)
            {
                if ($chessboard->canPlaceWithoutKilling($column, $row)) {
                    $chessboard->placeQueen($column, $row);
                };
                
            }
        }

        $chessboard->printCoordinatesAsTable($this);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
