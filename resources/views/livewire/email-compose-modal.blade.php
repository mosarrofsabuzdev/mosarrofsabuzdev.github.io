<div>
    <button wire:click="$set('show', true)" class="px-3 py-2 bg-[#2563EB] text-white rounded-lg text-sm">Send Email</button>
    @if($show)
        <x-modal-panel>
            <h3 class="font-semibold text-lg mb-3">Compose Email</h3>
            <div class="space-y-3">
                <input wire:model="to" type="email" placeholder="To" class="w-full rounded-lg border-slate-200" />
                <input wire:model="cc" type="text" placeholder="CC" class="w-full rounded-lg border-slate-200" />
                <select class="w-full rounded-lg border-slate-200" wire:change="useTemplate($event.target.value)"><option value="">Template</option>@foreach($templates as $template)<option value="{{ $template->id }}">{{ $template->name }}</option>@endforeach</select>
                <input wire:model="subject" type="text" placeholder="Subject" class="w-full rounded-lg border-slate-200" />
                <textarea wire:model="body" rows="6" class="w-full rounded-lg border-slate-200" placeholder="Body"></textarea>
                <input wire:model="scheduleAt" type="datetime-local" class="w-full rounded-lg border-slate-200" />
            </div>
            <div class="mt-4 flex justify-end gap-2"><button wire:click="$set('show', false)" class="px-3 py-2 rounded-lg bg-slate-100">Cancel</button><button wire:click="schedule" class="px-3 py-2 rounded-lg bg-amber-500 text-white">Schedule</button><button wire:click="sendNow" class="px-3 py-2 rounded-lg bg-[#2563EB] text-white">Send now</button></div>
        </x-modal-panel>
    @endif
</div>
