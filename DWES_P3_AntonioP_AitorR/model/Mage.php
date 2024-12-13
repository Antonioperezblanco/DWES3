<?php
include_once "./Character.php";

class Mage extends Character{
    private bool $dodge;
    private int $health;

    public function __construct(string $type,string $name, int $hp, float $damage, int $level, int $numBattle, bool $dodge, int $health){
        parent::__construct($type, $name,  $hp,  $damage,  $level,  $numBattle);

        $this->dodge=$dodge;
        $this->health=$health;
    }

    public function getDodge(){
        return $this->dodge;
    }
    public function setDodge($dodge){
        $this->dodge = $dodge;

        return $this;
    }

    public function getHealth(){
        return $this->health;
    }

    public function setHealth($health){
        $this->health = $health;

        return $this;
    }

       public function __toString(){
        return parent:: __toString() . "Dodge: " . $this->dodge ? "Yes" : "NO" . "Health: $this->health";
       }

       public function dodging(&$damage){
        $randomNumber = rand(0,1);
        if ($randomNumber == 0){
            $this->dodge = true;
            echo "You dodged the attack";
            $damage = 0;
        }else{
            $this->dodge = false;
            echo "You didn't dodge the attack";
        }
    }
    public function cure(){
    $cure = $this->health * 0.5;    
    $currentHp = $this->getHp();   
    $newHp = $currentHp + $cure; 
    
    if ($newHp > $this->health) {
        $newHp = $this->health;
    }
    
    $this->setHp($newHp);
    }
}
    $mago = new Mage("guerrero", "Aitor", 4,5,5,3,false, 100);
?>