<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 06/10/2018
 * Time: 19:07
 */

class FatorLivro
{
    public $fl_idfator;
    public $fl_idlivro;
    public $fl_idusuario;
    public $fl_fator;

    public function __construct($fl_id=null,$fl_idfator=null,$fl_idlivro=null,$fl_idusuario=null,$fl_fator=null){
        $this->fl_id = $fl_id;
        $this->fl_idfator = $fl_idfator;
        $this->fl_idlivro = $fl_idlivro;
        $this->fl_idusuario = $fl_idusuario;
        $this->fl_idfator = $fl_fator;
    }

    public $fl_id;

    /**
     * @return null
     */
    public function getFlId()
    {
        return $this->fl_id;
    }

    /**
     * @param null $fl_id
     */
    public function setFlId($fl_id)
    {
        $this->fl_id = $fl_id;
    }

    /**
     * @return null
     */
    public function getFlIdfator()
    {
        return $this->fl_idfator;
    }

    /**
     * @param null $fl_idfator
     */
    public function setFlIdfator($fl_idfator)
    {
        $this->fl_idfator = $fl_idfator;
    }

    /**
     * @return null
     */
    public function getFlIdlivro()
    {
        return $this->fl_idlivro;
    }

    /**
     * @param null $fl_idlivro
     */
    public function setFlIdlivro($fl_idlivro)
    {
        $this->fl_idlivro = $fl_idlivro;
    }

    /**
     * @return null
     */
    public function getFlIdusuario()
    {
        return $this->fl_idusuario;
    }

    /**
     * @param null $fl_idusuario
     */
    public function setFlIdusuario($fl_idusuario)
    {
        $this->fl_idusuario = $fl_idusuario;
    }

    /**
     * @return mixed
     */
    public function getFlFator()
    {
        return $this->fl_fator;
    }

    /**
     * @param mixed $fl_fator
     */
    public function setFlFator($fl_fator)
    {
        $this->fl_fator = $fl_fator;
    }
}