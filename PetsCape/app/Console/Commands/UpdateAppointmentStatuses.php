<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateAppointmentStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of past appointments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating appointment statuses...');
        
        // Update confirmed appointments to completed
        $confirmedCount = Appointment::where('status', 'confirmed')
            ->where('date_time', '<', Carbon::now())
            ->update(['status' => 'completed']);
        
        $this->info("Updated $confirmedCount confirmed appointments to completed.");
        
        // Update pending appointments to expired
        $pendingCount = Appointment::where('status', 'pending')
            ->where('date_time', '<', Carbon::now())
            ->update(['status' => 'expired']);
        
        $this->info("Updated $pendingCount pending appointments to expired.");
        
        $this->info('Appointment statuses updated successfully.');
        
        return Command::SUCCESS;
    }
} 