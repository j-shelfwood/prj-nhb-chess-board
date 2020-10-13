<?php

namespace App\Domain;

use Illuminate\Console\Command;

class Chessboard 
{
    public int $size = 7;
    public array $coordinates;
    public Command $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
        $this->fillCoordinates();
    }

    public function fillCoordinates()
    {
        $columns = [];

        for ($i = 0; $i < $this->size; $i++) 
        {
            $columns[] = collect()->range(0, $this->size -1)->map(fn () => 'o')->toArray();
        }

        $this->coordinates = $columns;
    }

    public function setCoordinate($column, $row, $value)
    {
        $this->coordinates[$column][$row] = $value;

        return $this;
    }

    public function placeQueen($column, $row, $markVurnarableSpots = false): self
    {
        $this->coordinates[$column][$row] = 'x';

        if ($markVurnarableSpots)
        {
            // Mark horizontal placing
            for ($i = 0; $i < $this->size; $i++) {
                $this->setCoordinate($column, $i, '@');
            }
            // Mark vertical placing
            for ($i = 0; $i < $this->size; $i++) {
                $this->setCoordinate($i, $row, '@');
            }
            // Mark diagonal bottom-left to top-right
            // $placementColumn = $column + (6 - $row);
            // //2
            // $initialRow = $row - (6 - $column);
            // if ($initialRow < 0) {
            //     $initialRow = 0;
            // }
            // for ($placementRow = $initialRow; $placementColumn >= 0; $placementColumn--) {
            //     if ($placementColumn > 6) {
            //         $placementColumn = 6;
            //     }
            //     $this->setCoordinate($placementColumn, $placementRow, '@');
            //     $placementRow++;
            // }

            // Mark diagonal top-left to bottom-right
            $placementRow = 0;
            for ($placementColumn = $column - $row; $placementColumn < 7; $placementColumn++) {
                if ($placementColumn < 0) {
                    $placementColumn = 0;
                }
                $this->setCoordinate($placementColumn, $placementRow, '@');
                $placementRow++;
            }
        }

        return $this;
    }

    public function canPlaceWithoutKilling($column, $row)
    {
        // Test horizontal placing
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->spotIsTaken($column, $i)) {
                return false;
            }
        }
        // Test vertical placing
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->spotIsTaken($i, $row)) {
                return false;
            }
        }
        // Test diagonal bottom-left to top-right
        $placementRow = 0;
        for ($placementColumn = $column + $row; $placementColumn > 0; $placementColumn--) {
            if ($placementColumn > 6) {
                $placementColumn = 6;
            }
            if ($this->spotIsTaken($placementColumn, $placementRow)) {
                return false;
            }
            $placementRow++;
        }

         // Test diagonal top-left to bottom-right
        $placementRow = 0;
        for ($placementColumn = $column - $row; $placementColumn < 6; $placementColumn++) {
            if ($placementColumn < 0) {
                $placementColumn = 0;
            }
            if ($this->spotIsTaken($placementColumn, $placementRow)) {
                return false;
            }
            $placementRow++;
        }

        return true;
    }

    public function spotIsTaken($column, $row)
    {
        return $this->coordinates[$column][$row] === 'x';
    }

    public function printCoordinatesAsTable(): self
    {
        $headers = range(0,6);

        $this->command->table($headers, $this->coordinates);

        return $this;
    }
}