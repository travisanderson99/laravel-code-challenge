<?php

/**
 * Store image in public folder
 *
 * @param $file
 * @param $path
 *
 * @return $img
 */
if (!function_exists('storeImage')) {
    function storeImage($file, $path)
    {
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $filename  = md5(time()) . '-' . uniqid() . '.' . strtolower($extension);
            $file_full_path = $path . '/' . $filename;
            $file->move($path, $filename);
            $img = Image::make($file_full_path);

            // resize image
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save($file_full_path);

            return $filename;
        }
    }
}

/**
 * Convert given value to dollar format
 *
 * @param $amount
 * @return string
 */
if (!function_exists('money')) {
    function money($amount)
    {
        $amount = '$' . number_format((float)$amount, 2, '.', '');
        return $amount;
    }
}

/**
 * Format name
 *
 * @param $name
 * @return string
 */
if (!function_exists('formatName')) {
    function formatName($name)
    {
        return ucwords(strtolower($name));
    }
}

/**
 * Format a school name
 *
 * @param $school
 * @return string
 */
if (!function_exists('formatSchool')) {
    function formatSchool($school)
    {
        return ucwords(
            strtolower(
                str_ireplace(
                    ['High School', 'HS', 'High'],
                    '',
                    $school
                )
            )
        );
    }
}

/**
 * Convert the attendee's height to inches
 *
 * @param $height
 * @return int
 */
if (!function_exists('heightToInches')) {
    function heightToInches($height)
    {
        if (!$height) {
            return false;
        }

        $conversion = explode("'", $height);
        $feet = $conversion[0];
        $inches = str_replace('"', '', $conversion[1]);
        $inches = ($feet * 12) + $inches;

        return (int)$inches;
    }
}

/**
 * Format academic values (GPA, ACT, etc)
 *
 * @param $value
 * @return string
 */
if (!function_exists('formatAcademics')) {
    function formatAcademics($value)
    {
        return str_ireplace(
            ['N/A', 'NA', '-', 'Not taken yet',
            'Not yet taken', 'None', 'TBD',
            'Haven’t taken yet', 'awaiting score',
            'Taken not received scores yet', 'pending'],
            '',
            $value
        );
    }
}

/**
 * Format graduating class
 *
 * @param $class
 * @return string
 */
if (!function_exists('formatGraduatingClass')) {
    function formatGraduatingClass($class)
    {
        return str_ireplace(
            ['Class of', '(Invite Only)'],
            '',
            $class
        );
    }
}

/**
 * Convert given string to slug
 *
 * @param $text
 * @return string
 */
if (!function_exists('slugify')) {
    function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}

/**
 * Convert hex to rgba
 *
 * @param $hex
 * @param $opacity
 */
function hex2rgba($color, $opacity = false)
{
    $default = 'rgb( 0, 0, 0 )';

    /**
     * Return default if no color provided
     */
    if (empty($color)) {
        return $default;
    }

    /**
     * Sanitize $color if "#" is provided
     */
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    /**
     * Check if color has 6 or 3 characters and get values
     */
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    /**
     * [$rgb description]
     * @var array
     */
    $rgb = array_map('hexdec', $hex);

    /**
     * Check if opacity is set(rgba or rgb)
     */
    if ($opacity) {
        if (abs($opacity) > 1) {
            $opacity = 1.0;
        }
        $output  = 'rgba(' . implode(", ", $rgb) . ', ' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(", ", $rgb) . ')';
    }

    /**
     * Return rgb(a) color string
     */
    return $output;
}

/**
 * Create showcase schedule
 *
 * @param $teams
 * @return array
 */
if (!function_exists('scheduler')) {
    function scheduler(array $teams, $game_count, $court_count)
    {
        $teams = array_chunk($teams, count($teams) * .25);
        for ($i = 0; $i < $game_count; $i++) {
            if ($i % 2 == 0) {
                $off   = $i % 2 == 0 ? array_merge($teams[0], $teams[1]) : array_merge($teams[2], $teams[3]);
                $teams = $i % 2 == 0 ? array_merge($teams[2], $teams[3]) : array_merge($teams[0], $teams[1]);
                $teams = rotateTeams($teams, $off);
                $home  = $teams[0];
                $away  = $teams[1];
                sort($off);
            } else {
                $off   = array_merge($teams[0], $teams[1]);
                $teams = array_merge($teams[2], $teams[3]);
                $teams = rotateTeams($teams, $off);
                $home  = $teams[0];
                $away  = $teams[1];
                sort($off);
            }
            for ($j = 0; $j < count($home); $j++) {
                $round[$i][$j]["Court"] = $j + 1;
                $round[$i][$j]["Home"]  = $home[$j];
                $round[$i][$j]["Away"]  = $away[$j];
                $round[$i][$j]["Off"]   = $off;
            }
        }
        return $round;
    }
}

/**
 * Chunk array vertically
 *
 * @param $arr
 * @param int
 * @return string
 */
if (!function_exists('arraychunkVertical')) {
    function arrayChunkVertical($arr, $percolnum)
    {
        $n    = count($arr);
        $mod  = $n % $percolnum;
        $cols = floor($n / $percolnum);
        $mod ? $cols++ : null;
        $re = array();
        for ($col = 0; $col < $cols; $col++) {
            for ($row = 0; $row < $percolnum; $row++) {
                if ($arr) {
                    $re[$row][]   = array_shift($arr);
                }
            }
        }
        return $re;
    }
}

/**
 * Rotate the teams within a schedule
 */
if (!function_exists('rotateTeams')) {
    function rotateTeams($teams, $off)
    {
        $move = $teams[1];
        unset($teams[1]);
        array_push($teams, $move);
        $teams = array_merge($teams, $off);
        $teams = array_chunk($teams, count($teams) * .25);
        return $teams;
    }
}

/**
 * Return state's abbreviation
 *
 * @param $state_name
 * @return string
 */
function convertState($state_name)
{
    switch ($state_name) {
        case "Alabama":
            return "AL";
            break;
        case "Alaska":
            return "AK";
            break;
        case "Arizona":
            return "AZ";
            break;
        case "Arkansas":
            return "AR";
            break;
        case "California":
            return "CA";
            break;
        case "Colorado":
            return "CO";
            break;
        case "Connecticut":
            return "CT";
            break;
        case "Delaware":
            return "DE";
            break;
        case "Florida":
            return "FL";
            break;
        case "Georgia":
            return "GA";
            break;
        case "Hawaii":
            return "HI";
            break;
        case "Idaho":
            return "ID";
            break;
        case "Illinois":
            return "IL";
            break;
        case "Indiana":
            return "IN";
            break;
        case "Iowa":
            return "IA";
            break;
        case "Kansas":
            return "KS";
            break;
        case "Kentucky":
            return "KY";
            break;
        case "Louisana":
            return "LA";
            break;
        case "Maine":
            return "ME";
            break;
        case "Maryland":
            return "MD";
            break;
        case "Massachusetts":
            return "MA";
            break;
        case "Michigan":
            return "MI";
            break;
        case "Minnesota":
            return "MN";
            break;
        case "Mississippi":
            return "MS";
            break;
        case "Missouri":
            return "MO";
            break;
        case "Montana":
            return "MT";
            break;
        case "Nebraska":
            return "NE";
            break;
        case "Nevada":
            return "NV";
            break;
        case "New Hampshire":
            return "NH";
            break;
        case "New Jersey":
            return "NJ";
            break;
        case "New Mexico":
            return "NM";
            break;
        case "New York":
            return "NY";
            break;
        case "North Carolina":
            return "NC";
            break;
        case "North Dakota":
            return "ND";
            break;
        case "Ohio":
            return "OH";
            break;
        case "Oklahoma":
            return "OK";
            break;
        case "Oregon":
            return "OR";
            break;
        case "Pennsylvania":
            return "PA";
            break;
        case "Rhode Island":
            return "RI";
            break;
        case "South Carolina":
            return "SC";
            break;
        case "South Dakota":
            return "SD";
            break;
        case "Tennessee":
            return "TN";
            break;
        case "Texas":
            return "TX";
            break;
        case "Utah":
            return "UT";
            break;
        case "Vermont":
            return "VT";
            break;
        case "Virginia":
            return "VA";
            break;
        case "Washington":
            return "WA";
            break;
        case "Washington D.C.":
            return "DC";
            break;
        case "West Virginia":
            return "WV";
            break;
        case "Wisconsin":
            return "WI";
            break;
        case "Wyoming":
            return "WY";
            break;
        default:
            return $state_name;
    }
}

/**
 * Generate a random token
 */
function generateToken()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Return the site's admin emails
 *
 * @param $website
 */
function adminEmails($website = null)
{
    $admin_emails = [];

    $users = \App\User::whereHas('roles', function ($q) {
        $q->where('name', 'Admin')->orWhere('name', 'Event Manager');
    })->get();

    // Remove users not associated with the event website
    if ($website) {
        $filtered_users = $users->filter(function ($user) use ($website) {
            return $user->primary_website_id == $website->id || $user->primary_website_id == null;
        });
    }

    // Build array of emails
    foreach ($filtered_users as $user) {
        $admin_emails[] = $user->email;
    }

    // Remove any empty values
    $admin_emails = array_filter($admin_emails);

    return $admin_emails;
}
