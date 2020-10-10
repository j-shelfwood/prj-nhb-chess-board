# Chessboard Assignment

Make a chessboard with a size of 7x7 and place 7 queens in a way that they can't kill eachother.


## Installation

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
