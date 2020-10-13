<?php

namespace App\Commands;

use App\Domain\Chessboard;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class PlaceChessboardPiece extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'chessboard-calculation:place {column=0} {row=0}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Runs a chessboard iteration from specific starting coordinates';

    public Chessboard $chessboard;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $chessboard = new Chessboard($this);

        $chessboard->placeQueen((int) $this->argument('column'), (int) $this->argument('row'), true)
            ->printCoordinatesAsTable();
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
