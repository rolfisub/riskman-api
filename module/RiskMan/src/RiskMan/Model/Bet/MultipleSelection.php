<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RiskMan\Model\Bet;
use RiskMan\Model\ModelObject;
/**
 * SELECT `multipleselection`.* FROM `multipleselection` WHERE `book_id` = '2' AND `multiple_id` = '1' AND `event_id` = '3' AND `odd_id` = '3' AND `odd_selection_id` = '6' AND `multiple_selection_id` = 'ms2' AND `multiple_selection_id` != 'ms3'
 */

/**
 * Description of Event
 *
 * @author rolf
 */
class MultipleSelection extends ModelObject
{
    
    public function checkForExistingPick($msi, $m, $e, $o, $os) 
    {
        $s = $this->sql->select();
        $where = [
            'multiple_id' => $m,
            'event_id' => $e,
            'odd_id' => $o,
            'odd_selection_id' => $os,
            'book_id' => $this->book_id
        ];
        $s->where($where);
        $s->where($s->where->notEqualTo('multiple_selection_id', $msi));
        $s->limit(1);
        $result = $this->getArrayFrom($s);
        if(isset($result[0])){
            return $result[0];
        } else {
            return false;
        }
    }
}
