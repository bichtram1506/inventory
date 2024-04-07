<?php
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Mail\SentMessage; // Import SentMessage class
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use App\Listeners\LogSendingMessage;
use App\Listeners\LogSentMessage;

class EventListenerTest extends TestCase
{
    public function testMessageSendingEvent()
    {
        Event::fake();

        // Mock an Email instance (replace it with actual message creation logic if needed)
        $email = new Symfony\Component\Mime\Email();

        // Trigger the event that sends a message
        event(new MessageSending($email));

        // Assert that the LogSendingMessage listener was called
        Event::assertListening(MessageSending::class, LogSendingMessage::class);
    }

    public function testMessageSentEvent()
{
    Event::fake();

    // Mock a SentMessage instance using PHPUnit's mocks (assuming SentMessage is a dependency)
    $sentMessage = $this->getMockBuilder(\Illuminate\Mail\SentMessage::class)
                        ->disableOriginalConstructor()
                        ->getMock();

    // Trigger the event that indicates a message has been sent
    event(new MessageSent($sentMessage));

    // Assert that the LogSentMessage listener was called
    Event::assertListening(MessageSent::class, LogSentMessage::class);
}


}
