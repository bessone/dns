<?php

use Spatie\Dns\Support\Types;

beforeAll(function () {
    // Define DNS type constants not available in PHP by default
    // @see https://bugs.php.net/bug.php?id=65343
    define('DNS_DS', 2097152);
    define('DNS_DNSKEY', 4194304);
});

beforeEach(function () {
    $this->types = new Types;
});

it('can transform flag to name', function () {
    expect($this->types->toNames(DNS_A))->toBe([DNS_A => 'A']);
    expect($this->types->toNames(DNS_AAAA))->toBe([DNS_AAAA => 'AAAA']);
    if (defined('DNS_CAA')) {
        expect($this->types->toNames(DNS_CAA))->toBe([DNS_CAA => 'CAA']);
    }
    expect($this->types->toNames(DNS_CNAME))->toBe([DNS_CNAME => 'CNAME']);
    expect($this->types->toNames(DNS_MX))->toBe([DNS_MX => 'MX']);
    expect($this->types->toNames(DNS_NS))->toBe([DNS_NS => 'NS']);
    expect($this->types->toNames(DNS_PTR))->toBe([DNS_PTR => 'PTR']);
    expect($this->types->toNames(DNS_SOA))->toBe([DNS_SOA => 'SOA']);
    expect($this->types->toNames(DNS_SRV))->toBe([DNS_SRV => 'SRV']);
    expect($this->types->toNames(DNS_TXT))->toBe([DNS_TXT => 'TXT']);
    expect($this->types->toNames(DNS_DS))->toBe([DNS_DS => 'DS']);
    expect($this->types->toNames(DNS_DNSKEY))->toBe([DNS_DNSKEY => 'DNSKEY']);
});

it('can transform flags to names', function () {
    expect($this->types->toNames(DNS_A | DNS_AAAA))->toBe([DNS_A => 'A', DNS_AAAA => 'AAAA']);
    expect($this->types->toNames(DNS_NS | DNS_SOA))->toBe([DNS_NS => 'NS', DNS_SOA => 'SOA']);
});

it('can transform name to flag', function () {
    expect($this->types->toFlags(['A']))->toBe(DNS_A);
    expect($this->types->toFlags(['AAAA']))->toBe(DNS_AAAA);
    if (defined('DNS_CAA')) {
        expect($this->types->toFlags(['CAA']))->toBe(DNS_CAA);
    }
    expect($this->types->toFlags(['CNAME']))->toBe(DNS_CNAME);
    expect($this->types->toFlags(['MX']))->toBe(DNS_MX);
    expect($this->types->toFlags(['NS']))->toBe(DNS_NS);
    expect($this->types->toFlags(['PTR']))->toBe(DNS_PTR);
    expect($this->types->toFlags(['SOA']))->toBe(DNS_SOA);
    expect($this->types->toFlags(['SRV']))->toBe(DNS_SRV);
    expect($this->types->toFlags(['TXT']))->toBe(DNS_TXT);
    expect($this->types->toFlags(['DS']))->toBe(DNS_DS);
    expect($this->types->toFlags(['DNSKEY']))->toBe(DNS_DNSKEY);
});

it('can transform names to flags', function () {
    expect($this->types->toFlags(['A', 'AAAA']))->toBe(DNS_A | DNS_AAAA);
    expect($this->types->toFlags(['NS', 'SOA']))->toBe(DNS_NS | DNS_SOA);
    expect($this->types->toFlags(['A', 'aaAA', 'cname']))->toBe(DNS_A | DNS_AAAA | DNS_CNAME);
});
