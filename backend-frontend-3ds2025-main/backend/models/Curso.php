<?php

include_once 'Conn.php';

class Curso
{
    private $id;
    private $nome;
    private $con;
    private $table = "tb_curso";

    public function __construct()
    {
        $this->con = new Conn();
    }

    // Getters e Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Operação CRUD via procedure armazenada
     * @param int $opcao (0 inserir, 1 atualizar, 2 deletar)
     * @return bool sucesso/falha
     */
    public function crud($opcao)
    {
        try {
            $sql = "CALL crud_curso(?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, $opcao);
            return $executar->execute() == 1 ? true : false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    /**
     * Consultar cursos, ou todos se $var_id = null
     */
    public function consultar($var_id = null)
    {
        try {
            $sql = "CALL listar_curso(?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $var_id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    /**
     * Pesquisa por nome
     */
    public function pesquisar($filtros)
    {
        if (empty($filtros) || $filtros[0] !== 'nome' || empty($filtros[1])) {
            return false; // filtro inválido ou vazio
        }

        $where = "cur_nome LIKE ?";
        $params = "%" . $filtros[1] . "%";

        $sql = "SELECT * FROM {$this->table} WHERE $where ORDER BY cur_nome ASC";
        $executar = $this->con->prepare($sql);
        $executar->bindValue(1, $params);
        return $executar->execute() == 1 ? $executar->fetchAll() : false;
    }

    /**
     * Total de registros na tabela
     */
    public function totalRegistros()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM {$this->table}";
            $executar = $this->con->prepare($sql);
            $executar->execute();
            $row = $executar->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return 0;
        }
    }

    /**
     * Paginar registros
     * @param int $pagina Página atual (default 1)
     * @param int $limite Quantidade de registros por página (default 10)
     * @return array|false
     */
    public function paginar($pagina = 1, $limite = 10)
    {
        try {
            $offset = ($pagina - 1) * $limite;
            $sql = "SELECT * FROM {$this->table} 
                    ORDER BY cur_nome ASC 
                    LIMIT :limite OFFSET :offset";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(":limite", (int) $limite, PDO::PARAM_INT);
            $executar->bindValue(":offset", (int) $offset, PDO::PARAM_INT);
            return $executar->execute() == 1 ? $executar->fetchAll(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
}
