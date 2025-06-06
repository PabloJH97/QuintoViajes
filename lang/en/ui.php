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
            'floors' => 'Floors',
            'zones' => 'Zones',
            'bookshelves' => 'Bookshelves',
            'books' => 'Books',
            'loans' => 'Loans',
            'reservations' => 'Reservations',
            'repository' => 'Repository',
            'documentation' => 'Documentation',
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
            'seats' => 'Seats',
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
            'seats' => 'Seats',
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
            'seats' => 'Seats',
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
            'seats' => 'Seats',
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
            'actions' => 'Actions',
        ],
        'columns' => [
            'user' => 'User',
            'flight' => 'Flight',
            'date' => 'Date',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'placeholders' => [
            'user' => 'User',
            'flight' => 'Flight',
            'date' => 'Date',
            'created_at' => 'Created at',
            'search' => 'Search flights...',
        ],
        'filters' => [
            'search' => 'Search',
            'user' => 'User',
            'flight' => 'Flight',
            'date' => 'Date',
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
    'genres'=>[
        'names'=>[
            'classic_literature' => 'Classic literature',
            'sci-fi' => 'Science fiction',
            'medieval' => 'Medieval',
            'art' => 'Art',
            'science' => 'Science',
            'maths' => 'Maths',
            'poem' => 'Poem',
            'fantasy' => 'Fantasy',
            'technician' => 'Technician',
            'tale' => 'Tale',
        ],
    ],
    'floors'=>[
        'title'=>'Floors',
        'description' => 'Manage the floors of the system',
        'create' => 'Create Floor',
        'edit' => 'Edit Floor',
        'fields' => [
            'name' => 'Floor',
            'actions' => 'Actions',
        ],
        'columns' => [
            'name' => 'Name of the floor',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'placeholders' => [
            'name' => 'Name of the floor',
            'search' => 'Search for floors...',
        ],
        'filters' => [
            'search' => 'Search',
            'name' => 'Name of the floor',
        ],
        'buttons' => [
            'new' => 'New Floor',
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
            'description' => 'This action cannot be undone. The floor will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The floor will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting floor',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading floors. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'zones'=>[
        'title'=>'Zones',
        'description' => 'Manage the zones of the system',
        'create' => 'Create Zone',
        'edit' => 'Edit Zone',
        'fields' => [
            'name' => 'Zone',
            'floor' => "Floor where it's located",
            'actions' => 'Actions',
        ],
        'columns' => [
            'name' => 'Name of the Zone',
            'floor' => 'Floor where it is',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'placeholders' => [
            'name' => 'Name of the zone',
            'floor' => "Floor where it's located",
            'search' => 'Search zones...',
        ],
        'filters' => [
            'search' => 'Search',
            'floor' => "Floor where it's located",
            'name' => 'Name of the zone',
        ],
        'buttons' => [
            'new' => 'New Zone',
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
            'description' => 'This action cannot be undone. The zone will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The zone will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting zone',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading zones. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'bookshelves'=>[
        'title'=>'Bookshelves',
        'description' => 'Manage the bookshelves of the system',
        'create' => 'Create Bookshelf',
        'edit' => 'Edit Bookshelf',
        'fields' => [
            'name' => 'Bookshelf',
            'number' => 'Bookshelf number',
            'capacity' => 'Bookshelf capacity',
            'floor' => "Floor where it's located",
            'zone' => "Zone where it's located",
            'actions' => 'Actions',
        ],
        'columns' => [
            'number' => 'Bookshelf number',
            'capacity' => 'Bookshelf capacity',
            'zone' => 'Zone where it is',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'placeholders' => [
            'number' => 'Bookshelf number',
            'capacity' => 'Bookshelf capacity',
            'floor' => "Floor where it's located",
            'zone' => "Zone where it's located",
            'search' => 'Search bookshelves...',
        ],
        'filters' => [
            'search' => 'Search',
            'number' => 'Bookshelf number',
            'capacity' => 'Bookshelf capacity',
            'floor' => "Floor where it's located",
            'zone' => "Zone where it's located",
        ],
        'buttons' => [
            'new' => 'New Bookshelf',
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
            'description' => 'This action cannot be undone. The bookshelf will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The bookshelf will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting bookshelf',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading bookshelves. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'books'=>[
        'title'=>'Books',
        'description' => 'Manage the books of the system',
        'create' => 'Create Book',
        'edit' => 'Edit Book',
        'fields' => [
            'name' => 'Book',
            'title' => 'Title',
            'author' => 'Author',
            'pages' => 'Pages',
            'editorial' => 'Editorial',
            'ISBN' => 'ISBN',
            'genre' => 'Genre',
            'image' => 'Cover image',
            'bookshelf' => 'Bookshelf where it is',
            'actions' => 'Actions',
        ],
        'columns' => [
            'title' => 'Title',
            'author' => 'Author',
            'pages' => 'Pages',
            'editorial' => 'Editorial',
            'ISBN' => 'ISBN',
            'genre' => 'Genre',
            'bookshelf' => 'Bookshelf where it is',
            'created_at' => 'Created at',
            'actions' => 'Actions',
        ],
        'placeholders' => [
            'title' => 'Title',
            'author' => 'Author',
            'pages' => 'Pages',
            'editorial' => 'Editorial',
            'ISBN' => 'ISBN',
            'genre' => 'Genre',
            'image' => 'Cover image',
            'bookshelf' => 'Bookshelf where it is',
        ],
        'filters' => [
            'search' => 'Search',
            'title' => 'Title',
            'author' => 'Author',
            'pages' => 'Pages',
            'editorial' => 'Editorial',
            'ISBN' => 'ISBN',
            'genre' => 'Genre',
            'bookshelf' => 'Bookshelf where it is',
        ],
        'buttons' => [
            'new' => 'New Book',
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
            'description' => 'This action cannot be undone. The book will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The book will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting book',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading books. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'loans'=>[
        'title'=>'Loans',
        'create' => 'Create Loan',
        'description' => 'Manage the loans of the system',
        'edit' => 'Edit Loan',
        'fields' => [
            'book' => 'Book',
            'user' => 'User',
            'actions' => 'Actions',
        ],
        'columns' => [
            'book' => 'Book',
            'user' => 'User',
            'borrowed' => [
                'title' => 'Borrowed',
                'borrowed' => 'Borrowed',
                'returned' => 'Returned',
            ],
            'return_date' => 'Return date',
            'is_overdue' => [
                'title' => 'Overdue',
                'overdue' => 'Overdue',
                'on_time' => 'On time',
                'days' => 'days'
            ],
            'created_at' => 'Created at',
            'actions' => 'Actions',
            'returned_date' => [
                'title' => 'Date when it was returned',
                'not_returned' => 'Not returned'
                ]
        ],
        'placeholders' => [
            'book' => 'Book',
            'user' => 'User',
            'borrowed' => [
                'title' => 'Borrowed',
                'borrowed' => 'Borrowed',
                'returned' => 'Returned',
            ],
            'return_date' => 'Return date',
            'is_overdue' => [
                'title' => 'Overdue',
                'overdue' => 'Overdue',
                'on_time' => 'On time',
                'days' => 'days'
            ],
            'created_at' => 'Created at',
            'actions' => 'Actions',
            'returned_date' => 'Returned date',
            'search' => 'Search loans...',
        ],
        'filters' => [
            'search' => 'Search',
            'book' => 'Book',
            'user' => 'User',
            'borrowed' => [
                'title' => 'Borrowed',
                'borrowed' => 'Borrowed',
                'returned' => 'Returned',
            ],
            'return_date' => 'Return date',
            'is_overdue' => [
                'title' => 'Overdue',
                'overdue' => 'Overdue',
                'on_time' => 'On time',
                'days' => 'days'
            ],
            'created_at' => 'Created at',
        ],
        'buttons' => [
            'new' => 'New Loan',
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
            'description' => 'This action cannot be undone. The loan will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The loan will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting loan',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading loans. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
    'reservations'=>[
        'title'=>'Reservations',
        'create' => 'Create Reservation',
        'description' => 'Manage the reservations of the system',
        'edit' => 'Edit Reservation',
        'fields' => [
            'book' => 'Book',
            'user' => 'User',
            'actions' => 'Actions',
        ],
        'columns' => [
            'book' => 'Book',
            'user' => 'User',
            'active' => [
                'title' => 'Active',
                'active' => 'Active',
                'inactive' => 'Inactive'
            ],
            'actions' => 'Actions',
            'returned_date' => 'Returned date'
        ],
        'placeholders' => [
            'book' => 'Book',
            'user' => 'User',
            'active' => [
                'title' => 'Active',
                'active' => 'Active',
                'inactive' => 'Inactive'
            ],
            'actions' => 'Actions',
            'returned_date' => 'Returned date',
            'search' => 'Search loans...',
        ],
        'filters' => [
            'book' => 'Book',
            'user' => 'User',
            'active' => [
                'title' => 'Active',
                'active' => 'Active',
                'inactive' => 'Inactive'
            ],
            'created_at' => 'Created at',
        ],
        'buttons' => [
            'new' => 'New Reservation',
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
            'description' => 'This action cannot be undone. The reservation will be permanently deleted from the system.',
        ],
        'delete_dialog' => [
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone. The reservation will be permanently deleted from the system.',
            'success' => 'Successfully deleted ;)',
        ],
        'deleted_error' => 'Error deleting reservation',
        'no_results' => 'No results.',
        'error_loading' => 'Error loading reservations. Please try again.',
        'showing_results' => 'Showing :from to :to of :total results',
        'pagination' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],
    ],
];
