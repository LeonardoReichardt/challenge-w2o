<?php

namespace App\Entities;

class MovimentoEstoque {

    #region Atributos

    private ?int $id;
    private int $produtoId;
    private string $tipo; // entrada | saida
    private int $quantidade;
    private string $dataMovimento;
    private string $usuario;

    #endregion

    #region Construtor

    public function __construct(
        ?int $id = null,
        int $produtoId = 0,
        string $tipo = 'entrada',
        int $quantidade = 0,
        string $dataMovimento = '',
        string $usuario = ''
    ) {
        $this->setId($id);
        $this->setProdutoId($produtoId);
        $this->setTipo($tipo);
        $this->setQuantidade($quantidade);
        $this->setDataMovimento($dataMovimento);
        $this->setUsuario($usuario);
    }

    #endregion

    #region Getters/Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }
    
    public function getProdutoId(): int {
        return $this->produtoId;
    }

    public function setProdutoId(int $produtoId): void {
        $this->produtoId = $produtoId;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void {
        $this->tipo = $tipo;
    }

    public function getQuantidade(): int {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): void {
        $this->quantidade = $quantidade;
    }

    public function getDataMovimento(): string {
        return $this->dataMovimento;
    }

    public function setDataMovimento(string $dataMovimento): void {
        $this->dataMovimento = $dataMovimento;
    }

    public function getUsuario(): string {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): void {
        $this->usuario = $usuario;
    }

    #endregion
    
}