<?php

namespace App\Entities;

class Categoria {

    #region Atributos

    private ?int $id;
    private string $nome;

    #endregion

    #region Construtor

    public function __construct(?int $id = null, string $nome = "") {
        $this->setId($id);
        $this->setNome($nome);
    }

    #endregion

    #region Getters/Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    #endregion

}