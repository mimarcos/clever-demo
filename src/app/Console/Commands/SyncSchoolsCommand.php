<?php
namespace App\Console\Commands;

require 'libs/clever-php/lib/Clever.php';

use Exception;
use Log;
use Illuminate\Console\Command;

use Clever;
use CleverDistrict;

class SyncSchoolsCommand extends Command
{
  protected $signature = "sync:schools {token} {districtId} {--stdout}";
  protected $description = "Delete all posts";

  public function handle()
  {
    if ($this->option('stdout')) {
      $stdouthandler = new \Monolog\Handler\StreamHandler('php://stdout', 'info');
      Log::pushHandler($stdouthandler);  
    }

    $page = 0;
    $lastId = null;

    Clever::setToken($this->argument('token'));
    $district = CleverDistrict::retrieve($this->argument('districtId'));

    try {
      do {
        $stamp = date('Y-m-d H:i:s');
        $page++;
        Log::info("Making Clever call for student details [starting: {$lastId}, page: {$page}]... ");
        $students = $district->students(array('starting_after' => $lastId));
        
        if ( !empty($students) ) {
          Log::info('...students retrieved ['.count($students).']');

          foreach ( $students as $student ) {
            // do something
          }

          // get the id from the last record (for new paging logic in Clever)
          $lastId = $student->id;
        } else {
          Log::info("...no more students to be retrieved.");
        }
      } while ( count($students) > 0);
    } catch(Exception $e) {
      throw $e;
    }
  }
}











