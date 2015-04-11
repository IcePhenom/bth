<?php
/**
 * A CDieGame class.
 */
class CDieGame {
    /**
     * Properties.
     */
    private $die;
    private $round;
    private $nbrPlayers;
    private $act;
    private $players;
    private $game;

    /**
     * Constructor.
     */
    public function __construct($nbrPlayer=1, $dieSides=6) {
        $this->die = new CDie($dieSides);
        $this->round = 0;
        $this->act = 0;
        $this->players = array();
        if($nbrPlayer == -1){
            $this->nbrPlayers = 2;
            $this->players[0] = new CDiePlayer("Human");
            $this->players[1] = new CDiePlayer("Bot");
        }
        else{
            $this->nbrPlayers = $nbrPlayer;
            for ($i=0; $i < $nbrPlayer; $i++)
                $this->players[$i] = new CDiePlayer("Human ".($i+1));
        }
    }

    /**
     * Throws the dice.
     */
    private function throws() {
        return (($this->players[$this->act]->getType() == "Bot")? self::pcThrows() : self::humanThrows());
    }

    private function pcThrows() {
        $nbrThrows = 0;
        $maxThrows = 5;

        $x = abs($this->players[$this->act]->getSum()-100)/10;
        $rand = 2*$x+10;

        $html = "<p><a href='?throw'>Throw</a> | <a href='?reset'>Reset</a></p>";

        if(($i = self::checkWin()) != -1){
            $html = "<p><a href='?reset'>Reset</a></p>
                    <p>Winner Winner Chicken Dinner</p>
                    <p>Winner: ".$this->players[$i]->getType()."</p>";
        }
        while($this->round < $rand && $nbrThrows < $maxThrows){
            $this->die->throws();
            if($this->die->getValue() == 1){
                $html .= "<p>Computer threw 1, turn score reset. Your turn</p>";
                $this->round = 0;
                self::nextPlayer();
                return $html;
            }
            else
                $this->round += $this->die->getValue();

            $nbrThrows++;
        }
        $html .= "<p>Computer threw ".$this->round.".</p>";

        self::save();
        return $html;
    }


    private function humanThrows() {
        $this->die->throws();
        $html = "<p><a href='?throw'>Throw</a> | <a href='?save'>Save score</a> | <a href='?reset'>Reset</a></p>
                <p>Turn: ".$this->players[$this->act]->getType()."</p>
                <div class='dice dice-{$this->die->getValue()}'></div>";

        if(($i = self::checkWin()) != -1){
            $html = "<p><a href='?reset'>Reset</a></p>
                    <p>Winner Winner Chicken Dinner</p>
                    <p>Winner: ".$this->players[$i]->getType()."</p>";
        }
        elseif($this->die->getValue() == 1){
            $html .= (($this->nbrPlayers == 1)? "<p>Die value = 1, score reset.</p>" : "<p>Die value = 1, turn score reset. Next player turn</p>");
            self::nextPlayer();
            $this->round = 0;
        }
        else{
            $this->round += $this->die->getValue();
            $html .= "<p>Current score: ".$this->round."</p>";
        }

        return $html;
    }

    private function checkWin(){
        for ($i=0; $i < $this->nbrPlayers; $i++)
            if($this->players[(int)$i]->getSum() > 99)
                return $i;

        return -1;
    }

    private function nextPlayer() {
        $this->act++;
        if($this->act == $this->nbrPlayers)
            $this->act = 0;
    }

    private function save() {
        $this->players[$this->act]->addSum($this->round);
        $this->round = 0;
        self::nextPlayer();
    }

    /**
     * Reset game.
     */
    private function resetGame() {
        $this->round = 0;
        for ($i=0; $i < $this->nbrPlayers; $i++)
            $this->players[$i]->reset();
    }

    private function session() {
        if(isset($_SESSION['game'])){
            $this->game = $_SESSION['game'];
        }
        else{
            if(isset($_GET['nbrPlayer'])){
                $this->game = new self((int)$_GET['nbrPlayer'], 6);
                $_SESSION['game'] = $this->game;
            }
            else if(isset($_GET['pc'])){
                $this->game = new self(-1, 6);
                $_SESSION['game'] = $this->game;
            }
        }
    }

    public function show(){
        $display = "";
        session_name('game');

        self::session(); //handle session

        if(isset($_SESSION['game'])){
            if(isset($_GET['save'])){
                $this->game->save();
            }
            elseif(isset($_GET['reset'])){
                $this->game->resetGame();
                unset($_SESSION['game']);
                session_destroy();
                header("location:dice.php");
            }

            $display .= $this->game->throws();
        }
        else{
            $display .= "<p>Tärningsspelet 100 är ett enkelt, men roligt, tärningsspel. Det gäller att samla ihop poäng för att komma först till 100. I varje omgång kastar en spelare tärning tills den väljer att stanna och spara poängen eller tills det dyker upp en 1:a och den förlorar alla poäng som samlats in i rundan.</p>";
            $display .= "<p>Select game mode</p><p><a href='?nbrPlayer=1'>1 player</a> | <a href='?nbrPlayer=2'>2 players</a> | <a href='?pc'>vs PC</a></p>";
        }
        return $display;
    }

    public function side(){
        $display = "Status";
        if(isset($_SESSION['game'])){
            $display = "<div><ul>";
            for ($i=0; $i < $this->game->nbrPlayers; $i++)
                $display .= "<li>Total score: ".$this->game->players[$i]->getType().": ".$this->game->players[(int)$i]->getSum()."</li>";

            $display .= "</ul></div>";
        }

        return $display;
    }
}
