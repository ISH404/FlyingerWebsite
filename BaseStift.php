<?php

class Vector3d {
    private float $x;
    private float $y;
    private float $z;

    public function getX : float { return $this->x; }
    public function getY : float { return $this->y; }
    public function getZ : float { return $this->z; }
}

class BasePen {
    // public string $spring;
    // public string $inkChamber; // Chamber that holds the ink.
    // public string $ballpointTip; // Top of the pen connected to the ink chamber.
    // public bool $thurstDevice; // Part at the top of the pen that you click to expose & retract the ballpoint tip.
    public string $brandName;
    public string $brandLogo;
    public string $inkColor;
    public string $housingColor;
    public string $housingCap; // Tip on the housing
    public string $housingType; // Material of the housing
    private float $remainingInk; // Remaining ink in the chamber
    private float $maxInkVolume = 100; // Maximum amount of ink the pen can hold
    private bool $capOn; // State of the tip attached to the housing
    private Vector3d $currentPosition;

    function __construct()
    {
        $this->position = new Vector3d();
    }

    public function returnPosition(){
        return $this->position;
    }

    private function putCapOn(): void{
        $this->capOn = true;
    }

    private function takeCapOff() : void {
        $this->capOn = false;
    }

    public function fillInkChamber($freshInk) : void {
        /*  If more ink is being added than the pen can hold set volume to max
         *  Excess ink is lost :)
         *  Else just add the ink to the remaining ink
         */
        if($this->remainingInk + $freshInk > $this->maxInkVolume) {
            $this->remainingInk = $this->maxInkVolume;
        } else {
            $this->remainingInk += $freshInk;
        }
    }

    public function move(array $vectorPositions) : void {
        // Check if the cap of the pen is on
        if($this->capOn) {
            $this->takeCapOff();
        }

        /*
         *  Grab the first position in the vector array and set the position of the pen to those values
         *  Afterward delete the first value from the array so the next cycle grabs the next position
         * */
        while(!empty($vectorPositions)){
            $this->currentPosition = $vectorPositions[0];
            array_shift($vectorPositions);
        }

        // Put the cap back on
        $this->putCapOn();
    }
}