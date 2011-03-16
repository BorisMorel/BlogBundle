<?php
namespace imag\BlogBundle\Entity;

/** 
 * @orm:Entity(repositoryClass="imag\BlogBundle\Repository\BlogCommentRepository")
 * @orm:Table(name="Blog_comment")
 * @orm:HasLifecycleCallbacks
 */
class BlogComment
{
  /**
   * @orm:Id
   * @orm:Column(type="bigint")
   * @orm:GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /** 
   * @orm:Column(type="text")
   * @validation:NotBlank(message = "Body mandatory")
   */
  protected $body;
  
  /**
   * @orm:Column(type="string", length="255")
   * @validation:NotBlank(message = "Pseudo required")
   * @validation:MaxLength(255)
   */
  protected $pseudo;
  
  /**
   * @orm:Column(name="created_at", type="datetime")
   * @validation:DateTime
   * @validation:NotNull
   */
  protected $createdAt;
  
  /**
   * @orm:Column(name="updated_at", type="datetime")
   * @validation:DateTime
   * @validation:NotNull
   */
  protected $updatedAt;

  /**
   * @orm:ManyToOne(targetEntity="Blog", inversedBy="blogComments")
   * @orm:JoinColumn(name="blog_id", referencedColumnName="id")
   * @validation:AssertType("object")
   * @validation:NotNull
   */
  protected $blog;

  public function __construct()
  {
    $this->createdAt = $this->updatedAt = new \DateTime('now');
  }
  
  /**
   * @orm:PreUpdate
   */
  public function update()
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
     * Set pseudo
     *
     * @param string $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Get pseudo
     *
     * @return string $pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
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
     * Set blog
     *
     * @param imag\BlogBundle\Entity\Blog $blog
     */
    public function setBlog(\imag\BlogBundle\Entity\Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Get blog
     *
     * @return imag\BlogBundle\Entity\Blog $blog
     */
    public function getBlog()
    {
        return $this->blog;
    }
}