<?php
// app/Mail/ConfirmationCommandeMail.php
namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationCommandeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $total;

    public function __construct(Commande $commande,mixed $total)
    {
        $this->commande = $commande;
        $this->total=$total;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre commande')
                    ->markdown('emails.commande.confirmation');
    }
}
