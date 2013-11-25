<?php namespace DateTime;

use DateTime;

class EnglishDateTime implements DateTimeInterface
{

    /**
     * @param string $format
     * @param string $date
     * @return string
     */
    public function date($format, $date)
    {
        if (!$this->isValid($date)) return '';

        $dateTime = strtotime($date);

        return date($format, $dateTime);
    }

    /**
     * Return true if the given date is valid (!= 1970/01/01)
     *
     * @param $date
     * @return bool
     */
    public function isValid($date)
    {
        return strtotime($date) != strtotime('01/01/1970');
    }

    /**
     * @param $datetime
     * @param bool $full
     * @return mixed
     */
    public function since($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach ($string as $k => &$v)
        {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}