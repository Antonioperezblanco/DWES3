<?php
class User{
    private string $nickname;
    private string $password;
    private string $email;
    private int $id;

    public function __construct(string $nickname, string $email, string $password){
        $this->nickname=$nickname;
        $this->email=$email;
        $this->password=$password;

    }

    public function getNickname(){
        return $this->nickname;
    }

    public function setNickname($nickname){
        $this->nickname = $nickname;

        return $this;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
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
        return "Nickname: $this->nickname, Email: $this->email";
    }

   
    public function setId($id){
        $this->id = $id;

        return $this;
    }
}


?>