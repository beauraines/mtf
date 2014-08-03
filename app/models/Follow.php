<?php


class Follow extends Eloquent  {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'follows';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('id');
	public $timestamps = true;

	protected $fillable =array('twitter_id','screenname',
				  'follow_date','unfollow_date',
				  'filename','user_id');




}
