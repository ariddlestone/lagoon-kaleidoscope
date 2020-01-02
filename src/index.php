<?php

namespace ARiddlestone\LagoonKaleidoscope;

require_once __DIR__ . '/../vendor/autoload.php';

$game = new Game();
$start = time();
$solved = $game->solve();
$end = time();
echo sprintf("%s in %u seconds, after %u tests:\n[%s]\n", $solved ? 'Solved' : 'Failed to solve', $end - $start, $game->getTestCount(), implode(', ', $game->getBoard()));
