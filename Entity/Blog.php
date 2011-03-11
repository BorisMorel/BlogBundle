<?php
namespace imag\BlogBundle\Entity;

/**
 * @orm:Entity(repositoryClass="imag\BlogBundle\Repository\BlogRepository")
 */
class Blog
{
  /**
   * @orm:Id
   * @orm:Column(type="bigint")
   * @orm:GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @orm:Column(type="text")
   * @validation:NotBlank
   * @validation:AssertType("string")
   */
  protected $title;

  /**
   * @orm:Column(type="datetime")
   * @validation:NotNull
   * @validation:DateTime
   */
  protected $created_at;
  
  /**
   * @orm:Column(type="datetime")
   * @validation:NotNull
   * @validation:DateTime
   */
  protected $updated_at;

  /**
   * @orm:OneToMany(targetEntity="BlogComment", mappedBy="blog")
   * @validation:AssertType("object")
   */
  protected $blogComments;

  public function __construct()
  {
    $this->created_at = $this->updated_at = new \DateTime('now');
    $this->blogComments = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * @orm:PreUpdate
   */
  public function updated()
  {
    $this->updated_at = new \DateTime('now');
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
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
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
}