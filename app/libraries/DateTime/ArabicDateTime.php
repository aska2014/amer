<?php namespace DateTime;

use DateTime;

class ArabicDateTime implements DateTimeInterface {

    /**
     * @param string $format
     * @param string $date
     * @return string
     */
    public function date($format, $date)
    {
        if(!$this->isValid( $date )) return '';

        $dateTime = strtotime( $date );

        $Ar = new \arabic\ArabicDate('Date');

        $fix = $Ar->dateCorrection (time());

        $Ar->setMode(3);

        return $Ar->date($format, $dateTime, $fix);
    }

    /**
     * Return true if the given date is valid (!= 1970/01/01)
     *
     * @param $date
     * @return bool
     */
    public function isValid( $date )
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

        $singular = array(
            'y' => 'سنة',
            'm' => 'شهر',
            'w' => 'اسبوع',
            'd' => 'يوم',
            'h' => 'ساعة',
            'i' => 'دقيقة',
            's' => 'ثانية',
        );

        $two = array(
            'y' => 'سنتين',
            'm' => 'شهرين',
            'w' => 'اسبوعين',
            'd' => 'يومين',
            'h' => 'ساعتين',
            'i' => 'دقيقتين',
            's' => 'ثانيتين',
        );

        $plural = array(
            'y' => 'سنوات',
            'm' => 'شهور',
            'w' => 'اسابيع',
            'd' => 'ايام',
            'h' => 'ساعات',
            'i' => 'دقائق',
            's' => 'ثوانى',
        );

        foreach ($singular as $k => &$v)
        {
            if ($diff->$k)
            {
                switch($diff->$k)
                {
                    // Singular
                    case 2:
                        $v = $two[$k];
                        break;
                    default:
                        $v = $diff->$k . ' ' . $plural[$k];
                        break;
                }

            } else {
                unset($singular[$k]);
            }
        }

        if (!$full) $singular = array_slice($singular, 0, 1);

        return $singular ? 'منذ ' . implode(', ', $singular) : 'منذ ثوانى';
    }
}