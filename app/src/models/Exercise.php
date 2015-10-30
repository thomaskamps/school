<?php

namespace models;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Entity @Table(name="Exercises")
 * @HasLifecycleCallbacks
 **/
class Exercise
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;

    /** @Column(type="integer", nullable=false) **/
    public $term1;
    
    /** @Column(type="integer", nullable=false) **/
    public $term2;
    
    /** @Column(type="string", nullable=false) **/
    public $english_word;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
	/**
	* @ManyToMany(targetEntity="Course", mappedBy="exercise")
	*/
	private $course;
    
    /**
     * @Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /** @Column(type="integer", nullable=false) **/
    public $view_status;

    /** @Column(type="datetime", nullable=true) **/
    protected $pub_date;

    /** @Column(type="datetime", nullable=true) **/
    public $chg_date;

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
            
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @PrePersist()
     * @PreUpdate()
     */
    public function preUpload()
    {
        
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
			$originalFilename = $this->getFile()->getClientOriginalName();
			$mimetypeSplit = explode('.',$originalFilename);
			$mimetype = end($mimetypeSplit);
            $this->path = $filename.'.'.$mimetype;
        }
    }

    /**
     * @PostPersist()
     * @PostUpdate()
     */
    public function upload()
    {
        
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move(UPLOAD_DIR, $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink(UPLOAD_DIR.'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->course = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set exercise
     *
     * @param string $exercise
     *
     * @return Exercise
     */
    public function setExercise($exercise)
    {
        $this->exercise = $exercise;

        return $this;
    }

    /**
     * Get exercise
     *
     * @return string
     */
    public function getExercise()
    {
        return $this->exercise;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return Exercise
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Exercise
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set viewStatus
     *
     * @param integer $viewStatus
     *
     * @return Exercise
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
     * @return Exercise
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
     * @return Exercise
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
     * Add course
     *
     * @param \models\Course $course
     *
     * @return Exercise
     */
    public function addCourse(\models\Course $course)
    {
        $this->course[] = $course;

        return $this;
    }

    /**
     * Remove course
     *
     * @param \models\Course $course
     */
    public function removeCourse(\models\Course $course)
    {
        $this->course->removeElement($course);
    }

    /**
     * Get course
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set englishWord
     *
     * @param string $englishWord
     *
     * @return Exercise
     */
    public function setEnglishWord($englishWord)
    {
        $this->english_word = $englishWord;

        return $this;
    }

    /**
     * Get englishWord
     *
     * @return string
     */
    public function getEnglishWord()
    {
        return $this->english_word;
    }

    /**
     * Set term1
     *
     * @param integer $term1
     *
     * @return Exercise
     */
    public function setTerm1($term1)
    {
        $this->term1 = $term1;

        return $this;
    }

    /**
     * Get term1
     *
     * @return integer
     */
    public function getTerm1()
    {
        return $this->term1;
    }

    /**
     * Set term2
     *
     * @param integer $term2
     *
     * @return Exercise
     */
    public function setTerm2($term2)
    {
        $this->term2 = $term2;

        return $this;
    }

    /**
     * Get term2
     *
     * @return integer
     */
    public function getTerm2()
    {
        return $this->term2;
    }
}
