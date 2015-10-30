<?php

namespace models;

/**
 * @Entity @Table(name="course")
 **/
class Course
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;

    /** @Column(type="string", nullable=false) **/
    public $title;

    /** @Column(type="integer", nullable=false) **/
    public $level;

    /** @Column(type="integer", nullable=false) **/
    public $view_status;

    /** @Column(type="datetime", nullable=true) **/
    protected $pub_date;

    /** @Column(type="datetime", nullable=true) **/
    public $chg_date;
    
    /**
     * @ManyToMany(targetEntity="models\Exercise", cascade={"persist"})
     */
    protected $exercise;
    
    public function __toString()
    {
        return (string) $this->getTitle();
    }
    
    public function __construct()
    {
        $this->exercise = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Course
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Course
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set viewStatus
     *
     * @param integer $viewStatus
     *
     * @return Course
     */
    public function setViewStatus($viewStatus)
    {
        $this->view_status = $viewStatus;

        return $this;
    }

    /**
     * Get viewStatus
     *
     * @return integer
     */
    public function getViewStatus()
    {
        return $this->view_status;
    }

    /**
     * Set pubDate
     *
     * @param \DateTime $pubDate
     *
     * @return Course
     */
    public function setPubDate($pubDate)
    {
        $this->pub_date = $pubDate;

        return $this;
    }

    /**
     * Get pubDate
     *
     * @return \DateTime
     */
    public function getPubDate()
    {
        return $this->pub_date;
    }

    /**
     * Set chgDate
     *
     * @param \DateTime $chgDate
     *
     * @return Course
     */
    public function setChgDate($chgDate)
    {
        $this->chg_date = $chgDate;

        return $this;
    }

    /**
     * Get chgDate
     *
     * @return \DateTime
     */
    public function getChgDate()
    {
        return $this->chg_date;
    }

    /**
     * Add exercise
     *
     * @param \models\Exercise $exercise
     *
     * @return Course
     */
    public function addExercise(\models\Exercise $exercise)
    {
        $this->exercise[] = $exercise;

        return $this;
    }

    /**
     * Remove exercise
     *
     * @param \models\Exercise $exercise
     */
    public function removeExercise(\models\Exercise $exercise)
    {
        $this->exercise->removeElement($exercise);
    }

    /**
     * Get exercise
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExercise()
    {
        return $this->exercise;
    }
}
