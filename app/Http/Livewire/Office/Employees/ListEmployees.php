<?php

namespace App\Http\Livewire\Office\Employees;

use App\Models\DigitalOfficeEmployee;
use Livewire\Component;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ListEmployees extends Component implements Tables\Contracts\HasTable
{
  use Tables\Concerns\InteractsWithTable;

  public $officeId = 0;

  protected function getTableQuery(): Builder
  {
    return DigitalOfficeEmployee::query()->where('office_id', $this->officeId)->with("user");
  }

  public function render()
  {
    return view("livewire.office.employees.list-employees");
  }

  protected function getTableActions(): array
  {

    return [
      Tables\Actions\ActionGroup::make([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ]),
    ];
  }

  protected function getTableColumns(): array
  {
    return [
      Tables\Columns\TextColumn::make("user_id")->label("معرف المستخدم"),
      Tables\Columns\TextColumn::make("user.name")->label("الاسم"),
      Tables\Columns\TextColumn::make("job_title")->label("مسمى وظيفي"),
    ];
  }
}
