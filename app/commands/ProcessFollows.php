<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessFollows extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'follows:process';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Adds a job to the queue to process the next 1000 to follows.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */

	public function __construct()
	{
		parent::__construct();
		//$this->follow = App::make('Follow');
	}


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$user_ids = Follow::where('status_code',108)->distinct()->get(['user_id']);

		foreach ( $user_ids as $user) {

		  $this->info($user['user_id']);
		  // submit the job to the queue for $user'user_id']

		}
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
