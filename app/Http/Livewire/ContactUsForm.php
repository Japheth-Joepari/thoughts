<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;


class ContactUsForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
    ];

    public function submitForm()
    {
        $this->validate();

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new \GuzzleHttp\Client(), $config);

        $sendSmtpEmail = new SendSmtpEmail([
            'to' => [['email' => 'japhethjoepariagidife@gmail.com']],
            'subject' => $this->subject,
            'htmlContent' => $this->message,
            'sender' => ['email' => $this->email, 'name' => $this->name],
        ]);

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            session()->flash('success', 'Your message has been sent successfully.');
        } catch (\Exception $e) {
            session()->flash('Hey there', 'An error occurred while sending your message. Try resending ' );
        }

            $sendSmtpEmail = new SendSmtpEmail([
            'to' => [['email' => $this->email]],
            'subject' => "Email received",
            'htmlContent' => "<p>Dear  $this->name ,</p>
                <p>Thank you for contacting us. We have received your message and will get back to you as soon as possible.</p>
                <p>Here is a copy of the message you sent:</p>
                <p> $this->message </p>
                <p>If you need further assistance, please do not hesitate to contact us again.</p>
                <p>Best regards,</p>
                <p>The Support Team</p>",
            'sender' => ['email' => 'japhethjoepariagidife@gmail.com', 'name' => "thoughts"],
        ]);

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            session()->flash('Hey there', 'We\'ve received your message thanks for reaching out we will get back to you');
        } catch (\Exception $e) {
            session()->flash('Hey there', 'An error occurred while sending your message. Try resending ' );
            //  . $e->getMessage()
        }

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.contact-us-form');
    }
}
