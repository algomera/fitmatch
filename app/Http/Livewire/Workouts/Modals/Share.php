<?php

namespace App\Http\Livewire\Workouts\Modals;

use App\Models\Workout;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Spatie\Browsershot\Browsershot;

class Share extends ModalComponent
{
    public Workout $workout;
    public $sharing_method = 'pdf';
    public $to = '';

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function share()
    {
        if ($this->sharing_method === 'pdf') {
            // Genera PDF e avvia salvataggio
            $filename = Str::uuid().'.pdf';
            Browsershot::html(view('livewire.workouts.pdf', [
                'workout' => $this->workout->id,
                'workout_weeks' => $this->workout->workout_weeks()->whereHas('workout_days')->get()
            ])->render())
                ->paperSize(210, 297)
                ->margins(3, 3, 3, 3)
                ->showBackground()
                ->savePdf($filename);
            $this->closeModal();
            return response()->download($filename)->deleteFileAfterSend();

        } elseif ($this->sharing_method === 'email') {
            // Genera PDF, inserisci allegato e invia alla email impostata
            $this->validate([
                'to' => 'required|email'
            ], [
                'to.required' => 'Il campo è richiesto.',
                'to.email' => 'Il campo deve essere un indirizzo valido.'
            ]);
            $filename = Str::uuid().'.pdf';
            Browsershot::html(view('livewire.workouts.pdf', [
                'workout' => $this->workout->id,
                'workout_weeks' => $this->workout->workout_weeks()->whereHas('workout_days')->get()
            ])->render())
                ->paperSize(210, 297)
                ->margins(3, 3, 3, 3)
                ->showBackground()
                ->savePdf($filename);

            $temp_path = public_path($filename);
            Mail::html(
                "Ciao,<br>In allegato trovi la tua scheda di allenamento!<br><br>A presto,<br>".auth()->user()->fullname,
                function ($message) use (
                    $temp_path,
                    $filename
                ) {
                    $message->to($this->to)
                        ->subject('La tua scheda di allenamento')
                        ->attach($temp_path, [
                            'as' => $filename,
                            'mime' => 'application/pdf',
                        ]);
                });
            unlink($temp_path);
            $this->closeModal();
            $this->dispatchBrowserEvent('open-notification', [
                'title' => __('Scheda inviata'),
                'subtitle' => __("La scheda è stata inviata con successo!"),
                'type' => 'success'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.workouts.modals.share');
    }
}
