<?php

namespace App\Entity;

use App\Repository\LegalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegalRepository::class)]
class Legal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $legal_notice = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $privacy_policy = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $cookies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLegalNotice(): ?string
    {
        return $this->legal_notice;
    }

    public function setLegalNotice(?string $legal_notice): static
    {
        $this->legal_notice = $legal_notice;

        return $this;
    }

    public function getPrivacyPolicy(): ?string
    {
        return $this->privacy_policy;
    }

    public function setPrivacyPolicy(?string $privacy_policy): static
    {
        $this->privacy_policy = $privacy_policy;

        return $this;
    }

    public function getCookies(): ?string
    {
        return $this->cookies;
    }

    public function setCookies(?string $cookies): static
    {
        $this->cookies = $cookies;

        return $this;
    }
}
