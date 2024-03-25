<?php

namespace App\Entity;

use App\Repository\CidadaoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CidadaoRepository::class)]
class Cidadao
{
    public function __construct($nome) {
        $this->nis = $this->gerarNISUnico();
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
        if (!$this->nis) {
            $this->nis = $this->gerarNisUnico();
        }
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
    private function gerarNisUnico(): string
    {
        do {
            $nis = $this->gerarNis();
        } while ($this->nisJaExiste($nis));

        return $nis;
    }

    private function gerarNis(): string
    {
        return str_pad(rand(1, 999999999), 11, '0', STR_PAD_LEFT); // Gera um número aleatório de 11 dígitos
    }

    private function nisJaExiste(string $nis): bool
    {
        $entityManager = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager();
        $existe = $entityManager->getRepository(Cidadao::class)->findOneBy(['nis' => $nis]);

        return $existe !== null;
    }
}
