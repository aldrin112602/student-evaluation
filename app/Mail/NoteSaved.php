<?php 
namespace App\Mail;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoteSaved extends Mailable
{
    use Queueable, SerializesModels;

    public $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    public function build()
    {
        return $this->view('emails.note_saved') // Create a view for the email
            ->with(['note' => $this->note]);
    }
}
