<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Enum\TransactionStatus;
use App\Services\MaguaPay;
use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

use Illuminate\Http\RedirectResponse;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Enums\ToastType;
use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;
use MoonShine\Fields\File;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\MoonShineRequest;
use MoonShine\MoonShineUI;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use Throwable;

/**
 * @extends ModelResource<Transaction>
 */
class TransactionResource extends ModelResource
{
    protected string $model = Transaction::class;

    protected string $sortColumn = 'created_at';

    protected string $sortDirection = 'desc';

    public function title(): string
    {
        return __('moonshine::ui.titles.transactions');
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->hideOnIndex(),
                Text::make(__('First Name'), 'firstName')->hideOnUpdate(),
                Text::make(__('Last Name'), 'lastName')->hideOnUpdate(),
                BelongsTo::make(__('moonshine::ui.fields.user'), 'user', UserResource::class)->hideOnUpdate()->badge(),
                Number::make(__('moonshine::ui.fields.amount'), 'amount')->hideOnUpdate(),
                Text::make(__('moonshine::ui.fields.currency_label'), 'currency')->hideOnUpdate(),
                Enum::make(__('moonshine::ui.fields.status'), 'status')->attach(TransactionStatus::class)->hideOnUpdate(),
                Date::make(__('moonshine::ui.fields.created_at'), 'created_at')->withTime()->hideOnUpdate(),
                File::make('KYC', 'kyc')->hideOnIndex(),
            ]),
        ];
    }

    /**
     * @throws Throwable
     */
    public function detailPageComponents(): array
    {
        return [
            ActionButton::make(
                label: fn() => 'Refund',
            )
                ->icon('heroicons.outline.arrow-uturn-left')
                ->error()
                ->inModal(
                    title: fn() => 'Transaction refund',
                    content: fn() => 'Do you really want to refund this transaction?',
                    buttons: [
                        ActionButton::make('Refund')->method('sendRefundRequest', params: ['resourceItem' => $this->getItemID()] )
                    ],
                )->canSee(fn() => $this->getItem()->status == TransactionStatus::SUCCESS->value),
        ];
    }

    public function search(): array
    {
        return ['id', 'user.email'];
    }

    public function getActiveActions(): array
    {
        return ['view', 'update'];
    }

    /**
     * @param Transaction $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    public function sendRefundRequest(MoonShineRequest $request): ?RedirectResponse
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::query()->find($request->get('resourceItem'));

        if ($transaction == null) {
            MoonShineUI::toast(__('moonshine::ui.notfound'), ToastType::ERROR->value);

            return null;
        }

        // try {
        //     $magua = new MaguaPay();
        //     $magua->setTransaction($transaction);
        //     $magua->prepareRefund();
        //     $payload = $magua->send();

        //     $transaction->update(['status' => TransactionStatus::REFUND, 'payload' => json_encode($payload, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)]);

        //     MoonShineUI::toast(__('Refund request was successfully sent.'), ToastType::SUCCESS->value);
        // } catch (Exception $exception) {
        //     MoonShineUI::toast($exception->getMessage(), ToastType::ERROR->value);
        // }

        return back();
    }
}
