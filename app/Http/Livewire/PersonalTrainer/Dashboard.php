<?php

namespace App\Http\Livewire\PersonalTrainer;

use App\Models\Exercise;
use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = [
        'workout-deleted' => '$refresh',
        'workout-duplicated' => '$refresh',
    ];

    public function test()
    {
        // TODO: Stripe per trasferimento
        
        //        $stripe = new StripeClient(env('STRIPE_SECRET'));
        //
        //        $amount = 100.00;
        //        $to_transfer = (($amount * 95) / 100) * 100;
        //
        //        $stripe->transfers->create([
        //            'amount' => intval($to_transfer),
        //            'currency' => 'eur',
        //            'destination' => User::find(2)->stripe_account_id,
        //            'transfer_group' => 'APPOINTMENT_1',
        //        ]);
    }

    public function render()
    {
        return view('livewire.personal-trainer.dashboard', [
            'workouts_count' => auth()->user()->personal_trainer_workouts->count(),
            'athletes' => auth()->user()->athletes,
            'assigned_workouts' => auth()->user()->personal_trainer_workouts()->assigned()->take(4)->get(),
            'not_assigned_workouts' => auth()->user()->personal_trainer_workouts()->notAssigned()->take(4)->get(),
            'exercises' => Exercise::all()
        ]);
    }
}
