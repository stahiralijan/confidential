<?php
	
	namespace App\Jobs\Penalties;
	
	use App\Penalty;
	use Illuminate\Bus\Queueable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Foundation\Bus\Dispatchable;
	
	class CreatePenaltyJob implements ShouldQueue
	{
		use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
		
		private $penaltyElements;
		
		/**
		 * Create a new job instance.
		 *
		 * @param array $validatedPenaltyElements
		 */
		public function __construct(array $validatedPenaltyElements)
		{
			$this->penaltyElements = $validatedPenaltyElements;
		}
		
		/**
		 * Execute the job.
		 *
		 * @return void
		 */
		public function handle()
		{
			Penalty::create([
								'penalty_type_id' => $this->penaltyElements['penalty_type_id'],
								'name'            => $this->penaltyElements['name'],
								'description'     => $this->penaltyElements['description'],
							]);
		}
	}
