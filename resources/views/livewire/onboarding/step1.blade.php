<div>
    <div class="prose mx-auto">
        <h1 class="pt-14 text-3xl font-bold uppercase text-fit-black">Benvenuto nell'area di registrazione personal
            trainer di fitmatch</h1>
        <p class="mt-6 text-fit-black">
            FitMatch è la piattaforma unica di gestione per i Personal Trainer e gli atleti.<br>
            Il nostro obiettivo è quello di offrire un'esperienza di qualità a tutti i nostri utenti.<br>
            Per questo motivo ogni richiesta di iscrizione viene validata dal nostro team di onboarding. I requisiti per
            richiedere l'iscrizione come Personal Trainer a FitMatch sono:
        </p>
        <ul>
            <li>1</li>
            <li>2</li>
            <li>3</li>
        </ul>
        <p class="mt-6 leading-8 text-fit-black">
            Ti chiediamo di compilare al meglio tutti i campi necessari, comprese le esperienze lavorative e
            certificazioni conseguite, in modo da accelerare il processo di Onboarding e facilitare la valutazione da
            parte del nostro Team.
        </p>
        <p class="mt-6 leading-8 text-fit-black">
            Riceverai una email con il responso della valutazione.
        </p>
        <div class="not-prose mt-10">
            <x-primary-button wire:click="next" class="!px-14">Avanti</x-primary-button>
        </div>
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
