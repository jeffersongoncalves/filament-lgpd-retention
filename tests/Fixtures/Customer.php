<?php

namespace JeffersonGoncalves\Filament\LgpdRetention\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Lgpd\Attributes\PersonalData;
use JeffersonGoncalves\Lgpd\Concerns\InteractsWithPersonalData;
use JeffersonGoncalves\Lgpd\Contracts\HasPersonalData;
use JeffersonGoncalves\Lgpd\Enums\AnonymizeStrategy;

#[PersonalData('name', retention: '1 year', anonymize: AnonymizeStrategy::Mask)]
#[PersonalData('email', retention: '1 year', anonymize: AnonymizeStrategy::Hash)]
class Customer extends Model implements HasPersonalData
{
    use InteractsWithPersonalData;

    protected $guarded = [];
}
