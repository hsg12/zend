<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="category_id_index", columns={"category_id"})})
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="short_content", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $shortContent;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, precision=0, scale=0, nullable=true, options={"default"="/img/home/no-image.jpg"}, unique=false)
     */
    private $image = '/img/home/no-image.jpg';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_public", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isPublic;

    /**
     * @var \Application\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $category;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set shortContent.
     *
     * @param string|null $shortContent
     *
     * @return Article
     */
    public function setShortContent($shortContent = null)
    {
        $this->shortContent = $shortContent;

        return $this;
    }

    /**
     * Get shortContent.
     *
     * @return string|null
     */
    public function getShortContent()
    {
        return $this->shortContent;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image.
     *
     * @param string|null $image
     *
     * @return Article
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set isPublic.
     *
     * @param bool $isPublic
     *
     * @return Article
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic.
     *
     * @return bool
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set category.
     *
     * @param \Application\Entity\Category|null $category
     *
     * @return Article
     */
    public function setCategory(\Application\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \Application\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }
}
