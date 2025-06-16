<?php

return [
    'navigation' => [
        'menu' => 'Navigation Menu',
        'items' => [
            'dashboard' => 'Dashboard',
            'users' => 'Users',
            'planes' => 'Planes',
            'flights' => 'Flights',
            'tickets' => 'Tickets',
            'graphs' => 'Graphs',
            'history' => 'History',

        ],
    ],
    'user_menu' => [
        'settings' => 'Settings',
        'logout' => 'Log out',
    ],
    'auth' => [
        'failed' => 'These credentials do not match our records.',
        'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    ],
    'settings' => [
        'title' => 'Settings',
        'description' => 'Manage your profile and account settings',
        'navigation' => [
            'profile' => 'Profile',
            'password' => 'Password',
            'appearance' => 'Appearance',
            'languages' => 'Languages',
        ],
        'profile' => [
            'title' => 'Profile settings',
            'information_title' => 'Profile information',
            'information_description' => 'Update your name and email address',
            'name_label' => 'Name',
            'name_placeholder' => 'Full name',
            'email_label' => 'Email address',
            'email_placeholder' => 'Email address',
            'unverified_email' => 'Your email address is unverified.',
            'resend_verification' => 'Click here to resend the verification email.',
            'verification_sent' => 'A new verification link has been sent to your email address.',
            'save_button' => 'Save',
            'saved_message' => 'Saved',
        ],
        'password' => [
            'title' => 'Password settings',
            'update_title' => 'Update password',
            'update_description' => 'Ensure your account is using a long, random password to stay secure',
            'current_password_label' => 'Current password',
            'current_password_placeholder' => 'Current password',
            'new_password_label' => 'New password',
            'new_password_placeholder' => 'New password',
            'confirm_password_label' => 'Confirm password',
            'confirm_password_placeholder' => 'Confirm password',
            'save_button' => 'Save password',
            'saved_message' => 'Saved',
        ],
        'appearance' => [
            'title' => 'Appearance settings',
            'description' => 'Update your account\'s appearance settings',
            'modes' => [
                'light' => 'Light',
                'dark' => 'Dark',
                'system' => 'System'
            ]
        ],
        'languages' => [
            'title' => 'Language settings',
            'description' => 'Change your preferred language',
        ],
    ],
    'validation' => [
           'required' => 'The :attribute field is required.',
            'email' => 'The :attribute field must be a valid email address.',
            'min' => [
                'string' => 'The :attribute field must be at least :min characters.',
            ],
            'max' => [
                'string' => 'The :attribute field must not be greater than :max characters.',
            ],
            'unique' => 'The :attribute has already been taken.',
            'confirmed' => 'The :attribute confirmation does not match.',
    ],
    'common' => [
        'buttons' => [
            'cancel' => 'Cancel',
            'delete' => 'Delete',
            'close' => 'Close',
        ],
        'filters'=> [
            'title' => 'Filters',
            'clear' => 'Clear',
            'results' => 'Number of results: '
        ],
        'delete_dialog' => [
            'success' => 'User deleted successfully',
        ],
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
            'first' => 'First',
            'last' => 'Last',
        ],
        'per_page' => 'Per page',
        'no_results' => 'No results',
    ],
    'users' => [
        'title' => 'Users',
        'description' => 'Manage the users of the system',
        'create' => 'Create User',
        'edit' => 'Edit User',
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_optional' => 'Password (optional)',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'columns' => [
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'filters' => [
            'search' => 'Search',
            'name' => 'User name',
            'email' => 'User email',
        ],
        'placeholders' => [
            'name' => 'User name',
            'email' => 'User email',
            'password' => 'User password',
            'search' => 'Search users...',
        ],
        'buttons' => [
            'new' => 'New User',
            'edit' => 'Edit',
            'save' => 'Save',
            'update' => 'Update',
            'cancel' => 'Cancel',
            'delete' => 'Delete',
            'deleting' => 'Deleting...',
            'saving' => 'Saving...',
            'retry' => 'Retry',
        ],
        'delete' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The user will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The user will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting user',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading users. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
        'role' => [
            'main' => 'Main role',
            'select' => 'Select a role',
            'admin' => 'Admin',
            'client' => 'Client',
        ],
        'permissions' => [
            'title' => 'Specific permissions',
            'users' => [
                'title' => 'Users',
                'view' => 'View users',
                'create' => 'Create users',
                'edit' => 'Edit users',
                'delete' => 'Delete users'
            ],
            'products' => [
                'title' => 'Products',
                'view' => 'View products',
                'create' => 'Create products',
                'edit' => 'Edit products',
                'delete' => 'Delete products'
            ],
            'reports' => [
                'title' => 'Reports',
                'view' => 'View reports',
                'export' => 'Export reports',
                'print' => 'Print reports'
            ],
            'config' => [
                'title' => 'Configuration',
                'access' => 'Access configuration',
                'modify' => 'Modify configuration'
            ]
        ],
        'history'=>[
            'title'=>'History',
            'ticket' => 'Use has bought a ticket for flight ',
            'origin' => 'With origin  ',
            'destination' => 'And destination  '

        ]
    ],
     'planes'=>[
        'title'=>'Planes',
        'description' => 'Manage the planes of the system',
        'create' => 'Create Plane',
        'edit' => 'Edit Plane',
        'fields' => [
            'code' => 'Code',
            'capacity' => 'Capacity',
            'actions' => 'Actions',
        ],
        'columns' => [
            'code' => 'Plane code',
            'capacity' => 'Plane capacity',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'placeholders' => [
            'code' => 'Plane code',
            'capacity' => 'Plane capacity',
            'created_at' => 'Created at',
            'search' => 'Search planes...',
        ],
        'filters' => [
            'search' => 'Search',
            'code' => 'Plane code',
            'capacity' => 'Plane capacity',
            'created_at' => 'Created at',
        ],
        'buttons' => [
            'new' => 'New Plane',
            'edit' => 'Edit',
            'save' => 'Save',
            'update' => 'Update',
            'cancel' => 'Cancel',
            'delete' => 'Delete',
            'deleting' => 'Deleting...',
            'saving' => 'Saving...',
            'retry' => 'Retry',
        ],
        'delete' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The plane will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The plane will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting plane',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading planes. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'flights'=>[
        'title'=>'Flights',
        'description' => 'Manage the flights of the system',
        'create' => 'Create Floor',
        'edit' => 'Edit Floor',
        'fields' => [
            'code' => 'Flight code',
            'plane' => 'Plane',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'price' => 'Price',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'date' => 'Date',
            'state' => [
                'name' => 'State',
                'draft' => 'Draft',
                'waiting' => 'Waiting',
                'full' => 'Full',
                'travelling' => 'Travelling'
            ],
            'actions' => 'Actions',
        ],
        'columns' => [
            'code' => 'Flight code',
            'plane' => 'Plane',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'price' => 'Price',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'date' => 'Date',
            'state' => [
                'name' => 'State',
                'draft' => 'Draft',
                'waiting' => 'Waiting',
                'full' => 'Full',
                'travelling' => 'Travelling'
            ],
            'created_at' => 'Created at',
            'actions' => 'Acciones',
        ],
        'placeholders' => [
            'code' => 'Flight code',
            'plane' => 'Plane',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'price' => 'Price',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'date' => 'Date',
            'state' => [
                'name' => 'State',
                'draft' => 'Draft',
                'waiting' => 'Waiting',
                'full' => 'Full',
                'travelling' => 'Travelling'
            ],
            'created_at' => 'Created at',
            'search' => 'Search flights...',
        ],
        'filters' => [
            'search' => 'Search',
            'code' => 'Flight code',
            'plane' => 'Plane',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'price' => 'Price',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'date' => 'Date',
            'state' => [
                'name' => 'State',
                'draft' => 'Draft',
                'waiting' => 'Waiting',
                'full' => 'Full',
                'travelling' => 'Travelling'
            ],
            'created_at' => 'Created at',
        ],
        'buttons' => [
            'new' => 'New Flight',
            'edit' => 'Edit',
            'save' => 'Save',
            'update' => 'Update',
            'cancel' => 'Cancel',
            'delete' => 'Delete',
            'deleting' => 'Deleting...',
            'saving' => 'Saving...',
            'retry' => 'Retry',
        ],
        'delete' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The flight will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The flight will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting flight',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading flights. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'tickets'=>[
        'title'=>'Tickets',
        'description' => 'Manage the tickets of the system',
        'create' => 'Create Ticket',
        'edit' => 'Edit Ticket',
        'fields' => [
            'user' => 'User',
            'flight' => 'Flight',
            'date' => 'Date',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'actions' => 'Actions',
        ],
        'columns' => [
            'user' => 'User',
            'flight' => 'Flight',
            'date' => 'Date',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'placeholders' => [
            'user' => 'User',
            'flight' => 'Flight',
            'date' => 'Date',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'created_at' => 'Created at',
            'search' => 'Search flights...',
        ],
        'filters' => [
            'search' => 'Search',
            'user' => 'User',
            'flight' => 'Flight',
            'date' => 'Date',
            'seats' => [
                'name' => 'Seats',
                '1st' => 'First class',
                '2nd' => 'Second class',
                'tourist' => 'Tourist',
            ],
            'created_at' => 'Created at',
        ],
        'buttons' => [
            'new' => 'New Ticket',
            'edit' => 'Edit',
            'save' => 'Save',
            'update' => 'Update',
            'cancel' => 'Cancel',
            'delete' => 'Delete',
            'deleting' => 'Deleting...',
            'saving' => 'Saving...',
            'retry' => 'Retry',
        ],
        'delete' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The ticket will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The ticket will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting ticket',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading tickets. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'graphs'=>[
        'title'=>'Graphs',
        'description'=>'App graphs',
        'options'=>[
            'user'=>'Most active users',
            'flight'=>'Flight with more purchases',
        ],
        'totalActions'=>'Total actions',
        'ticketsCount'=>'Amount of purchases',


    ]
];
