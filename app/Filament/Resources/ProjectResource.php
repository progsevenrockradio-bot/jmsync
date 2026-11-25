<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    protected static ?string $navigationGroup = 'Contenido';

    protected static ?string $modelLabel = 'Proyecto';

    protected static ?string $pluralModelLabel = 'Proyectos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => 
                                $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Textarea::make('excerpt')
                            ->label('Resumen / Copia corta')
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->label('Descripción Completa')
                            ->columnSpanFull(),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                Toggle::make('published')
                                    ->label('Publicado')
                                    ->default(true),
                                Toggle::make('featured')
                                    ->label('Destacado en Inicio'),
                                TextInput::make('order')
                                    ->label('Orden de aparición')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Card::make()
                            ->schema([
                                Select::make('category_id')
                                    ->label('Categoría')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),
                                TextInput::make('client')
                                    ->label('Cliente'),
                                TextInput::make('project_url')
                                    ->label('URL del Proyecto')
                                    ->url(),
                                DatePicker::make('completed_at')
                                    ->label('Fecha de Finalización'),
                            ]),

                        Card::make()
                            ->schema([
                                FileUpload::make('featured_image')
                                    ->label('Imagen Destacada')
                                    ->image()
                                    ->directory('projects'),
                                FileUpload::make('gallery')
                                    ->label('Galería de Imágenes')
                                    ->multiple()
                                    ->image()
                                    ->directory('projects/galleries'),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Imagen'),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->badge()
                    ->sortable(),
                TextColumn::make('client')
                    ->label('Cliente')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('published')
                    ->label('Publicado'),
                ToggleColumn::make('featured')
                    ->label('Destacado'),
                TextColumn::make('order')
                    ->label('Orden')
                    ->sortable(),
                TextColumn::make('completed_at')
                    ->label('Finalizado')
                    ->date('Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
