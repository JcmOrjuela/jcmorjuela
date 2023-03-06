<?php

namespace App\Models;

use App\Models\Model;

class UserMovie extends Model
{
    private $imdbID;
    private $user_id;
    private $poster;
    private $title;
    private $type;
    private $year;

    public $fillable = [
        'imdbID',
        'user_id',
        'Poster',
        'Title',
        'Type',
        'Year',
    ];

    /**
     * Get the value of imdbID
     */
    public function getImdbID()
    {
        return $this->imdbID;
    }

    /**
     * Set the value of imdbID
     *
     * @return  self
     */
    public function setImdbID($imdbID)
    {
        $this->imdbID = $imdbID;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of poster
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set the value of poster
     *
     * @return  self
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of year
     *
     * @return  self
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }
}
