<?php

// Step 1: Create the State interface with an abstract method
interface State {
    public function handle();
}

// Step 2: Concrete States implementing the State interface
class ConcreteStateA implements State {
    public function handle() {
        echo "Handling in State A\n";
        // Transition to the next state
        return new ConcreteStateB();
    }
}

class ConcreteStateB implements State {
    public function handle() {
        echo "Handling in State B\n";
        // Transition to the next state
        return new ConcreteStateA();
    }
}

// Step 3: Context Class that maintains an instance of a ConcreteState
class Context {
    private $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function request() {
        // The Context calls the handle method on the current state
        echo "Request made: ";
        $this->state = $this->state->handle();
    }
}

// Step 4: Test the State Design Pattern
// Initial state is ConcreteStateA
$context = new Context(new ConcreteStateA());

// Request that triggers the state change
for ($i = 0; $i < 5; $i++) {
    $context->request();
}

?>
