<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Gender;
use App\Models\Institute;
use App\Models\Program;
use App\Models\Quota;
use App\Models\Rank;
use App\Models\SeatType;
use Cache;
use Closure;
use DB;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SearchByInstitute extends Component implements HasTable
{
    use InteractsWithTable;

    public function getTableQuery(): Builder
    {
        return Rank::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('institute.id')
                ->label('Institute')
                ->sortable(),
            TextColumn::make('course.id')
                ->label('Course')
                ->sortable(),
            TextColumn::make('program.id')
                ->label('Program')
                ->sortable(),
            TextColumn::make('quota.id')
                ->label('Quota')
                ->sortable(),
            TextColumn::make('seat_type.id')
                ->label('Seat Type')
                ->sortable(),
            TextColumn::make('gender.id')
                ->label('Gender'),
            TextColumn::make('year')
                ->label('Year')
                ->sortable(),
            TextColumn::make('round')
                ->label('Round')
                ->sortable(),
            TextColumn::make('opening_rank')
                ->label('Opening Rank')
                ->sortable(),
            TextColumn::make('closing_rank')
                ->label('Closing Rank')
                ->sortable(),
        ];
    }

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }

    protected function getTableFilters(): array
    {
        return [
            Filter::make('institute_id')
                ->label('Institute')
                ->form([
                    Grid::make(4)->schema([
                        CheckboxList::make('institute_type')
                            ->label('Institute Types')
                            ->options([
                                'iit' => 'IITs',
                                'nit' => 'NITs',
                                'iiit' => 'IIITs',
                                'gfti' => 'GFTIs',
                            ])->columns([
                                'default' => 2,
                                'sm' => 2,
                                'md' => 2,
                                'lg' => 2,
                                'xl' => 2,
                                '2xl' => 2,
                            ])
                            ->afterStateUpdated(function (Closure $get, Closure $set) {
                                $set('institute_id', null);
                            }),
                        MultiSelect::make('institute_id')
                            ->options(function (Closure $get) {
                                if ($get('institute_type')) {
                                    return Cache::rememberForever(implode('_', $get('institute_type')).'_institutes', fn () => Institute::whereIn('type', $get('institute_type'))->get()->pluck('id', 'id'));
                                } else {
                                    return Cache::rememberForever('institutes', fn () => Institute::all()->pluck('id', 'id'));
                                }
                            })
                            ->label('Institute')
                            ->afterStateUpdated(function (Closure $set) {
                                $set('course_id', null);
                                $set('program_id', null);
                            })->reactive(),
                        MultiSelect::make('course_id')
                            ->options(function (Closure $get) {
                                if ($get('institute_id')) {
                                    return DB::table('institute_course_program')->whereIn('institute_id', $get('institute_id'))->get()->pluck('course_id', 'course_id');
                                } else {
                                    return Cache::rememberForever('allCourses', fn () => Course::all()->pluck('id', 'id'));
                                }
                            })
                            ->label('Course')
                            ->afterStateUpdated(function (Closure $set) {
                                $set('program_id', null);
                            })
                            ->hidden(function (Closure $get) {
                                return ! $get('institute_id');
                            })
                            ->reactive(),
                        MultiSelect::make('program_id')
                            ->options(function (Closure $get) {
                                if ($get('institute_id') && $get('course_id')) {
                                    return DB::table('institute_course_program')->whereIn('institute_id', $get('institute_id'))->whereIn('course_id', $get('course_id'))->get()->pluck('program_id', 'program_id');
                                } else {
                                    return Cache::rememberForever('allPrograms', fn () => Program::all()->pluck('id', 'id'));
                                }
                            })->hidden(function (Closure $get) {
                                return ! $get('institute_id') || ! $get('course_id');
                            })
                            ->label('Program')
                            ->reactive(),
                    ]),
                ])
            ->query(function (Builder $query, array $data): Builder {
                $query = $query->when($data['institute_type'], function (Builder $query, $institute_type) {
                    return $query->whereIn('institute_id', Cache::rememberForever(implode('_', $institute_type).'_institutes', fn () => Institute::whereIn('type', $institute_type)->get()->pluck('id', 'id')));
                });

                return $query->when($data['institute_id'], function (Builder $query, $institute_id) use ($data) {
                    return $query->when($data['course_id'], function (Builder $query, $course_id) use ($data) {
                        return $query->when($data['program_id'], function (Builder $query, $program_id) {
                            return $query->whereIn('program_id', $program_id);
                        })->whereIn('course_id', $course_id);
                    })->whereIn('institute_id', $institute_id);
                });
            }),
            Filter::make('quota_filters')
                ->form([
                    Grid::make(3)->schema([
                        MultiSelect::make('quota_id')
                            ->options(Cache::rememberForever('allQuotas', fn () => Quota::all()->pluck('id', 'id')))
                            ->label('Quota'),
                        Select::make('seat_type_id')
                            ->options(Cache::rememberForever('allSeatTypes', fn () => SeatType::all()->pluck('id', 'id')))
                            ->label('Seat Type'),
                        MultiSelect::make('gender_id')
                            ->options(Cache::rememberForever('allGenders', fn () => Gender::all()->pluck('id', 'id')))
                            ->label('Gender'),
                    ]),
                ])
            ->query(function (Builder $query, array $data): Builder {
                $query = $query->when($data['quota_id'], function (Builder $query, $quota_id) {
                    return $query->whereIn('quota_id', $quota_id);
                });
                $query = $query->when($data['seat_type_id'], function (Builder $query, $seat_type_id) {
                    return $query->where('seat_type_id', $seat_type_id);
                });

                return $query->when($data['gender_id'], function (Builder $query, $gender_id) {
                    return $query->whereIn('gender_id', $gender_id);
                });
            }),
            Filter::make('closing_rank')
                ->label('Rank range')
                ->form([
                    Grid::make([
                        'default' => 2,
                        'sm' => 2,
                        'md' => 2,
                        'lg' => 2,
                        'xl' => 2,
                        '2xl' => 2,
                    ])->schema([
                        TextInput::make('minimum_rank')
                            ->label('Minimum Rank')
                            ->placeholder('Minimum Rank'),
                        TextInput::make('maximum_rank')
                            ->label('Maximum Rank')
                            ->placeholder('Maximum Rank'),
                    ]),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['minimum_rank'], fn ($query, $minimumRank) => $query->where('closing_rank', '>=', $minimumRank))
                        ->when($data['maximum_rank'], fn ($query, $maximumRank) => $query->where('closing_rank', '<=', $maximumRank));
                }),
        ];
    }

    protected function getTableFiltersFormColumns(): int
    {
        return 1;
    }

    public function render()
    {
        return view('livewire.search-by-institute');
    }
}
