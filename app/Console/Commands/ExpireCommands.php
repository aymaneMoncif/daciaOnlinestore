<?php

namespace App\Console\Commands;

use App\Models\Commande;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire commands older than 24 hours and unpaid';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $twentyFourHoursAgo = Carbon::now()->subHours(24);

        // Find commandes without a related aport
        $commandsWithoutAport = Commande::select('commandes.*')
            ->leftJoin('aports', 'commandes.id', '=', 'aports.commande_id')
            ->whereNull('aports.commande_id')
            ->where('commandes.created_at', '<', $twentyFourHoursAgo)
            ->get();

        $userWithoutAport = Commande::select('commandes.*')
            ->leftJoin('aports', 'commandes.client_id', '=', 'aports.client_id')
            ->whereNull('aports.client_id')
            ->where('commandes.created_at', '<', $twentyFourHoursAgo)
            ->get();

        if($userWithoutAport){
            foreach ($userWithoutAport as $command) {
                // Update Status_commande in Commande table
                $command->update(['Status_commande' => 'expired']);
        
                // Update status in Stock table based on n_chassis
                $stockId = $command->n_chassis;
                if ($stockId) {
                    $stock = Stock::find($stockId);
                    if ($stock) {
                        $stock->update(['status' => '']);
                    }
                }
        
                // Log or print details of each successful update
                $this->info("Command ID: $command->id, Status: $command->Status_commande, Stock ID: $stockId");
            }
        }

        if($commandsWithoutAport){
            foreach ($commandsWithoutAport as $command) {
                // Update Status_commande in Commande table
                $command->update(['Status_commande' => 'expired']);

                // Update status in Stock table based on n_chassis
                $stockId = $command->n_chassis;
                if ($stockId) {
                    $stock = Stock::find($stockId);
                    if ($stock) {
                        $stock->update(['status' => '']);
                    }
                }

                // Log or print details of each successful update
                $this->info("Command ID: $command->id, Status: $command->Status_commande, Stock ID: $stockId");
            }
        }
        

        $this->info('done');
    }


}
