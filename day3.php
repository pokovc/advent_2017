function spiral_memory($input)
{
    $size = sqrt($input);
    $size = ceil($size);
    if ($size % 2 === 0) {
        $size += 1;
    }

    //bottom right corner is max of square
    $bot_right = $size * $size;
    $bot_left = $bot_right - $size + 1;
    $top_left = $bot_left - $size + 1;
    $top_right = $top_left - $size + 1;
    $max_distance = $size - 1;

    if ($input <= $top_right) {
        //right side
        $middle = $top_right - floor($size / 2);
    } elseif ($input <= $top_left) {
        //top side
        $middle = $top_left - floor($size / 2);
    } elseif ($input <= $bot_left) {
        //left side
        $middle = $bot_left - floor($size / 2);
    } else {
        //bot side
        $middle = $bot_right - floor($size / 2);
    }

    $middle_distance = $max_distance - floor($size / 2);
    if ($input > $middle) {
        $distance = $input - $middle + $middle_distance;
    } else {
        $distance = $middle - $input + $middle_distance;
    }

    echo $distance;
}

function spiral_memory_2($code, $input)
{
    //first value
    $x = 0;
    $y = 0;
    $grid[$x][$y] = 1;
    $max = 1;

    //calculate sum of neighbor numbers
    $calculate = function ($x1, $y1, $grid) {
        $sum = 0;
        foreach ([[1, 0], [1, 1], [0, 1], [-1, 1], [-1, 0], [-1, -1], [0, -1], [1, -1]] as $coords) {
            list($delta_x, $delta_y) = $coords;
            $value = isset($grid[$x1 + $delta_x][$y1 + $delta_y]) ? $grid[$x1 + $delta_x][$y1 + $delta_y] : 0;
            $sum += $value;
        }
        return $sum;
    };
    while (1) {
        //go right
        while ($x < $max) {
            $x++;
            $number = $calculate($x, $y, $grid);
            $grid[$x][$y] = $number;

            if ($number > $input) {
                break(2);
            }
        }

        //go up
        while ($y < $max) {
            $y++;
            $number = $calculate($x, $y, $grid);
            $grid[$x][$y] = $number;

            if ($number > $input) {
                break(2);
            }
        }

        //go left
        while ($x > ($max * -1)) {
            $x--;
            $number = $calculate($x, $y, $grid);
            $grid[$x][$y] = $number;

            if ($number > $input) {
                break(2);
            }
        }

        //go down
        while ($y > ($max * -1)) {
            $y--;
            $number = $calculate($x, $y, $grid);
            $grid[$x][$y] = $number;

            if ($number > $input) {
                break(2);
            }
        }

        $max++;
    }

    echo $number;
}
