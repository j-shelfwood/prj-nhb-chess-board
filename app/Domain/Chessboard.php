<?php

namespace App\Domain;

class Chessboard 
{
    public int $size = 7;
    public array $coordinates;

    public function __construct()
    {
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

    public function placeQueen($column, $row)
    {
        $this->coordinates[$column][$row] = 'x';
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
        // column = 2
        $placementRow = 0;
        for ($placementColumn = $column - $row; $placementColumn > 0; $placementColumn--) {
            $placementRow++;
            if ($this->spotIsTaken($placementColumn, $placementRow)) {
                return false;
            }
        }

         // Test diagonal top-left to bottom-right
        $placementColumn = 0;
        for ($placementRow = $row - $column; $placementRow < 6; $placementRow++) {
            
            $placementColumn++;
            if ($this->spotIsTaken($placementRow, $placementColumn)) {
                return false;
            }
        }

        return true;
    }

    public function spotIsTaken($column, $row)
    {
        return $this->coordinates[$column][$row] === 'x';
    }

    public function printCoordinatesAsTable($command)
    {
        $headers = range(0,6);

        $command->table($headers, $this->coordinates);
    }
}