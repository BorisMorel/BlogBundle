<?php

namespace IMAG\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="IMAG\BlogBundle\Repository\BlogRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Blog
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   * @Assert\Type("integer")
   */
  protected $id;

  /**
   * @ORM\Column(type="text")
   * @Assert\NotBlank(message="Title required")
   * @Assert\Type("string")
   */
  protected $title;

  /**
   * @ORM\Column(type="text")
   * @Assert\NotBlank(message="Body mandatory")
   * @Assert\Type("string")
   */
  protected $body;

  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Assert\NotNull
   * @Assert\DateTime
   */
  protected $createdAt;
  
  /**
   * @ORM\Column(name="updated_at", type="datetime")
   * @Assert\NotNull
   * @Assert\DateTime
   */
  protected $updatedAt;

  /**
   * @ORM\OneToMany(targetEntity="BlogComment", mappedBy="blog", cascade={"remove"})
   * @Assert\Type("object")
   */
  protected $blogComments;

  public function __construct()
  {
    $this->createdAt = $this->updatedAt = new \DateTime('now');
    $this->blogComments = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * @ORM\PreUpdate
   */
  public function updated()
  {
    $this->updatedAt = new \DateTime('now');
  }


    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param text $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return text $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add blogComments
     *
     * @param IMAG\BlogBundle\Entity\BlogComment $blogComments
     */
    public function addBlogComments(\IMAG\BlogBundle\Entity\BlogComment $blogComments)
    {
        $this->blogComments[] = $blogComments;
    }

    /**
     * Get blogComments
     *
     * @return Doctrine\Common\Collections\Collection $blogComments
     */
    public function getBlogComments()
    {
        return $this->blogComments;
    }
}