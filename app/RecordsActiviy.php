<?php 
namespace App;

use App\Activity;

trait RecordsActivity{

	protected static function getActivitesToRecord(){

		return ['created'];
	}

	protected static function bootRecordsActivity(){
		
		if( auth()->guest()) return;

		foreach (static::getActivitesToRecord() as $event) {
		static::$event(function($model) use ($event){

			$model->recordActivity($event);
		});
		}

	}

	public function recordActivity($event){

		$this->activity()->create([
	                'type'=>$this->getActivityType($event),

	                'user_id'=>auth()->id(),
		]);
	}
	public function activity(){

		return $this->morphMany('App\Activity','subject');
	}

	public function getActivityType($event){

		return $event . '_' .strtolower( (new \ReflectionClass($this))->getShortName() );
	}
}