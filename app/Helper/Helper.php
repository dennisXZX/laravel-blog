<?php

/**
* check if ellipsis need to be added
*
* @param string $text   - text that needs to be checked
* @param integer $limit - the word count limit of showing ellipsis
*/
function hasEllipsis($text, $limit)
{
    return strlen($text) > $limit ? '...' : '';
}

/**
 * format the date
 *
 * @param string $dateFormat - date format
 * @param integer $time      - the time to be formatted
 */
function dateFormatter($dateFormat, $time)
{
    return date($dateFormat, strtotime($time));
}
