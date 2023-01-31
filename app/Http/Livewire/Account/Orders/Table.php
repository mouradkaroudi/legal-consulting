<?php

namespace App\Http\Livewire\Account\Orders;

use App\Models\Order;
use App\Models\User;
use Digikraaft\ReviewRating\Models\Review;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;
use Yepsua\Filament\Forms\Components\Rating;

class Table extends Component implements HasTable
{
	use InteractsWithTable, AuthorizesRequests;

	public $paymentMethod;

	protected function getTableColumns(): array
	{
		return [
			\Filament\Tables\Columns\TextColumn::make("id")->label("#"),
			\Filament\Tables\Columns\TextColumn::make("office.name")
				->label(__('Name')),
			\Filament\Tables\Columns\TextColumn::make("subject")->label(
				__('Subject')
			),
			\Filament\Tables\Columns\TextColumn::make("fee")
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
				->action(function ($record) {
					$data = $this->mountedTableActionData;
					$paymentMethod = $data["paymentMethod"];
					$params = ['order_id' => $record->id];
					return redirect()->route('payment.' . $paymentMethod . '.order', ['params' => $params]);
				})
				->form(function ($record) {
					return [
						Forms\Components\Grid::make(2)->schema([
							Forms\Components\Placeholder::make('paymentForm')
								->label('')
								->content(view('pages.account.orders.order-summary', [
									'amount' => $record->fee,
									'orderID' => $record->id,
									'subject' => $record->subject,
									'officeName' => $record->office->name
								])),
							RadioButton::make("paymentMethod")
								->label(__('Payment method'))
								->options([
									"balance" => __('Balance'),
									"paypal" => __('PayPal'),
									"bank-transfer" => __('Bank transfer'),
								])
								->descriptions([])
								->columns(1)
								->required(),
						]),
						Forms\Components\Checkbox::make('agree')
							->label('أوافق على شروط إستخدام الموقع.')
							->required()
					];
				})
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
					}
				})
				->label(fn ($record): string => $record->hasReviewed(auth()->user()) ? __('Edit review') : __('Add review'))
				->action(function (Order $record, array $data): void {

					if (isset($data['review_id']) && !empty($data['review_id'])) {

						Review::find($data['review_id'])->update([
							'rating' => $data['rating'],
							'title' => $data['title'],
							'review' => $data['review'],
						]);
					} else {
						$record->review($data['review'], User::find(auth()->user()->id), $data['rating'], $data['title']);
					}

					Notification::make()
						->title(__('The review was successfully added'))
						->success()
						->send();
				})
				->form(function ($record) {

					$form = [
						Rating::make('rating')->label('تقييم')->helperText('تقييمك لجودة الخدمة من 1 الى 5.'),
						TextInput::make('title')->label('عنوان التقييم'),
						Textarea::make('review')->label('نص')->required(),
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
		return Order::latest()
			->where('beneficiary_id', auth()->user()->id);
	}

	public function render()
	{
		return view("livewire.office.orders.table");
	}
}
