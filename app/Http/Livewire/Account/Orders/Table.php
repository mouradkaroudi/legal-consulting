<?php

namespace App\Http\Livewire\Account\Orders;

use App\Models\Order;
use App\Models\User;
use App\Services\RatingService;
use Digikraaft\ReviewRating\Models\Review;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Yepsua\Filament\Forms\Components\Rating;

class Table extends Component implements HasTable
{
	use InteractsWithTable, AuthorizesRequests;

	public $rating;

	protected function getTableColumns(): array
	{
		return [
			\Filament\Tables\Columns\TextColumn::make("id")->label("#"),
			\Filament\Tables\Columns\TextColumn::make("office.name")
				->label(__('Name')),
			\Filament\Tables\Columns\TextColumn::make("subject")->label(
				__('Subject')
			),
			\Filament\Tables\Columns\TextColumn::make("amount")
				->label(__('Amount'))
				->money("sar", true),
			\Filament\Tables\Columns\BadgeColumn::make("status")
				->label(__('Status'))
				->enum([
					Order::PAID => __("orders.paid"),
					Order::UNPAID => __("orders.unpaid"),
				]),
			\Filament\Tables\Columns\TextColumn::make("created_at")
				->label(__('Created at'))
				->date(),
		];
	}

	protected function getTableActions(): array
	{
		return [
			Action::make("pay")
				->label(__('Pay'))
				->url(fn ($record) => route('account.orders.pay', ['order' => $record->id]))
				->button()
				->color('success')
				->hidden(fn ($record) => $record->status === Order::PAID),
			Action::make('add_review')
				->mountUsing(function (Forms\ComponentContainer $form, Order $record) {
					if ($record->hasReview()) {
						$form->fill([
							"rating" => $record->latestReview()->rating,
							"title" => $record->latestReview()->title,
							"review" => $record->latestReview()->review,
							"review_id" => $record->latestReview()->id,
						]);
					}else{
						$form->fill([
							"rating" => 0
						]);
					}
				})
				->label(fn ($record): string => $record->hasReviewed(auth()->user()) ? __('Edit review') : __('Add review'))
				->action(function (Order $record, array $data): void {

					$review_id = $data['review_id'] ?? '';

					$review = $data['review'];
					$rating = $data['rating'];
					$title = $data['title'];

					if (isset($review_id) && !empty($review_id)) {
						RatingService::updateReview(
							Review::find($review_id),
							[
								'rating' => $rating,
								'title' => $title,
								'review' => $review,
							]
						);

						Notification::make()
							->title(__('The review was successfully updated'))
							->success()
							->send();
					} else {
						RatingService::createOrderReview($record, User::find(auth()->user()->id), [
							'rating' => $rating,
							'title' => $title,
							'review' => $review
						]);
						Notification::make()
							->title(__('The review was successfully added'))
							->success()
							->send();
					}
				})
				->form(function ($record) {

					$form = [
						Rating::make('rating')
							->label(__('Review'))
							->helperText(__('Your rating for quality of service from 1 to 5'))
							->required()
							,
						TextInput::make('title')
							->label(__('Review title')),
						Textarea::make('review')
							->label(__('Text'))
							->required(),
					];

					if ($record->hasReview()) {
						$form[] = Hidden::make('review_id');
					}

					return $form;
				})
				->visible(fn ($record): bool => $record->status === Order::PAID)
		];
	}

	protected function getTableQuery(): Builder
	{
		return Order::where('beneficiary_id', auth()->user()->id)->latest();
	}

	public function render()
	{
		return view("livewire.office.orders.table");
	}
}
