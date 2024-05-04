<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterielResource\Pages;
use App\Filament\Resources\MaterielResource\RelationManagers;
use App\Models\Materiel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterielResource extends Resource
{
    protected static ?string $model = Materiel::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('prix')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('date_fin_garantie')
                    ->required(),
                Forms\Components\DatePicker::make('date_fin_services_apres_vente')
                    ->required(),
                    Forms\Components\Select::make('client_id')
                    ->relationship(name:'client', titleAttribute:'nom')
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prix')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin_garantie')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin_services_apres_vente')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMateriels::route('/'),
            'create' => Pages\CreateMateriel::route('/create'),
            'edit' => Pages\EditMateriel::route('/{record}/edit'),
        ];
    }
}
