<?php

namespace App\Messenger\Trait;

trait ObserverSubjectTrait
{
    private \SplObjectStorage $observers;

    public function attach(\SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach($this->observers as $observer){
            $observer->update($this);
        }
    }
}