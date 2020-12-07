<?php


Breadcrumbs::for('users.dashboard', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
});

Breadcrumbs::for('users.vcard', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Virtual Cards','');
});


Breadcrumbs::for('users.profile.index', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Settings', '');
});

Breadcrumbs::for('users.profile.edit', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Settings', route('users.profile.index'));
    $trail->push('Edit Profile', '');
});

Breadcrumbs::for('users.profile.password', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Settings', route('users.profile.index'));
    $trail->push('Change password', '');
});


Breadcrumbs::for('users.profile.bank', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Settings', route('users.profile.index'));
    $trail->push('Withdrawal Settings', '');
});


