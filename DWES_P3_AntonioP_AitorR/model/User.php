<?php
class User{
    private string $nickname;
    private string $password;

    public function __construct(string $nickname, string $password){
        $this->nickname=$nickname;
        $this->password=$password;
    }

    public function getNickname(){
        return $this->nickname;
    }

    public function setNickname($nickname){
        $this->nickname = $nickname;

        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;

        return $this;
    }
    public function __toString(){
        return "Nickname: $this->nickname";
    }
}

?>