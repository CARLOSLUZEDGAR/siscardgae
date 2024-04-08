<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;

// use App\Http\Controllers\createindex;

class pagegroup extends FPDF
{
    protected $NewPageGroup = false;   // variable indicating whether a new group was requested
    protected $PageGroups = array();   // variable containing the number of pages of the groups
    protected $CurrPageGroup;          // variable containing the alias of the current page group

    protected $CantPageAnterior = 0;

    // create a new page group; call this before calling AddPage()
    function StartPageGroup()
    {
        
        $this->NewPageGroup = true;
    }

    // current page in the group
    function GroupPageNo()
    {
        // global $p;
        // if($p != 5){
            return $this->PageGroups[$this->CurrPageGroup];
        // }else{
        //     return $this->convertirNum($this->PageGroups[$this->CurrPageGroup]);
        // }

        // return $this->PageGroups[$this->CurrPageGroup];
    }

    // alias of the current page group -- will be replaced by the total number of pages in this group
    function PageGroupAlias()
    {
        // global $p;
        // if($p != 5){
            return $this->CurrPageGroup;
        // }else{
        //     return $this->convertirNum($this->CurrPageGroup);
        // }
    }

    function CantPagesAnterior()
    {
        return "{nb$this->n}";
    }

    function _beginpage($orientation, $size, $rotation)
    {
        parent::_beginpage($orientation, $size, $rotation);
        if($this->NewPageGroup)
        {
            // start a new group
            $n = sizeof($this->PageGroups)+1;
            $alias = "{nb$n}";
            $this->PageGroups[$alias] = 1;
            $this->CurrPageGroup = $alias;
            $this->NewPageGroup = false;
        }
        elseif($this->CurrPageGroup)
            $this->PageGroups[$this->CurrPageGroup]++;

        if ($this->CurrPageGroup == '{nb3}') {
            $this->PageGroups['{nb4}'] = $this->convertirNum($this->PageGroups['{nb3}']);
        }
    }

    function _putpages()
    {
        $nb = $this->page;
        if (!empty($this->PageGroups))
        {
            // do page number replacement
            foreach ($this->PageGroups as $k => $v)
            {
                for ($n = 1; $n <= $nb; $n++)
                {
                    $this->pages[$n] = str_replace($k, $v, $this->pages[$n]);
                }
            }
        }
        parent::_putpages();
    }

    function convertirNum($num){
        // intval(xxx) para que convierta explícitamente a int
        $n = intval($num);
        $res = '';
        // Array con los números romanos
        $roman_numerals = array('m' => 1000, 'cm' => 900, 'd' => 500, 'cd' => 400, 'c' => 100, 'xc' => 90, 'l' => 50, 'xl' => 40, 'x' => 10, 'ix' => 9, 'v' => 5, 'iv' => 4, 'i' => 1);
        foreach ($roman_numerals as $roman => $number) {
            // Dividir para encontrar resultados en array
            $matches = intval($n / $number);
            // Asignar el numero romano al resultado
            $res .= str_repeat($roman, $matches);
            // Descontar el numero romano al total
            $n = $n % $number;
        }
        // Res = String
        return $res;
    }
}

