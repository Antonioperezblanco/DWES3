<?php
include_once "./Character.php";

class Mage extends Character{
    private bool $dodge;
    private int $health;

    public function __construct(string $type,string $name, int $level = 0, int $numBattle = 0){
        parent::__construct($type, $name,  rand(60,100), rand(40,60),  $level,  $numBattle);

        $this->dodge=(rand(0,1)) ? true : false;
        $this->health=rand(10,30);
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
        if ($this->dodge){
            $damage = 0;
            echo "Mage dodged the attack!";
        }
    }
    public function cure(){
        
    $currentHp = $this->getHp();   
    $newHp = $currentHp + $this->health; 
    
    if ($newHp > $this->health) {
        $newHp = $this->health;
    }
    
    $this->setHp($newHp);
    }
}
$m = new Mage ("mage", "carlos");
echo $m;
?>