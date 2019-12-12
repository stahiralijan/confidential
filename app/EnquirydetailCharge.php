<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Relations\Pivot;
	
	/**
	 * App\EnquirydetailCharge
	 *
	 * @property int                             $id
	 * @property int                             $enquiry_detail_id
	 * @property int                             $charge_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge whereChargeId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge whereEnquiryDetailId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquirydetailCharge whereUpdatedAt($value)
	 * @mixin \Eloquent
	 */
	class EnquirydetailCharge extends Pivot
	{
		protected $fillable = [
			'enquiry_detail_id',
			'charge_id',
		];
	}
