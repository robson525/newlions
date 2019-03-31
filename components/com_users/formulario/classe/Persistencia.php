<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persistencia
 *
 * @author Robson
 */
class Persistencia {
    
    const STRING = 1;
    const INT = 2;
    const PK = 3;
    const FK = 4;
    const BOOLEAN = 5;
    const BIT = 6;
    
    
    public static function prepare($var = '' , $tipo = 1){
        
        if($tipo == self::STRING){
            $var = self::remove($var);
            return empty($var) ? 'NULL' : "'".$var."'";
        }
        elseif($tipo == self::INT){
            return is_numeric($var) ? $var : ($var === '0' ? '0' : 'NULL');
        }
        elseif($tipo == self::PK){
            return (is_numeric($var) && $var > 0) ? $var : 0;
        }
        elseif($tipo == self::FK){
            return (is_numeric($var) && $var > 0) ? $var : ( ($var === false || $var === null || $var < 0) ?  'NULL' : (int)$var);
        }
        elseif($tipo == self::BOOLEAN){
            return ($var === '0' || $var === 0 || $var === false ) ? "'0'" :  ( $var ? "'1'" : 'NULL' );
        }
        elseif($tipo == self::BIT){
            return ($var === '0' || $var === 0 || $var === false ) ? "'0'" :  ( $var ? "'1'" : 'NULL' );
        }
    }
    
    private static function remove($var = ''){
        return str_ireplace(array('=','*', 'from', 'where'), '', $var);
    }
    
}
