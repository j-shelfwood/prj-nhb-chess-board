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

    public Chessboard $chessboard;
    public int $scanCount = 0;
    public int $queensPlaced = 0;
    public int $spotsChecked = 0;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $chessboard = new Chessboard($this); 
        
        $columnsToCheck = range(0, $chessboard->size - 1);
        $rowsToCheck = range(0, $chessboard->size - 1);

        while($this->scanCount < 7) {
            $this->scanCount++;
            foreach ($columnsToCheck as $column)
            {
                foreach ($rowsToCheck as $row)
                {
                    $this->spotsChecked++;
                    if ($chessboard->canPlaceWithoutKilling($column, $row)) {
                        $chessboard->placeQueen($column, $row);
                        $this->queensPlaced++;
                    };
                }
            }
        }

        $chessboard->printCoordinatesAsTable($this);
        $this->comment("{$this->spotsChecked} spots checked for eligibility");
        $this->comment("The board has been scanned {$this->scanCount} times");
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
