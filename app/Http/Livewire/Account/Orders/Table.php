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
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;
use Yepsua\Filament\Forms\Components\Rating;

class Table extends Component implements HasTable
{
	use InteractsWithTable;

	protected function getTableColumns(): array
	{
		return [
			\Filament\Tables\Columns\TextColumn::make("id")->label("#"),
			\Filament\Tables\Columns\TextColumn::make("office.name")->label("المكتب"),
			\Filament\Tables\Columns\TextColumn::make("subject")->label("الموضوع"),
			\Filament\Tables\Columns\TextColumn::make("fee")
				->label("التكلفة")
				->money("sar", true),
			\Filament\Tables\Columns\BadgeColumn::make("status")
				->label("الحالة")
				->enum([
					Order::PAID => __("orders.paid"),
					Order::UNPAID => __("orders.unpaid"),
				]),
			\Filament\Tables\Columns\TextColumn::make("created_at")
				->date()
				->label("تاريخ الإنشاء"),
		];
	}

	protected function getTableRecordActionUsing()
	{
		return fn (Order $record): string => $record->status === Order::UNPAID
			? "pay"
			: "";
	}

	protected function getTableActions(): array
	{

		return [
			Action::make("pay")
				->label("دفع")
				->mountUsing(
					fn (Forms\ComponentContainer $form, Order $record) => $form->fill([
						"orderId" => $record->id,
					])
				)
				->modalContent(function ($record) {
					return view('pages.account.orders.order-summary', [
						'amount' => $record->fee,
						'orderID' => $record->id,
						'subject' => $record->subject,
						'officeName' => $record->office->name
					]);
				})
				->modalSubmitAction(Action::makeModalAction('pay')->label('دفع')->action('pay'))
				->form([
					RadioButton::make("paymentMethod")
						->label("وصيلة الدفع")
						->options([
							"balance" => "الرصيد",
							"paypal" => "بايبال",
						])
						->descriptions([
							"balance" => "الدفع من الرصيد المتوفر في حسابك",
							"paypal" => "الدفع من خلال حسابك على باببال",
						])
						->columns(2)
						->required(),
				])->hidden(fn ($record) => $record->status === Order::PAID),
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
						Rating::make('rating')->label('تقييم')->helperText('تقييمك لجودة الخدمة من 1 الى 5.')->required(),
						TextInput::make('title')->label('عنوان التقييم'),
						Textarea::make('review')->label('نص')->required(),
					];

					if ($record->hasReview()) {
						$form[] = Hidden::make('review_id');
					}

					return $form;
				})
				->visible(fn($record): bool => $record->hasReview())
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

	public function pay()
	{

		$data = $this->mountedTableActionData;
		$orderId = $data["orderId"];
		$user = Auth::user();
		$order = Order::find($orderId);
		$office = DigitalOffice::find($order->office_id);

		$paymentMethod = $data["paymentMethod"];

		if ($paymentMethod === "balance") {
			if ($user->available_balance > $order->fee) {

				$userTxn = $user->transactions()->create([
					"amount" => $order->fee,
					"type" => "credit",
					"source" => Transaction::PAY_DUES,
					"status" => Transaction::SUCCESS,
					"metadata" => json_encode([
						"order_id" => $order->id
					])
				]);

				$user->substractFromBalance($order->fee);

				$officeTxn = $office->transactions()->create([
					"amount" => $order->fee,
					"type" => "debit",
					"source" => Transaction::RECEIVE_EARNINGS,
					"status" => Transaction::SUCCESS,
					"metadata" => json_encode([
						"order_id" => $order->id
					])
				]);

				$office->addToBalance($order->fee);

				OrderService::orderPaid($order);

				Notification::make()
					->title('مبروك ! تم دفع مستحقات الطلب بنجاح.')
					->success()
					->send();

				return redirect()->route('account.orders.index');
			} else {
				$this->addError(
					"mountedTableActionData.paymentMethod",
					"المعذرة رصيدك غير كافي. المرجو شحن حسابك."
				);
			}
		}
	}
}
