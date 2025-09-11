<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Jobs\SendNewsletterJob;
use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\SpatieTagsEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Group::make([
                Section::make()->schema([
                    Grid::make()->schema([
                        Fieldset::make('details')
                            ->schema([
                                TextEntry::make('title'),
                                TextEntry::make('slug'),
                                SpatieTagsEntry::make('tags')
                                    ->type('categories'),
                                TextEntry::make('status')
                                    ->badge(),
                            ]),
                        Fieldset::make('settings')
                            ->schema([
                                TextEntry::make('featured_at')
                                    ->date('Y-m-d H:i:s')
                                    ->label('Featured Post')
                                    ->placeholder('this post is Not featured')
                                    ->helperText('mark this post as featured'),
                            ])
                    ]),
                    TextEntry::make('content')
                        ->html()
                        ->columnSpanFull(),
                    SpatieMediaLibraryImageEntry::make('images')
                        ->collection('images')
                        ->columnSpanFull(),

                ]),
            ])->columnSpan(2),
        ])
            ->columns(3);

    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('notify_subscribers')
                ->label(__('Notify Subscribers'))
                ->icon('heroicon-o-bell')
                ->color('success')
                ->action(function () {
                    SendNewsletterJob::dispatch($this->record);
                    Notification::make()
                        ->title(__('Newsletter dispatch initiated'))
                        ->body(__('The newsletter is being sent to all subscribers.'))
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->modalHeading(__("Notify Subscribers"))
                ->modalDescription(__("this will send the post to all newsletter subscribers via email."))
        ];
    }

}
