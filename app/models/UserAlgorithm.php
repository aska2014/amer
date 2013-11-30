<?php

use Illuminate\Database\Query\Builder;

class UserAlgorithm extends \Kareem3d\Eloquent\Algorithm {

    /**
     * @param string $email
     * @return $this
     */
    public function byEmail( $email )
    {
        $this->getQuery()->where('email', $email);

        return $this;
    }

    /**
     * @return Builder
     */
    public function emptyQuery()
    {
        return User::query();
    }
}