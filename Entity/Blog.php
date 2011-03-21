<?php
namespace imag\BlogBundle\Entity;

/**
 * @orm:Entity(repositoryClass="imag\BlogBundle\Repository\BlogRepository")
 * @orm:HasLifecycleCallbacks
 */
class Blog
{
  /**
   * @orm:Id
   * @orm:Column(type="bigint")
   * @orm:GeneratedValue(strategy="AUTO")
   * @validation:AssertType("integer")
   */
  protected $id;

  /**
   * @orm:Column(type="text")
   * @validation:NotBlank(message="Title required")
   * @validation:AssertType("string")
   */
  protected $title;

  /**
   * @orm:Column(type="text")
   * @validation:NotBlank(message="Body mandatory")
   * @validation:AssertType("string")
   */
  protected $body;

  /**
   * @orm:Column(name="created_at", type="datetime")
   * @validation:NotNull
   * @validation:DateTime
   */
  protected $createdAt;
  
  /**
   * @orm:Column(name="updated_at", type="datetime")
   * @validation:NotNull
   * @validation:DateTime
   */
  protected $updatedAt;

  /**
   * @orm:OneToMany(targetEntity="BlogComment", mappedBy="blog", cascade={"remove"})
   * @validation:AssertType("object")
   */
  protected $blogComments;

  public function __construct()
  {
    $this->createdAt = $this->updatedAt = new \DateTime('now');
    $this->blogComments = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * @orm:PreUpdate
   */
  public function updated()
  {
    $this->updatedAt = new \DateTime('now');
  }


    /**
     * Get id
     *
     * @return bigint $id
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
     * @param imag\BlogBundle\Entity\BlogComment $blogComments
     */
    public function addBlogComments(\imag\BlogBundle\Entity\BlogComment $blogComments)
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
}