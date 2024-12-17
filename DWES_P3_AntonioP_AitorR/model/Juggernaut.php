<?php
include_once "Character.php";
class Juggernaut extends Character{
    private float $resistance;

    public function __construct(string $type,string $name,  int $level = 0, int $numBattle = 0){
        parent::__construct($type, $name,  rand(140,200),  rand(20,30),  $level,  $numBattle);
        $this->resistance = rand(1, 4)/10;
        
    }

    public function getResistance(){
        return $this->resistance;
    }


    public function setResistance($resistance){
        $this->resistance = $resistance;
        return $this;
    }

    public function __toString(){
        return parent:: __toString() . "    Resistance: " . $this->resistance;
       }

    public function reduceDamage() {
        $reducedDamage = $this->getDamage() * $this->resistance;  
        $newHp = $this->getHp() - $reducedDamage;
        $this->setHp($newHp);
    }
    
}
?>