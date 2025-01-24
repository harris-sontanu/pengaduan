<?php

namespace App\Filament\Resources;

use App\Enums\PostStatus;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                ->schema([
                    Section::make()
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->columnSpanFull(),

                            RichEditor::make('body')
                                ->required()
                                ->columnSpanFull(),

                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->preload()
                                ->native('false')
                                ->searchable(),

                            Select::make('status')
                                ->live()
                                ->options(PostStatus::class)
                                ->native('false'),

                            RichEditor::make('reaseon')
                                ->requiredIf('status', PostStatus::REJECTED->value)
                                ->visible(function (Get $get) { 
                                    return $get('status') == PostStatus::REJECTED->value; 
                                })
                                ->columnSpanFull(),

                        ])
                        ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                ->schema([
                    Section::make()
                        ->schema([
                                FileUpload::make('image')
                                    ->label('Cover')
                                    ->image()
                                    ->maxSize(2048)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('body')
                    ->label('Aduan'),
                
                TextColumn::make('user.name'),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Posted At')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('updateStatus')
                        ->label('Update Status')
                        ->action(function (Collection $records, array $data): void {
                            foreach ($records as $record) {
                                $record->status = $data['status'];
                                $record->save();
                            }
                        })
                        ->form([
                            Select::make('status')
                                ->label('Status')
                                ->options(PostStatus::class)
                                ->native(false),
                        ])
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
