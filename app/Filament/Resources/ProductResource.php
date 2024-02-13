<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $recordTitleAttribute = 'name';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')

                        ->required()
                        ->unique(ignoreRecord: true)
                        ->live()
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->readOnly()
                        ->required()
                        ->unique(ignoreRecord: true),
                    RichEditor::make('description')
                        ->toolbarButtons([
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])
                        ->required(),
                    Select::make('category_id')
                        ->label('Category')
                        ->required()
                        ->native(false)
                        ->relationship(name: 'category', titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->options(Category::all()->pluck('name', 'id')),
                    TextInput::make('price')
                        ->rules('integer')
                        ->tel()
                        ->required(),
                    TextInput::make('stock')
                        ->required()
                        ->rules('integer'),
                    // Radio::make('is_favorite')
                    //     ->required()
                    //     ->options([
                    //         '1' => 'Yes',
                    //         '0' => 'No',
                    //     ]),
                    FileUpload::make('image')
                        ->image()
                        ->required()
                        ->preserveFilenames()
                    // ->imageEditor()
                    // ->imageEditorAspectRatios([
                    //     '16:9',
                    //     '4:3',
                    //     '1:1',
                    //     null,
                    // ])
                    // ->imageEditorMode(2)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('price')->searchable(),
                TextColumn::make('stock')->searchable(),
                ImageColumn::make('image')
            ])
            ->filters([
                TernaryFilter::make('is_favorite')
                    ->native(false)
            ], layout: FiltersLayout::AboveContent)

            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            // 'create' => Pages\CreateProduct::route('/create'),
            // 'view' => Pages\ViewProduct::route('/{record}'),
            // 'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
