<?php

namespace App\Http\Livewire\Account\Orders;

use App\Models\DigitalOffice;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Services\OrderService;
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
use Yepsua\Filament\Forms\Components\Rating;

class Table extends Component implements HasTable
{
	use InteractsWithTable;

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
				->label("دفع")
				->modalContent(function ($record) {
					return view('pages.account.orders.order-summary', [
						'amount' => $record->fee,
						'orderID' => $record->id,
						'subject' => $record->subject,
						'officeName' => $record->office->name
					]);
				})
				->modalActions([])
				->modalSubmitAction(fn() => null)
				//->modalSubmitAction(Action::makeModalAction('pay')->label('دفع')->action('pay'))
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
				->label(fn ($record): string => $record->hasReviewed(auth()->user()) ? 'تعديل التقييم' : 'أضف تقييم')
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
						->title('تم اضافة التقييم بنجاح.')
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
		return Order::where("beneficiary_id", Auth::id())->latest();
	}

	public function render()
	{
		return view("livewire.office.orders.table");
	}

}
