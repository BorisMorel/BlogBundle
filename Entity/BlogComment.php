<?php
namespace imag\BlogBundle\Entity;

/** 
 * @orm:Entity(repositoryClass="imag\BlogBundle\Repository\BlogCommentRepository")
 * @orm:Table(name="Blog_comment")
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
   * @validation:NotBlank
   */
  protected $body;
  
  /**
   * @orm:Column(type="string", length="255")
   * @validation:NotBlank
   * @validation:MaxLength(255)
   */
  protected $pseudo;
  
  /**
   * @orm:Column(type="datetime")
   * @validation:DateTime
   * @validation:NotNull
   */
  protected $created_at;
  
  /**
   * @orm:Column(type="datetime")
   * @validation:DateTime
   * @validation:NotNull
   */
  protected $updated_at;

  /**
   * @orm:ManyToOne(targetEntity="Blog", inversedBy="blogComments")
   * @orm:JoinColumn(name="blog_id", referencedColumnName="id")
   * @validation:AssertType("object")
   * @validation:NotNull
   */
  protected $blog;

  public function __construct()
  {
    $this->created_at = $this->updated_at = new \DateTime('now');
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