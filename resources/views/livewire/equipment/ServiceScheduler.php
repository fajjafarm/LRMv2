<?php

namespace App\Livewire\Equipment;

use Livewire\Component;
use App\Models\Equipment;
use App\Models\ServiceSchedule;
use App\Models\User;

class ServiceScheduler extends Component
{
    public $equipment;
    public $showCreateModal = false;
    public $showLogModal = false;
    public $editingSchedule = null;

    public $nextDue, $frequency, $interval, $assignedTo, $description;
    public $completionDate, $performedBy, $details;

    public $schedules;

    protected $rules = [
        'nextDue' => 'required|date',
        'frequency' => 'required|in:monthly,quarterly,annually',
        'interval' => 'required|integer|min:1|max:12',
        'assignedTo' => 'nullable|exists:users,id',
        'description' => 'nullable|string|max:1000',
        'completionDate' => 'required|date',
        'performedBy' => 'required|exists:users,id',
        'details' => 'required|string|max:2000',
    ];

    public function mount(Equipment $equipment)
    {
        $this->equipment = $equipment;
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $this->schedules = $this->equipment->serviceSchedules()->with('completedBy')->get();
        $this->scheduledCount = $this->schedules->where('is_completed', false)->count();
        $this->completedCount = $this->schedules->where('is_completed', true)->count();
        $this->overdueCount = $this->schedules->where('is_completed', false)->where('next_due', '<', now())->count();
    }

    public function createSchedule()
    {
        $this->validate();

        ServiceSchedule::create([
            'schedulable_id' => $this->equipment->id,
            'schedulable_type' => Equipment::class,
            'title' => "Service for {$this->equipment->name}",
            'description' => $this->description,
            'frequency' => $this->frequency,
            'interval' => $this->interval,
            'next_due' => $this->nextDue,
            'assigned_to' => $this->assignedTo,
        ]);

        $this->reset(['showCreateModal', 'nextDue', 'frequency', 'interval', 'assignedTo', 'description']);
        $this->loadSchedules();
        $this->dispatch('notify', 'Service scheduled successfully!');
    }

    public function editSchedule($id)
    {
        $this->editingSchedule = ServiceSchedule::find($id);
        $this->nextDue = $this->editingSchedule->next_due->format('Y-m-d');
        $this->frequency = $this->editingSchedule->frequency;
        $this->interval = $this->editingSchedule->interval;
        $this->assignedTo = $this->editingSchedule->assigned_to;
        $this->description = $this->editingSchedule->description;
        $this->showCreateModal = true;
    }

    public function updateSchedule()
    {
        $this->validate();

        $this->editingSchedule->update([
            'next_due' => $this->nextDue,
            'frequency' => $this->frequency,
            'interval' => $this->interval,
            'assigned_to' => $this->assignedTo,
            'description' => $this->description,
        ]);

        $this->reset(['showCreateModal', 'editingSchedule', 'nextDue', 'frequency', 'interval', 'assignedTo', 'description']);
        $this->loadSchedules();
        $this->dispatch('notify', 'Service updated successfully!');
    }

    public function deleteSchedule($id)
    {
        $schedule = ServiceSchedule::find($id);
        $schedule->delete();
        $this->loadSchedules();
        $this->dispatch('notify', 'Service deleted!');
    }

    public function logService($id)
    {
        $this->editingSchedule = ServiceSchedule::find($id);
        $this->showLogModal = true;
    }

    public function logServiceConfirm()
    {
        $this->validate();

        $this->editingSchedule->update([
            'is_completed' => true,
            'last_completed' => $this->completionDate,
            'completed_by' => $this->performedBy,
            'description' => $this->details,
            'next_due' => $this->calculateNextDue($this->editingSchedule),
        ]);

        $this->reset(['showLogModal', 'completionDate', 'performedBy', 'details', 'editingSchedule']);
        $this->loadSchedules();
        $this->dispatch('notify', 'Service logged successfully!');
    }

    private function calculateNextDue($schedule)
    {
        $interval = match ($schedule->frequency) {
            'monthly' => $schedule->interval * 30,
            'quarterly' => $schedule->interval * 90,
            'annually' => $schedule->interval * 365,
            default => 0,
        };
        return now()->addDays($interval);
    }

    public function render()
    {
        return view('livewire.equipment.service-scheduler', [
            'staff' => User::where('business_id', auth()->user()->business_id)->get(),
        ]);
    }
}