<?php

namespace App\Entities;

class Produto {

    #region Atributos

    private ?int $id;
    private string $sku;
    private string $nome;
    private ?string $descricao;
    private float $preco;
    private ?string $foto;
    private ?string $dataVencimento;
    private string $dataCadastro;
    private string $dataEdicao;
    private int $categoriaId;

    #endregion

    #region Construtor

    public function __construct(
        ?int $id = null,
        string $sku = "",
        string $nome = "",
        ?string $descricao = null,
        float $preco = 0.0,
        ?string $foto = null,
        ?string $dataVencimento = null,
        string $dataCadastro = "",
        string $dataEdicao = "",
        int $categoriaId = 0
    ) {
        $this->setId($id);
        $this->setSku($sku);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setPreco($preco);
        $this->setFoto($foto);
        $this->setDataVencimento($dataVencimento);
        $this->setDataCadastro($dataCadastro);
        $this->setDataEdicao($dataEdicao);
        $this->setCategoriaId($categoriaId);
    }

    #endregion

    #region Getters/Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getSku(): string {
        return $this->sku;
    }

    public function setSku(string $sku): void {
        $this->sku = $sku;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getDescricao(): ?string {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void {
        $this->descricao = $descricao;
    }

    public function getPreco(): float {
        return $this->preco;
    }

    public function setPreco(float $preco): void {
        $this->preco = $preco;
    }

    public function getFoto(): ?string {
        return $this->foto;
    }

    public function setFoto(?string $foto): void {
        $this->foto = $foto;
    }

    public function getDataVencimento(): ?string {
        return $this->dataVencimento;
    }

    public function setDataVencimento(?string $dataVencimento): void {
        $this->dataVencimento = $dataVencimento;
    }

    public function getDataCadastro(): string {
        return $this->dataCadastro;
    }

    public function setDataCadastro(string $dataCadastro): void {
        $this->dataCadastro = $dataCadastro;
    }

    public function getDataEdicao(): string {
        return $this->dataEdicao;
    }

    public function setDataEdicao(string $dataEdicao): void {
        $this->dataEdicao = $dataEdicao;
    }

    public function getCategoriaId(): int {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): void {
        $this->categoriaId = $categoriaId;
    }

    #endregion

}