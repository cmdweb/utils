<?php


namespace Alcatraz\Utils;


class NumberFormat {

    public static function formatToBr($number){
        return number_format($number, 2, ',', '.');
    }

    public static function formatToSql($number) {

        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $number); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }
}