<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WorkerService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreWorkerRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class ImportWorkerFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-worker-file-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //get worker data from file
        $data = Storage::json('webform_data.json');

        //doing validation through a form request because I see this being used then as well in a REST API or other places and would want to reuse it.
        $storeWorkerRequest = new StoreWorkerRequest();
        
        foreach ($data as $worker){
            //sanitize data to get it uniform.
            $sanitizedWorkerData = WorkerService::sanitize($worker);

            //validate it
            $validator = Validator::make($sanitizedWorkerData, $storeWorkerRequest->rules(), $storeWorkerRequest->messages());

            if($validator->passes()){
                $workerService = new WorkerService;
                $valid = $validator->validated();
                $this->info("Passed id: {$valid['id']}");

                //store worker
                $save = $workerService->store($valid);
                $this->info("Saved as: {$save->id}");
            } else {
                $this->error("Failed id: {$worker['id']}");
                $this->error($validator->errors());
                //dump($validator->getData());
            }
        }
    }
}
