# Chessboard Assignment

Make a chessboard with a size of 7x7 and place 7 queens in a way that they can't kill eachother. The idea is that you spend no more than 4 hours on it. 

*Commit 64ea455206370bcecadea1f6cea962efc3054f8d is the final commit within the agreed upon 4 hours*
(I wanted to make some late night revisions to maybe crack the problem)

Technical Requirements:

- PHP 7.4
- Composer

## Installation

This repository uses Laravel Zero behind the scenes to create a simple environment for making console applications and testing them.

Clone the repository and run the following command:

```
composer install
```

Then to run the simulation you can run 

```
php application chessboard-calculation:run
```

## Status

The chessboard class is capable of checking if coordinates are empty. In addition you can use a function to determine if a queen can be placed without killing any other pieces. Currently it only knows if there is a queen in a horizontal or vertical position relative to the placement.

To finish the algorithm it still needs to know about the 2 diagonal axes to correctly place the queens.

This was not accomplished within the 4 hour mark.
