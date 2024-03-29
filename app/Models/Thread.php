<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Thread extends Model
{
	use HasFactory;

	/**
	 * The attributes that can be set with Mass Assignment.
	 *
	 * @var array
	 */
	protected $fillable = ["subject"];


	/**
	 * Messages relationship.
	 *
	 * @return HasMany
	 *
	 * @codeCoverageIgnore
	 */
	public function messages()
	{
		return $this->hasMany(Message::class, "thread_id", "id");
	}

	/**
	 * Returns the latest message from a thread.
	 *
	 * @return ?Message
	 */
	public function getLatestMessageAttribute()
	{
		return $this->messages()
			->latest()
			->first();
	}

	/**
	 * Participants relationship.
	 *
	 * @return HasMany
	 *
	 * @codeCoverageIgnore
	 */
	public function participants()
	{
		return $this->hasMany(Participant::class, "thread_id", "id");
	}

	/**
	 * Sender relationship
	 */
	public function sender()
	{
		return $this->morphTo();
	}

	/**
	 * Receiver relationship
	 */
	public function receiver()
	{
		return $this->morphTo();
	}

	/**
	 * Office relationship.
	 *
	 * @return HasMany
	 *
	 * @codeCoverageIgnore
	 */
	public function office()
	{
		return $this->hasOne(DigitalOffice::class, "id", "office_id");
	}

	/**
	 * The owner of thread.
	 *
	 * @return HasOne
	 *
	 * @codeCoverageIgnore
	 */
	public function owner()
	{
		return $this->hasOne(User::class, "id", "user_id");
	}

	/**
	 * User's relationship.
	 *
	 * @return BelongsToMany
	 *
	 * @codeCoverageIgnore
	 */
	public function users()
	{
		return $this->belongsToMany(
			User::class,
			"participants",
			"thread_id",
			"user_id"
		)
			// ->whereNull('participants' . '.deleted_at')
			->withTimestamps();
	}

	/**
	 * Returns the user object that created the thread.
	 *
	 * @return null|Models::user()|\Illuminate\Database\Eloquent\Model
	 */
	public function creator()
	{
		if ($this->creatorCache == null) {
			$firstMessage = $this->messages()
				->oldest()
				->first();
			$this->creatorCache = $firstMessage ? $firstMessage->user : User::class;
		}

		return $this->creatorCache;
	}

	/**
	 * Returns all the latest threads by updated_at date.
	 *
	 * @return Builder|static
	 */
	public static function getAllLatest()
	{
		return static::latest("updated_at");
	}

	/**
	 * Returns all threads by subject.
	 *
	 * @param string $subject
	 *
	 * @return Collection|static[]
	 */
	public static function getBySubject($subject)
	{
		return static::where("subject", "like", $subject)->get();
	}

	/**
	 * Returns an array of user ids that are associated with the thread.
	 *
	 * @param mixed $userId
	 *
	 * @return array
	 */
	public function participantsUserIds($userId = null)
	{
		$users = $this->participants()
			->select("user_id")
			->get()
			->map(function ($participant) {
				return $participant->user_id;
			});

		if ($userId !== null) {
			$users->push($userId);
		}

		return $users->toArray();
	}

	/**
	 * Returns threads that the user is associated with.
	 *
	 * @param Builder $query
	 * @param mixed $userId
	 *
	 * @return Builder
	 */
	public function scopeForUser(Builder $query, $user)
	{
		return $query
			->whereHasMorph('sender', $user::class)
			->where('sender_id', $user->id);
	}

	/**
	 * Returns threads that the user is associated with.
	 *
	 * @param Builder $query
	 * @param mixed $userId
	 *
	 * @return Builder
	 */
	public function scopeForOffice(Builder $query, $office)
	{
		return $query
			->whereHasMorph('receiver', $office::class)
			->where('receiver_id', $office->id);
	}

	/**
	 * Returns threads that the user is associated with.
	 *
	 * @param Builder $query
	 * @param mixed $userId
	 *
	 * @return Builder
	 */
	public function scopeForModel(Builder $query, $model)
	{
		return $query
			->whereHasMorph('sender', $model::class)
			->orWhereHasMorph('receiver', $model::class)
			->where('sender_id', $model->id)
			->orWhere('receiver_id', $model->id);
	}

	/**
	 * Returns threads with new messages that the user is associated with.
	 *
	 * @param Builder $query
	 * @param mixed $userId
	 *
	 * @return Builder
	 */
	public function scopeForUserWithNewMessages(Builder $query, $userId)
	{
		$participantTable = "participants";
		$threadsTable = "threads";

		return $query
			->join(
				$participantTable,
				$this->getQualifiedKeyName(),
				"=",
				$participantTable . ".thread_id"
			)
			->where($participantTable . ".user_id", $userId)
			->whereNull($participantTable . ".deleted_at")
			->where(function (Builder $query) use ($participantTable, $threadsTable) {
				$query
					->where(
						$threadsTable . ".updated_at",
						">",
						$this->getConnection()->raw(
							$this->getConnection()->getTablePrefix() .
								$participantTable .
								".last_read"
						)
					)
					->orWhereNull($participantTable . ".last_read");
			})
			->select($threadsTable . ".*");
	}

	/**
	 * Returns threads between given user ids.
	 *
	 * @param Builder $query
	 * @param array $participants
	 *
	 * @return Builder
	 */
	public function scopeBetweenOnly(Builder $query, array $participants)
	{
		return $query->whereHas("participants", function (Builder $builder) use (
			$participants
		) {
			return $builder
				->whereIn("user_id", $participants)
				->groupBy("participants.thread_id")
				->select("participants.thread_id")
				->havingRaw("COUNT(participants.thread_id)=?", [count($participants)]);
		});
	}

	/**
	 * Returns threads between given user ids.
	 *
	 * @param Builder $query
	 * @param array $participants
	 *
	 * @return Builder
	 */
	public function scopeBetween(Builder $query, array $participants)
	{
		return $query->whereHas("participants", function (Builder $q) use (
			$participants
		) {
			$q->whereIn("user_id", $participants)
				->select($this->getConnection()->raw("DISTINCT(thread_id)"))
				->groupBy("thread_id")
				->havingRaw("COUNT(thread_id)=" . count($participants));
		});
	}

	/**
	 * Add users to thread as participants.
	 *
	 * @param mixed $userId
	 *
	 * @return void
	 */
	public function addParticipant($userId)
	{
		$userIds = is_array($userId) ? $userId : func_get_args();

		collect($userIds)->each(function ($userId) {
			Participant::firstOrCreate([
				"user_id" => $userId,
				"thread_id" => $this->id,
			]);
		});
	}

	/**
	 * Remove participants from thread.
	 *
	 * @param mixed $userId
	 *
	 * @return void
	 */
	public function removeParticipant($userId)
	{
		$userIds = is_array($userId) ? $userId : func_get_args();

		participant::where("thread_id", $this->id)
			->whereIn("user_id", $userIds)
			->delete();
	}

	/**
	 * Mark a thread as read for a user.
	 *
	 * @param mixed $userId
	 *
	 * @return void
	 */
	public function markAsRead($model)
	{
		try {
			$participant = $this->getParticipantFromModel($model);
			$participant->last_read = new Carbon();
			$participant->save();
		} catch (ModelNotFoundException $e) {
			// @codeCoverageIgnore
			// do nothing
		}
	}

	/**
	 * See if the current thread is unread by the user.
	 *
	 * @param mixed $userId
	 *
	 * @return bool
	 */
	public function isUnread($model)
	{
		try {
			$participant = $this->getParticipantFromModel($model);

			if (
				$participant->last_read == null ||
				$this->updated_at->gt($participant->last_read)
			) {
				return true;
			}
		} catch (ModelNotFoundException $e) {
			// @codeCoverageIgnore
			// do nothing
		}

		return false;
	}

	/**
	 * Finds the participant record from a user id.
	 *
	 * @param mixed $userId
	 *
	 * @return mixed
	 *
	 * @throws ModelNotFoundException
	 */
	public function getParticipantFromModel($model)
	{
		return $this->participants()
			->whereHasMorph('model', $model::class)
			->where('model_id', $model->id)
			->firstOrFail();
	}

	/**
	 * Restores only trashed participants within a thread that has a new message.
	 * Others are already active participants.
	 *
	 * @return void
	 */
	public function activateAllParticipants()
	{
		$participants = $this->participants()->get();
		foreach ($participants as $participant) {
			$participant->restore();
		}
	}

	/**
	 * Generates a string of participant information.
	 *
	 * @param mixed $userId
	 * @param array $columns
	 *
	 * @return string
	 */
	public function participantsString($userId = null, $columns = ["name"])
	{
		$participantsTable = "participants";
		$usersTable = "users";
		$userPrimaryKey = (new User())->getKeyName();

		$selectString = $this->createSelectString($columns);

		$participantNames = $this->getConnection()
			->table($usersTable)
			->join(
				$participantsTable,
				$usersTable . "." . $userPrimaryKey,
				"=",
				$participantsTable . ".user_id"
			)
			->where($participantsTable . ".thread_id", $this->id)
			->select($this->getConnection()->raw($selectString));

		if ($userId !== null) {
			$participantNames->where(
				$usersTable . "." . $userPrimaryKey,
				"!=",
				$userId
			);
		}

		return $participantNames->implode("name", ", ");
	}

	/**
	 * Checks to see if a user is a current participant of the thread.
	 *
	 * @param mixed $userId
	 *
	 * @return bool
	 */
	public function hasParticipant($userId)
	{
		$participants = $this->participants()->where("user_id", "=", $userId);

		return $participants->count() > 0;
	}

	/**
	 * Generates a select string used in participantsString().
	 *
	 * @param array $columns
	 *
	 * @return string
	 */
	protected function createSelectString($columns)
	{
		$dbDriver = $this->getConnection()->getDriverName();
		$tablePrefix = $this->getConnection()->getTablePrefix();
		$usersTable = "users";

		switch ($dbDriver) {
			case "pgsql":
			case "sqlite":
				$columnString = implode(
					" || ' ' || " . $tablePrefix . $usersTable . ".",
					$columns
				);
				$selectString =
					"(" . $tablePrefix . $usersTable . "." . $columnString . ") as name";

				break;
			case "sqlsrv":
				$columnString = implode(
					" + ' ' + " . $tablePrefix . $usersTable . ".",
					$columns
				);
				$selectString =
					"(" . $tablePrefix . $usersTable . "." . $columnString . ") as name";

				break;
			default:
				$columnString = implode(
					", ' ', " . $tablePrefix . $usersTable . ".",
					$columns
				);
				$selectString =
					"concat(" .
					$tablePrefix .
					$usersTable .
					"." .
					$columnString .
					") as name";
		}

		return $selectString;
	}

	/**
	 * Returns array of unread messages in thread for given user.
	 *
	 * @param mixed $userId
	 *
	 * @return Collection
	 */
	public function unreadMessages($model)
	{
		$messages = $this->messages()
			->whereHasMorph(
				'model',
				$model::class
			)
			->where("model_id", "!=", $model->id)
			->get();

		try {
			$participant = $this->getParticipantFromModel($model);
		} catch (ModelNotFoundException $e) {
			return collect();
		}

		if (!$participant->last_read) {
			return $messages;
		}

		return $messages->filter(function ($message) use ($participant) {
			return $message->updated_at->gt($participant->last_read);
		});
	}

	/**
	 * Returns array of unread office messages in thread for given user.
	 *
	 * @param mixed $userId
	 *
	 * @return Collection
	 */
	/*
	public function userUnreadOfficeMessages($userId, $officeId)
	{
		$messages = $this->where("office_id", $officeId)
			->messages()
			->where("user_id", "!=", $userId)
			->get();

		try {
			$participant = $this->getParticipantFromModel($userId);
		} catch (ModelNotFoundException $e) {
			return collect();
		}

		if (!$participant->last_read) {
			return $messages;
		}

		return $messages->filter(function ($message) use ($participant) {
			return $message->updated_at->gt($participant->last_read);
		});
	}
	*/
	/**
	 * Returns count of unread office messages in thread for given user.
	 *
	 * @param mixed $userId
	 *
	 * @return int
	 */
	public function userUnreadOfficeMessagesCount($userId, $officeId)
	{
		return $this->userUnreadOfficeMessages($userId, $officeId)->count();
	}

	/**
	 * Returns count of unread messages in thread for given user.
	 *
	 * @param mixed $userId
	 *
	 * @return int
	 */
	public function userUnreadMessagesCount($userId)
	{
		return $this->userUnreadMessages($userId)->count();
	}
}
