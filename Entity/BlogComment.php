<?php

namespace IMAG\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="imag\BlogBundle\Repository\BlogCommentRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="Blog_comment")
 */
class BlogComment
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /** 
   * @ORM\Column(type="text")
   * @Assert\NotBlank(message = "Body mandatory")
   */
  protected $body;
  
  /**
   * @ORM\Column(type="string", length="255")
   * @Assert\NotBlank(message = "Pseudo required")
   * @Assert\MaxLength(255)
   */
  protected $pseudo;
  
  /**
   * @ORM\Column(name="created_at", type="datetime")
   * @Assert\DateTime
   * @Assert\NotNull
   */
  protected $createdAt;
  
  /**
   * @ORM\Column(name="updated_at", type="datetime")
   * @Assert\DateTime
   * @Assert\NotNull
   */
  protected $updatedAt;

  /**
   * @ORM\ManyToOne(targetEntity="Blog", inversedBy="blogComments")
   * @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
   * @Assert\Type("object")
   * @Assert\NotNull
   */
  protected $blog;

  public function __construct()
  {
    $this->createdAt = $this->updatedAt = new \DateTime('now');
  }
  
  /**
   * @ORM\PreUpdate
   */
  public function update()
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
     * @param IMAG\BlogBundle\Entity\Blog $blog
     */
    public function setBlog(\IMAG\BlogBundle\Entity\Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Get blog
     *
     * @return IMAG\BlogBundle\Entity\Blog $blog
     */
    public function getBlog()
    {
        return $this->blog;
    }
}