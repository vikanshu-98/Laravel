<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FirstLoginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:logicCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reverseString = $this->ask('enter the string that you want to reverse?'); 
        $length= strlen(trim($reverseString));
        $string='';
        for($i=$length-1;$i>=0;$i--) 
            $string.=$reverseString[$i];
        
        $choice = $this->choice('Do you want to check that input string is palindrone or not?',['yes','no']);
        echo "Reverse String is ".$string."\n";
        if($choice=='yes'){ 
            $status = ($string==$reverseString)?'Given String is Palindrone':'Given String is Not Palindrone';
            echo $status;
        }

    }
}
