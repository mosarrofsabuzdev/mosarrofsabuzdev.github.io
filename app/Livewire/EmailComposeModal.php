<?php
namespace App\Livewire;

use App\Mail\NotificationMail;
use App\Models\EmailLog;
use App\Models\EmailTemplate;
use App\Models\ScheduledEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EmailComposeModal extends Component
{
    public bool $show = false;
    public ?string $to = null;
    public ?string $cc = null;
    public ?string $subject = null;
    public ?string $body = null;
    public ?string $scheduleAt = null;

    public function sendNow(): void
    {
        $this->validate(['to' => 'required|email', 'subject' => 'required|string', 'body' => 'required|string']);
        Mail::to($this->to)->cc($this->cc ?: [])->send(new NotificationMail($this->subject, $this->body));
        EmailLog::create(['to' => $this->to, 'cc' => $this->cc, 'subject' => $this->subject, 'body' => $this->body, 'sent_at' => now(), 'sent_by' => Auth::id(), 'emailable_type' => \App\Models\Lead::class, 'emailable_id' => 1]);
        $this->show = false;
        session()->flash('toast', 'Email sent successfully');
    }

    public function schedule(): void
    {
        $this->validate(['to' => 'required|email', 'subject' => 'required|string', 'body' => 'required|string', 'scheduleAt' => 'required|date']);
        ScheduledEmail::create(['to' => $this->to, 'cc' => $this->cc, 'subject' => $this->subject, 'body' => $this->body, 'scheduled_at' => $this->scheduleAt, 'created_by' => Auth::id()]);
        $this->show = false;
        session()->flash('toast', 'Email scheduled');
    }

    public function useTemplate(int $id): void
    {
        $template = EmailTemplate::findOrFail($id);
        $this->subject = $template->subject;
        $this->body = $template->body;
    }

    public function render()
    {
        return view('livewire.email-compose-modal', ['templates' => EmailTemplate::all()]);
    }
}
