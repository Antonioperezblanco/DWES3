<?php
class Juggernaut extends Character{
    private int $resistance;

    public function __construct(string $type,string $name, int $hp, float $damage, int $level, int $numBattle, string $resistance){
        parent::__construct($resistance);
        $this->resistance = $resistance;
        
    }

    public function getResistance(){
        return $this->resistance;
    }


    public function setResistance($resistance){
        $this->resistance = $resistance;

        return $this;
    }

    public function __toString(){
        return parent:: __toString() . "resistance: . $this->resistance";
       }

    public function reduceDamage($damage) {
        $reducedDamage = $damage * 0.8;  
        $newHp = $this->getHp() - $reducedDamage;
        $this->setHp($newHp);
    }
    
}

?>