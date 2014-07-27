<?php

use Estate\Estate;

class EstatePermission {

    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct( User $user = null )
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->user && $this->user->isAdministrator();
    }

    /**
     * @param \Estate\Estate $estate
     * @return bool
     */
    public function isOwner( Estate $estate )
    {
        return $this->user && $this->user->same($estate->user);
    }

    /**
     * @param Estate $estate
     * @return bool
     */
    public function canEdit( Estate $estate )
    {
        return $this->isOwner($estate) || $this->isAdministrator();
    }

    /**
     * @param Estate $estate
     * @return bool
     */
    public function canDisplay(Estate $estate)
    {
        return $estate->accepted || $this->isOwner($estate) || $this->isAdministrator();
    }

    /**
     * @param Estate $estate
     * @return bool
     */
    public function canAddAuctionOffer(Estate $estate)
    {
        return ! $this->isOwner($estate);
    }

    /**
     * @param Estate $estate
     * @return bool
     */
    public function canAddComment(Estate $estate)
    {
        return $this->user != null;
    }

    /**
     * @return bool
     */
    public function canCreate()
    {
        return $this->user != null;
    }

    /**
     * @param Estate $estate
     * @return bool
     */
    public function canUpgrade(Estate $estate)
    {
        return $this->isOwner($estate);
    }

    /**
     * @param Estate $estate
     * @return bool
     */
    public function canDelete(Estate $estate)
    {
        return $this->isOwner($estate) || $this->isAdministrator();
    }
}