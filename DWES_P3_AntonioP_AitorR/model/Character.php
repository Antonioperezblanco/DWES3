<?php
abstract class Character{
    private string $type;
    private string $name;
    private int $hp;
    private float $damage;
    private int $level;
    private int $numBattle;

    public function __construct(string $type,string $name, int $hp, float $damage, int $numBattle,  int $level = 0){
        $this->type=$type;
        $this->name=$name;
        $this->hp=$hp;
        $this->damage=$damage;
        $this->level=$level;
        $this->numBattle=$numBattle;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;

        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;

        return $this;
    }

    public function getHp(){
        return $this->hp;
    }

    public function setHp($hp){
        $this->hp = $hp;

        return $this;
    }

    public function getDamage(){
        return $this->damage;
    }

    public function setDamage($damage){
        $this->damage = $damage;

        return $this;
    }

    public function getLevel(){
        return $this->level;
    }

    public function setLevel($level){
        $this->level = $level;

        return $this;
    }

    public function getNumBattle(){
        return $this->numBattle;
    }

    public function setNumBattle($numBattle){
        $this->numBattle = $numBattle;

        return $this;
    }
    
    public function __toString(){
        return "Type: $this->type, Name: $this->name, HP: $this->hp, Damage: $this->damage, Level: $this->level, Number of Battle: $this->numBattle";
    }

    function levelUp(){

        if($this->numBattle %5==0){
            $newLevel = $this->level++;
            $this->setLevel($newLevel);
            
        }

    }
    function increaseDamage(){
        if ($this->level < 5) {
            $newDamage = $this->damage * 1.1;
            $this->setDamage($newDamage);
        } elseif ($this->level >= 5 && $this->level < 10){
            $newDamage = $this->damage * 1.2;
            $this->setDamage($newDamage);
        } else{
            $newDamage = $this->damage * 1.4;
            $this->setDamage($newDamage);
        }
    
    }
}

?>