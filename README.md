# lagoon-kaleidoscope

# Running the tool

To use:
```shell
composer install
php src/index.php
```

## The Results

The results are shown as an array of tiles, with each tile shown as an array of pattern numbers.

The tile order is row-by-row, starting at the top-left, e.g.:
```
1  2  3  4
5  6  7  8
9  10 11 12
13 14 15 16
```

The patterns are listed in clockwise order, e.g.:

```
  1
4   2
  3
```

The numbers refer to the pattern descriptions in tiles.php.
