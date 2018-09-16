<?php

namespace TravianZ\Mvc;

abstract class Model implements \SplSubject
{
    private $observers;

    private $updates = [];

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer)
    {
        if ($observer instanceof View) {
            $this->observers->attach($observer);
        }
    }

    public function detach(\SplObserver $observer)
    {
        if ($observer instanceof View) {
            $this->observers->detach($observer);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function set(array $data)
    {
        $this->updates = array_merge_recursive($this->updates, $data);
    }

    public function get(): array
    {
        return $this->updates;
    }
}
