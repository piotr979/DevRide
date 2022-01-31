<?php

namespace App\Entity;

use App\Repository\NewsArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsArticleRepository::class)]
class NewsArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $header;

    #[ORM\Column(type: 'string', length: 500)]
    private $subheader;

    #[ORM\Column(type: 'string', length: 255)]
    private $icon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(string $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getSubheader(): ?string
    {
        return $this->subheader;
    }

    public function setSubheader(string $subheader): self
    {
        $this->subheader = $subheader;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
