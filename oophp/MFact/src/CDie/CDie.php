<?php
/**
 * A CDie class.
 */
class CDie {
    /**
     * Properties
     */
    private $value;
    private $sides;

    /**
     * Constructor
     */
    public function __construct($sides) {
        $this->value = 0;
        $this->sides = $sides;
    }

    /**
     * Throws the dice
     */
    public function throws() {
        $this->value = rand(1, $this->sides);
    }

    /**
     * Get the value of last throw.
     */
    public function getValue() {
        return $this->value;
    }
}
