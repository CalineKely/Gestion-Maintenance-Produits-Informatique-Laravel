<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FicheResource\Pages;
use App\Filament\Resources\FicheResource\RelationManagers;
use App\Models\Fiche;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FicheResource extends Resource
{
    protected static ?string $model = Fiche::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Gestion de Maintenance';

    public static function form(Form $form): Form
    {
       
    
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship(name:'client', titleAttribute:'nom')
                    ->required(),
                    Forms\Components\Select::make('materiel_id')
                    ->relationship(name:'materiel', titleAttribute:'description')                  
                    ->required(),
                Forms\Components\TextInput::make('probleme')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_depot')
                    ->required(),
                Forms\Components\DatePicker::make('date_recup')
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('materiel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('probleme')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_depot')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_recup')
                    ->date()
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFiches::route('/'),
            'create' => Pages\CreateFiche::route('/create'),
            'view' => Pages\ViewFiche::route('/{record}'),
            'edit' => Pages\EditFiche::route('/{record}/edit'),
        ];
    }
}
