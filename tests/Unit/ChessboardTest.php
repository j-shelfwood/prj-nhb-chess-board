<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Chessboard;

class ChessboardTest extends TestCase
{
    public Chessboard $chessboard;

    protected function setUp(): void
    {
        $this->chessboard = new Chessboard();
    }
    /**
     * A basic test example.
     *
     * @return void
    */
    public function tests_that_the_chessboard_prepares_coordinates()
    {
        $chessboard = [
            ['o','o','o','o','o','o','o'],
            ['o','o','o','o','o','o','o'],
            ['o','o','o','o','o','o','o'],
            ['o','o','o','o','o','o','o'],
            ['o','o','o','o','o','o','o'],
            ['o','o','o','o','o','o','o'],
            ['o','o','o','o','o','o','o'],
        ];

        $this->assertTrue($chessboard === (new Chessboard())->coordinates);
    }

    public function tests_a_chessboard_can_place_a_queen_on_the_board()
    {
        $column = 0;
        $row = 0;
        $this->chessboard->placeQueen($column,$row);

        $this->assertEquals($this->chessboard->coordinates[0][0], 'x');
    }

    public function tests_a_chessboard_can_check_if_a_piece_can_be_placed_on_the_board_without_killing_any_horizontal()
    {
        $toBePlacedQueens = collect([
            [3,3]
        ]);

        $toBePlacedQueens->each(function ($queen) {
            $this->chessboard->placeQueen($queen[0], $queen[1]);
        });

        $this->assertFalse($this->chessboard->canPlaceWithoutKilling(3,4));
    }

    public function tests_a_chessboard_can_check_if_a_piece_can_be_placed_on_the_board_without_killing_any_vertical()
    {
        $toBePlacedQueens = collect([
            [3,3]
        ]);

        $toBePlacedQueens->each(function ($queen) {
            $this->chessboard->placeQueen($queen[0], $queen[1]);
        });

        $this->assertFalse($this->chessboard->canPlaceWithoutKilling(4,3));
    }

    public function tests_a_chessboard_can_check_if_a_piece_can_be_placed_on_the_board_without_killing_any_top_left_to_bottom_right_diagonally()
    {
        $toBePlacedQueens = collect([
            [5,2]
        ]);

        $toBePlacedQueens->each(function ($queen) {
            $this->chessboard->placeQueen($queen[0], $queen[1]);
        });

        $this->assertFalse($this->chessboard->canPlaceWithoutKilling(4,1));
    }

    public function tests_a_chessboard_can_check_if_a_piece_can_be_placed_on_the_board_without_killing_any_bottom_left_to_top_right_diagonally()
    {
        $toBePlacedQueens = collect([
            [2,1]
        ]);

        $toBePlacedQueens->each(function ($queen) {
            $this->chessboard->placeQueen($queen[0], $queen[1]);
        });

        $this->assertFalse($this->chessboard->canPlaceWithoutKilling(1,2));
    }
}
