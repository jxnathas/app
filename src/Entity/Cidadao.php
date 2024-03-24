<?php

namespace App\Entity;

use App\Repository\CidadaoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CidadaoRepository::class)]
class Cidadao
{
    public function __construct($nis, $nome) {
        $this->nis = $nis;
        $this->nome = $nome;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 11)]
    private ?string $nis = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nome = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNis(): ?string
    {
        return $this->nis;
    }

    public function setNis(string $nis): static
    {
        $this->nis = $nis;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }
}
