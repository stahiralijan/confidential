<?php
	
	namespace App\Jobs\Enquiry;
	
	use Illuminate\Bus\Queueable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Foundation\Bus\Dispatchable;
	
	class CreateEnquiryJob implements ShouldQueue
	{
		use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
		
		private $enqruiry = [];
		
		/**
		 * Create a new job instance.
		 *
		 * @param array $enqruiryElements
		 */
		public function __construct(array $enqruiryElements)
		{
			$this->enqruiry = $enqruiryElements;
		}
		
		/**
		 * Execute the job.
		 *
		 * @return void
		 */
		public function handle()
		{
		
		}
	}
