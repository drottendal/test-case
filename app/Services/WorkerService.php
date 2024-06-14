<?php

namespace App\Services;

use App\Models\Worker;
use Carbon\Carbon;
use Elegant\Sanitizer\Sanitizer;

class WorkerService
{
    public function store(array $data): Worker
    {
        $worker = new Worker();
        $worker->reference_id = $data['id'];
        $worker->email = $data['email'];
        $worker->ssn = $data['ssn'];
        $worker->phone = $data['phone'];
        $worker->first_name = $data['firstname'];
        $worker->last_name = $data['lastname'];
        $worker->dob = $data['dob'];
        $worker->salary = $data['salary'];
        $worker->employment_from = $data['employmentfrom'];
        $worker->employment_to = $data['employmentto'];
        $worker->currently_working = $data['currentlyworking'];
        $worker->save();

        return $worker;
    }

    public static function sanitize(array $data) {
        $filters = [
            'id' => 'trim|empty_string_to_null|cast:int',
            'ssn' => 'cast:string',
            'salary' => 'digit',
            'currentlyworking' => fn ($value, array $options = []) => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'employmentto' => function ($value, array $options = []) {
                try {
                    if ($value !== "" && Carbon::parse($value)) {
                        return $value;
                    }
                } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                    return null;
                }
            },
        ];
        
        $sanitizer = new Sanitizer($data, $filters);

        return $sanitizer->sanitize();
    }
}