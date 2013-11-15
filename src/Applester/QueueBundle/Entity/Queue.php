<?php

namespace Applester\QueueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Queue
 */
class Queue
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $mobile;

    /**
     * @var string
     */
    private $handle;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $remarks;

    /**
     * @var \Applester\QueueBundle\Entity\Slot
     */
    private $slot;

    /**
     * @var \Applester\QueueBundle\Entity\Business
     */
    private $business;

    /**
     * @var \Applester\QueueBundle\Entity\Window
     */
    private $window;


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
     * Set mobile
     *
     * @param string $mobile
     * @return Queue
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set handle
     *
     * @param string $handle
     * @return Queue
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    
        return $this;
    }

    /**
     * Get handle
     *
     * @return string 
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Queue
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     * @return Queue
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    
        return $this;
    }

    /**
     * Get remarks
     *
     * @return string 
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set slot
     *
     * @param \Applester\QueueBundle\Entity\Slot $slot
     * @return Queue
     */
    public function setSlot(\Applester\QueueBundle\Entity\Slot $slot = null)
    {
        $this->slot = $slot;
    
        return $this;
    }

    /**
     * Get slot
     *
     * @return \Applester\QueueBundle\Entity\Slot 
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * Set business
     *
     * @param \Applester\QueueBundle\Entity\Business $business
     * @return Queue
     */
    public function setBusiness(\Applester\QueueBundle\Entity\Business $business = null)
    {
        $this->business = $business;
    
        return $this;
    }

    /**
     * Get business
     *
     * @return \Applester\QueueBundle\Entity\Business 
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set window
     *
     * @param \Applester\QueueBundle\Entity\Window $window
     * @return Queue
     */
    public function setWindow(\Applester\QueueBundle\Entity\Window $window = null)
    {
        $this->window = $window;
    
        return $this;
    }

    /**
     * Get window
     *
     * @return \Applester\QueueBundle\Entity\Window 
     */
    public function getWindow()
    {
        return $this->window;
    }
}