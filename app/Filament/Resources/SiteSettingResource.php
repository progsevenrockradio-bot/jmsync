<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Filament\Resources\SiteSettingResource\RelationManagers;
use App\Models\SiteSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Configuración';

    protected static ?string $modelLabel = 'Ajuste del Sitio';
    
    protected static ?string $pluralModelLabel = 'Ajustes del Sitio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key')
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Select::make('group')
                    ->options([
                        'general' => 'General',
                        'header'  => 'Cabecera / Header',
                        'footer'  => 'Pie de Página / Footer',
                        'social'  => 'Redes Sociales',
                    ])
                    ->required(),
                Select::make('type')
                    ->options([
                        'text' => 'Texto Corto',
                        'textarea' => 'Texto Largo / HTML',
                        'boolean' => 'Sí/No (Booleano)',
                    ])
                    ->required(),
                Textarea::make('value')
                    ->columnSpanFull()
                    ->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Clave')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('group')
                    ->label('Grupo')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Valor')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
