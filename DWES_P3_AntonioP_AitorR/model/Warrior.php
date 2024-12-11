<?php

class Warrior extends Character{
    private string $weapon;

    public function __construct(string $type,string $name, int $hp, float $damage, int $level, int $numBattle, string $weapon){
        parent::__construct($type, $name,  $hp,  $damage,  $level,  $numBattle);
        $this->weapon = $weapon;

        
    }

    public function getWeapon(){
        return $this->weapon;
    }

    public function setWeapon($weapon){
        $this->weapon = $weapon;

        return $this;
    }

    public function __toString(){
        return parent:: __toString() . "Weapon: . $this->weapon";
       }

    public function aumentarDaño(){
        if ($this->weapon=="espada"){
            $newDamage = $this->getDamage()*1.2;
            $this->setDamage($newDamage);
        }else{
            $newHp = $this->getHp()* 1.2;
            $this->setHp($newHp);

        }
    }
}