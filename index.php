<?php

    class BankerCaixa {
        
        // Atributos
        private $Clients = array(
            array(
                "nome"=>"João",
                "cpf"=>"001",
                "saldo"=> 56.98
            ),
            array(
                "nome"=>"Beatrix",
                "cpf"=>"002",
                "saldo"=> 56.98
            ),
            array(
                "nome"=>"Jucelia",
                "cpf"=>"003",
                "saldo"=> 56.98
            )
        );
        private $MoneyBankers;
        public $StatusServer = "none";
        private $search = false;
        private $verify = true;
        private $cpfUser = null;
        // Contrutor
        public function __construct() {
            
            if($this->StatusServer != null){
                try {
                    $this->StatusServer = "\nOnline \n\n";
                } catch (\Throwable $th) {
                    $this->StatusServer = "\nOffline 404 :( \n\n";
                }
            }
            
            $this->app();
        }

        // Get and Set 
        public function getMoneyBanker(){
            return $this->MoneyBankers;
        }
        public function setMoneyBanker($value){
            $this->MoneyBankers = $this->MoneyBankers + $value;
        }


        // Metodos
        public function app(){
            do {
                echo $this->menuApp();
                $menuOption = readline("Acessar opção: ");
                
                switch ($menuOption) {
                    case 1:
                        echo $this->StatusServer;
                        break;
                    case 2:
                        $this->Consult();
                        break;
                    case 3:
                        $this->Deposit();
                        break;
                    case 0:
                        $this->verify = false;
                        break;
                    
                    default:
                        echo "Opção inválida";
                        break;
                }

                if($this->verify == true)
                    $systemOption = readline("Deseja continuar navegando no sistema? [y] ou [n]. ");
                else
                    $systemOption = 'n';
                exec('powershell -command "Clear-Host"');

            } while ($systemOption != "n");

            
        }
        public function menuApp(){
            $menu = "
===============================\n
B  A  N  C  O     C  A  I  X  A\n
================================\n
M E N U\n\n
[1] - Status do servidor\n
[2] - Saldo\n
[3] - Depositar\n
[0] - Sair
\n\n\n";

                return $menu;
        }
        public function moneyBanker(){
            foreach($this->Clients as $key => $value){
                $this->setMoneyBanker($value);
            }

            echo $this->getMoneyBanker();
        }
        public function Consult(){
            $this->cpfUser = readline("Digite o seu CPF, por favor ");
            foreach ($this->Clients as $index => $client) {
                foreach ($client as $key => $value) {
                    if($value == $this->cpfUser)
                    {
                        $this->search = true;
                        foreach($this->Clients[$index] as $keyUser => $valueUser)
                        {
                            echo "$keyUser - $valueUser\n";
                        }
                    }
                }
            }
            if($this->search == false)
                echo "Usuário não encontrado, tente novamente.\n\n";
        }
        public function Deposit(){
            $this->Consult();

            $userDeposit = readline("Deseja depositr quantos?");
            foreach ($this->Clients as $index => $user) {
                foreach($user as $key => $value){
                    if($value == $this->cpfUser){
                        foreach ($this->Clients[$index] as $key => $value) {
                            if($key == "cpf")
                                echo $this->Clients[$index]['saldo'] = $this->Clients[$index]['saldo'] + $userDeposit."\n";

                        }
                    }
                }
            }
        }
    }

    $Banker = new BankerCaixa();
