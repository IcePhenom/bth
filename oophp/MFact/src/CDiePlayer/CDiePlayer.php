<?php
/**
 * A CDiePlayer class.
 */
class CDiePlayer {
    /**
     * Properties.
     */
    private $score;
    private $type;

    /**
     * Constructor.
     */
    public function __construct($type) {
    	$this->score = 0;
        $this->type = $type;
    }

    /**
     * Add score to total score
     */
    public function addSum($score) {
        $this->score += $score;
    }

    /**
     * Reset player score
     */
    public function reset() {
        $this->score = 0;
    }

    /**
     * Get current player score
     */
    public function getSum() {
        return $this->score;
    }

    public function getType() {
        return $this->type;
    }
}
