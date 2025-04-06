<?php

namespace App\Http\Controllers;
use App\Mail\EvaluationMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailEvaluationController extends Controller
{
    public function notifyStudentEvaluationDone($studentEmail)
    {
        $details = [
            'subject' => 'Evaluation Complete',
            'greeting' => 'Hello ' . $studentEmail . '!',
            'message' => 'The evaluation process has already been completed. Please sign in to the site to view the evaluation results. Thank you!'
        ];

        if(Mail::to($studentEmail)->send(new EvaluationMailer($details))) {
            return true;
        }
        return false;
    }
}
