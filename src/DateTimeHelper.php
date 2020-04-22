<?php


namespace Alcatraz\Utils;


class DateTimeHelper
{
    CONST format = "d/m/Y H:i:s";

    public static function now()
    {
        return self::getdate(self::format, "now");
    }

    public static function convertBr($date, $format = self::format)
    {
        if ($date == null)
            return $date;
        return self::getdate($format, $date);
    }

    public static function convertEu($date, $format = "d/m/Y")
    {
        $date = \DateTime::createFromFormat($format, $date, new \DateTimeZone('America/Sao_Paulo'));
        return $date->format("Y-m-d H:i:s");
    }

    public static function convertStringToDateBr($date, $formatIn, $formatOut)
    {
        $date = \DateTime::createFromFormat($formatIn, $date, new \DateTimeZone('America/Sao_Paulo'));
        return self::getdate($formatOut, $date->format("Y-m-d H:i:s"));
    }

    private static function getDate($format, $date)
    {
        return date($format, strtotime($date));
    }

    public static function addDays($days, $date = null)
    {
        if ($date == null)
            $date = self::now();
        return self::getDate(self::format, ($days > 0 ? '+' . $days : $days) . ' days', strtotime($date));
    }

    /**
     * @param $date
     * @return string
     * parametros de criação: http://php.net/manual/pt_BR/function.strftime.php
     *
     */
    public static function dateWritten($date, $stringReturn, $format = "Y-m-d H:i:s")
    {
        $date = \DateTime::createFromFormat($format, $date, new \DateTimeZone('America/Sao_Paulo'));
        $date = $date->format("Y-m-d H:i:s");
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        return utf8_encode(strftime($stringReturn, strtotime($date)));
    }

    public static function calcHora($entrada, $saida)
    {
        $hora1 = explode(":", $entrada);
        $hora2 = explode(":", $saida);
        $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
        $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
        $resultado = $acumulador2 - $acumulador1;
        $hora_ponto = floor($resultado / 3600);
        $resultado = $resultado - ($hora_ponto * 3600);
        $min_ponto = floor($resultado / 60);
        $resultado = $resultado - ($min_ponto * 60);
        $secs_ponto = $resultado;

        if ($hora_ponto > 0)
            return $hora_ponto . " horas " . $min_ponto . " minutos e " . $secs_ponto . ' segundos';

        return $min_ponto . " minutos e " . $secs_ponto . ' segundos';

    }

    public static function CompararData($data1, $data2)
    {
        $data1 = self::convertEu($data1);
        $data2 = self::convertEu($data2);

        return strtotime($data1) <= strtotime($data2);
    }

    public static function CalcularDiferencaDatas($data1, $data2){
        $data1 = new \DateTime(self::convertEu($data1));
        $data2 = new \DateTime(self::convertEu($data2));

        // Resgata diferença entre as datas
        $dateInterval = $data1->diff($data2);
        return $dateInterval->days;
    }
}