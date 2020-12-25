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
    $trail->push('Settings', route('users.settings.index'));
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

//New
Breadcrumbs::for('users.settings.index', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Settings', '');
});

Breadcrumbs::for('users.settings.pin', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Settings', route('users.settings.index'));
    $trail->push('Pin', '');
});

Breadcrumbs::for('users.purchase.category', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Purchase', '');
    $trail->push('Bill', '');
});

Breadcrumbs::for('users.create.bill', function ($trail) {
    $trail->push('Home', route('users.dashboard'));
    $trail->push('Create', '');
    $trail->push('Bill', '');
});




